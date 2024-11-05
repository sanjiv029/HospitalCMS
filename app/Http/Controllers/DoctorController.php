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
use Illuminate\Support\Facades\Storage;



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

        $doctor = null;
        return view('doctors.form', compact('departments', 'provinces', 'districts', 'municipality_types', 'municipalities', 'educations', 'experiences', 'doctor'));
    }

    public function store(DoctorRequest $doctorRequest, EducationRequest $educationRequest, ExperienceRequest $experienceRequest)
    {
        DB::beginTransaction();
        try {

            //handle profile image upload
            $profileImage = $this->checkType($doctorRequest->validated(),null , null);

             $doctor = Doctor::create(array_merge($doctorRequest->validated(), ['profile_image' => $profileImage]));

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
            return redirect()->route('doctors.index')->with('error', 'Error creating doctor and user.')->withInput();
        }
    }
    public function checkType($data, $no = null, $model = null)
    {
        if (isset($data['profile_image'])) {
            Log::info('Profile image upload initiated.');
            $fileName = date('YmdHi') . $data['profile_image']->getClientOriginalName();
            $data['profile_image']->storeAs('/DoctorImages', $fileName, 'public');
            $data['profile_image'] = '/storage/DoctorImages/' . $fileName;
            Log::info('Profile image saved as: ' . $data['profile_image']);
        }

        // If the function is called with a second argument to handle deletion
        if ($no == 1 && $model) {
            $trimmedPath = trim(str_replace("/storage/", "", $model->profile_image));
            if (Storage::disk('public')->exists($trimmedPath)) {
                Storage::disk('public')->delete($trimmedPath);
            }
        }

        return $data['profile_image'] ?? null; // Return the path to the stored image or null if not set
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


    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $educations = $doctor->education;
        $experiences = $doctor->experience;
        $departments = Department::all();
        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->get();
        $municipality_types = DB::table('municipality_types')->get();
        $municipalities = DB::table('municipalities')->get();

        return view('doctors.form', compact('doctor', 'departments', 'provinces', 'districts', 'municipality_types', 'municipalities','educations', 'experiences'));
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

    private function updateEducation(EducationRequest $request, $doctorId)
    {
        $educationData = $this->prepareEducationData($request, $doctorId);
        foreach ($educationData as $data) {
            // Update or create education record
            Education::updateOrCreate(
                ['doctor_id' => $doctorId, 'degree' => $data['degree'], 'institution' => $data['institution']],
                $data
            );
        }
    }

    private function updateExperience(ExperienceRequest $request, $doctorId)
    {
        $experienceData = $this->prepareExperienceData($request, $doctorId);
        foreach ($experienceData as $data) {
            // Ensure that necessary keys are present before updating or creating
            if (isset($data['job_title'], $data['healthcare_facilities'])) {
                Experience::updateOrCreate(
                    ['doctor_id' => $doctorId, 'job_title' => $data['job_title'], 'healthcare_facilities' => $data['healthcare_facilities']],
                    $data
                );
            }
        }
    }

    private function prepareEducationData(EducationRequest $request, $doctorId)
    {
        $educationData = [];
        $degrees = $request->input('degree', []);
        $certificatesArray = $request->file('edu_certificates', []);

        // Retrieve existing education data
        $existingEducationData = Education::where('doctor_id', $doctorId)->get();

        foreach ($degrees as $index => $degree) {
            // Check for existing certificate path
            $existingPath = $existingEducationData[$index]->edu_certificates ?? null;

            // Handle certificate upload or preserve existing path
            $certificatesPath = $this->handleCertificateUpload($certificatesArray[$index] ?? null, $existingPath, 'Education');

            $educationData[] = [
                'doctor_id' => $doctorId,
                'degree' => $degree,
                'institution' => $request->input('institution')[$index] ?? null,
                'edu_certificates' => $certificatesPath,
            ];
        }

        return $educationData;
    }

    private function prepareExperienceData(ExperienceRequest $request, $doctorId)
    {
        $experienceData = [];
        $employmentTypes = $request->input('type_of_employment', []);
        $jobTitles = $request->input('job_title', []);
        $healthcareFacilities = $request->input('healthcare_facilities', []);
        $certificatesArray = $request->file('exp_certificates', []);

        // Retrieve existing experience data
        $existingExperienceData = Experience::where('doctor_id', $doctorId)->get();

        foreach ($employmentTypes as $index => $type) {
            // Prepare a new data entry with checks for necessary keys
            $data = [
                'doctor_id' => $doctorId,
                'type_of_employment' => $type,
                'job_title' => $jobTitles[$index] ?? null,
                'healthcare_facilities' => $healthcareFacilities[$index] ?? null,
                'exp_certificates' => null, // Will be set later
            ];

            // Check for existing certificate path
            $existingPath = $existingExperienceData[$index]->exp_certificates ?? null;

            // Handle certificate upload or preserve existing path
            $data['exp_certificates'] = $this->handleCertificateUpload($certificatesArray[$index] ?? null, $existingPath, 'Experience');

            $experienceData[] = $data;
        }

        return $experienceData;
    }

    private function handleCertificateUpload($file, $modelPath = null, $folder = 'Education')
    {
        // Log the upload initiation
        Log::info("Certificate upload initiated for folder: $folder.");

        // If a file is provided, process the upload
        if ($file instanceof \Illuminate\Http\UploadedFile) {
            $fileName = date('YmdHi') . '_' . $file->getClientOriginalName();
            $path = $file->storeAs("/$folder", $fileName, 'public');
            $storedPath = '/storage/' . $folder . '/' . $fileName;
            Log::info("Certificate saved as: $storedPath");

            // Handle deletion of the previous file if a model path is provided
            if ($modelPath) {
                $trimmedPath = trim(str_replace("/storage/", "", $modelPath));
                if (Storage::disk('public')->exists($trimmedPath)) {
                    Storage::disk('public')->delete($trimmedPath);
                    Log::info("Deleted old certificate: $trimmedPath");
                }
            }

            return $storedPath;
        }

        // If no file is provided, return the existing path
        return $modelPath;
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
