<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Experience;
use App\Models\Education;
use App\DataTables\DoctorsDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\EducationRequest;
use App\Http\Requests\ExperienceRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function index(DoctorsDataTable $dataTables)
    {
        return $dataTables->render('common.index', [
            'resourceName' => 'Doctors',
            'resourceRoute' => 'doctors',
        ]);
    }

    public function create()
    {
        $departments = Department::all();
        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->get();
        $municipality_types = DB::table('municipality_types')->get();
        $municipalities = DB::table('municipalities')->get();

        $educations = collect([new Education()]);
        $experiences = collect([new Experience()]);

        return view('doctors.form', compact('departments', 'provinces', 'districts', 'municipality_types', 'municipalities', 'educations', 'experiences'));
    }

    public function store(DoctorRequest $doctorRequest, EducationRequest $educationRequest, ExperienceRequest $experienceRequest)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctor::create($doctorRequest->validated());

            $this->storeEducation($educationRequest, $doctor->id);
            $this->storeExperience($experienceRequest, $doctor->id);

            $user = User::create([
                'name' => $doctorRequest->input('name'),
                'email' => $doctorRequest->input('email'),
                'password' => Hash::make($doctorRequest->input('password')),
                'doctor_id' => $doctor->id,
            ]);

            if (!$user) {
                DB::rollBack();
                return redirect()->route('doctors.index')->with('error', 'User could not be created.');
            }

            DB::commit();
            return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating doctor and user: ' . $e->getMessage());
            return redirect()->route('doctors.index')->with('error', 'Error creating doctor and user.');
        }
    }

    public function show(string $id)
    {
        $doctor = Doctor::with(['education', 'experience'])->findOrFail($id);
        return view('doctors.view', compact('doctor'));
    }

    private function storeEducation(EducationRequest $request, $doctorId): void
    {
        $educationData = $this->prepareEducationData($request, $doctorId);
        Education::insert($educationData);
    }

    private function storeExperience(ExperienceRequest $request, $doctorId): void
    {
        $experienceData = $this->prepareExperienceData($request, $doctorId);
        Experience::insert($experienceData);
    }

    private function prepareEducationData(EducationRequest $request, $doctorId)
    {
        $educationData = [];
        $degrees = $request->input('degree', []);
        $startYears = $request->input('start_year', []);
        $endYears = $request->input('end_year', []);
        $startYearsBS = $request->input('start_year_bs',[]);
        $endYearsBS = $request->input('end_year_bs',[]);

        foreach ($degrees as $index => $degree) {
            $educationData[] = [
                'doctor_id' => $doctorId,
                'degree' => $degree,
                'institution' => $request->input('institution')[$index] ?? null,
                'address' => $request->input('address')[$index] ?? null,
                'field_of_study' => $request->input('field_of_study')[$index] ?? null,
                'start_year' => $startYears[$index] ?? null,
                'end_year' => $endYears[$index] ?? null,
                'start_year_bs' => $startYearsBS[$index] ?? null,
                'end_year_bs' => $endYearsBS[$index] ?? null,
                'edu_certificates' => $request->hasFile('edu_certificates.' . $index) ? $request->file('edu_certificates.' . $index)->store('certificates') : null,
                'additional_information' => $request->input('additional_information')[$index] ?? null,
            ];
        }

        return $educationData;
    }

    private function prepareExperienceData(ExperienceRequest $request, $doctorId)
    {
        $experienceData = [];
        $employmentTypes = $request->input('type_of_employment', []);
        $startDates = $request->input('start_date', []);
        $endDates = $request->input('end_date', []);
        $startDatesBS= $request->input('start_date_bs',[]);
        $endDatesBS= $request->input('end_date_bs',[]);

        foreach ($employmentTypes as $index => $type) {
            $experienceData[] = [
                'doctor_id' => $doctorId,
                'type_of_employment' => $type,
                'job_title' => $request->input('job_title')[$index] ?? null,
                'healthcare_facilities' => $request->input('healthcare_facilities')[$index] ?? null,
                'location' => $request->input('location')[$index] ?? null,
                'start_date' => $startDates[$index] ?? null,
                'end_date' => $endDates[$index] ?? null,
                'start_date_bs' => $startDatesBS[$index] ?? null,
                'end_date_bs' => $endDatesBS[$index] ?? null,
                'exp_certificates' => $request->hasFile('exp_certificates.' . $index) ? $request->file('exp_certificates.' . $index)->store('certificates') : null,
                'additional_details' => $request->input('additional_details')[$index] ?? null,
            ];
        }

        return $experienceData;
    }

    public function edit($id)
    {
        $doctor = Doctor::with(['education', 'experience'])->findOrFail($id);

        $departments = Department::all();
        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->get();
        $municipality_types = DB::table('municipality_types')->get();
        $municipalities = DB::table('municipalities')->get();

        return view('doctors.form', compact('doctor', 'departments', 'provinces', 'districts', 'municipality_types', 'municipalities'));
    }

    public function update(DoctorRequest $doctorRequest, EducationRequest $educationRequest, ExperienceRequest $experienceRequest, $id)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->update($doctorRequest->validated());

            $user = User::where('doctor_id', $doctor->id)->first();
            if ($user) {
                $user->update([
                    'name' => $doctorRequest->input('name'),
                    'email' => $doctorRequest->input('email'),
                ]);
            }

            // Update education and experience
            Education::where('doctor_id', $doctor->id)->delete();
            Experience::where('doctor_id', $doctor->id)->delete();

            $this->updateEducation($educationRequest, $doctor->id);
            $this->updateExperience($experienceRequest, $doctor->id);

            DB::commit();
            return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating doctor and user: ' . $e->getMessage());
            return redirect()->route('doctors.index')->with('error', 'Error updating doctor and user.');
        }
    }

    private function updateEducation(EducationRequest $request, $doctorId): void
    {
        // Bulk update or insert for education
        Education::where('doctor_id', $doctorId)->delete();
        $this->storeEducation($request, $doctorId);
    }

    /**
     * Update experience details.
     */
    private function updateExperience(ExperienceRequest $request, $doctorId): void
    {
        // Bulk update or insert for experience
        Experience::where('doctor_id', $doctorId)->delete();
        $this->storeExperience($request, $doctorId);
    }

    /**
     * Remove a doctor record.
     */
    public function destroy($id)
    {
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->delete();
            return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting doctor: ' . $e->getMessage());
            return redirect()->route('doctors.index')->with('error', 'Error deleting doctor.');
        }
    }

    /**
     * Get doctors by department.
     */
    public function getDoctorsByDepartment($departmentId)
    {
        $doctors = Doctor::where('department_id', $departmentId)->get();
        return view('departments.department-index', compact('doctors'));
    }

}
