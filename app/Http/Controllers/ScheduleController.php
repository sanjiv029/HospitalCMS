<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\DataTables\SchedulesDataTable;
use App\Models\DoctorSchedule;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Appointment;

class ScheduleController extends Controller
{
    public function index(SchedulesDataTable $dataTable)
    {
        $doctors = Doctor::has('schedules')->with('schedules')->get();

        return view('schedules.index',compact('doctors'));
    }

    public function create()
    {
        return view('schedules.form', [
            'doctors' => Doctor::doesntHave('schedules')->get(),
            'departments' => Department::all(),
            'days' => $this->getDays(),
        ]);
    }

    public function store(ScheduleRequest $request)
    {
        return $this->saveSchedules($request);
    }

    public function show(DoctorSchedule $schedule)
    {
        return view('schedules.view', compact('schedule'));
    }

    public function edit(DoctorSchedule $schedule)
    {
        // Format start_time and end_time to ensure consistency (H:i:s)
        $schedule->start_time = date('H:i:s', strtotime($schedule->start_time));
        $schedule->end_time = date('H:i:s', strtotime($schedule->end_time));

        return view('schedules.form', [
            'schedule' => $schedule,
            'doctors' => $schedule->doctor,
            'days' => $this->getDays(),
            'selectedDays' => $schedule->day_of_week,
        ]);
    }


    public function update(ScheduleRequest $request, DoctorSchedule $schedule)
    {
        DB::beginTransaction();
        try {
            DoctorSchedule::where('id', $schedule->id)
                ->delete();
            // Save new schedules
            $this->saveSchedules($request);

            DB::commit();
            return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating schedule: ' . $e->getMessage());
            return redirect()->route('schedules.index')->with('error', 'Could not update schedule.');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            DoctorSchedule::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting schedule: ' . $e->getMessage());
            return redirect()->route('schedules.index')->with('error', 'Could not delete schedule.');
        }
    }

    // New Method for Bulk Edit
    public function bulkEdit($doctorId)
    {
        $doctor = Doctor::with('schedules')->findOrFail($doctorId);
        $schedules = $doctor->schedules;

        foreach ($schedules as $schedule) {
            $schedule->start_time = date('H:i:s', strtotime($schedule->start_time));
            $schedule->end_time = date('H:i:s', strtotime($schedule->end_time));
        }

        $schedules = $schedules->keyBy('day_of_week');

        $days = $this->getDays();
        $selectedDays = $schedules->keys()->toArray();

        return view('schedules.bulk_edit', [
            'schedules' => $schedules,
            'doctor' => $doctor,
            'days' => $days,
            'selectedDays' => $selectedDays,
        ]);
    }


    // New Method for Bulk Update
    public function bulkUpdate(ScheduleRequest $request, $doctorId)
    {

        DoctorSchedule::where('doctor_id', $doctorId)->delete();
       // Save new schedules
       $this->saveSchedules($request);
        return redirect()->route('schedules.index')->with('success', 'Schedules updated successfully!');
    }
    public function bulkDestroy($doctorId)
    {
        DB::beginTransaction();
        try {
            DoctorSchedule::where('doctor_id', $doctorId)->delete();
            DB::commit();
            return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting schedule: ' . $e->getMessage());
            return redirect()->route('schedules.index')->with('error', 'Could not delete schedule.');
        }
    }

    private function saveSchedules(ScheduleRequest $request)
    {
        DB::beginTransaction();
        try {
            $days = $this->getDays();
            $scheduleDataArray = []; // Store schedule data for all selected days

            foreach ($request->day_of_week as $day) {
                $dayName = $days[$day - 1]->name;

                // Prepare data for saving
                $scheduleData = [
                    'doctor_id' => $request->doctor_id,
                    'day_of_week' => $dayName,
                    'start_time' => date('H:i:s', strtotime($request->schedule[$day]['start_time'])),
                    'end_time' => date('H:i:s', strtotime($request->schedule[$day]['end_time'])),
                ];

                $scheduleDataArray[] = $scheduleData;
            }

            // Create all schedules
            DoctorSchedule::insert($scheduleDataArray);

            DB::commit();
            return redirect()->route('schedules.index')->with('success', 'Schedule saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving schedule: ' . $e->getMessage());
            return redirect()->route('schedules.index')->with('error', 'Could not save schedule.');
        }
    }

    private function getDays()
    {
        return [
            (object)['id' => 1, 'name' => 'Sunday'],
            (object)['id' => 2, 'name' => 'Monday'],
            (object)['id' => 3, 'name' => 'Tuesday'],
            (object)['id' => 4, 'name' => 'Wednesday'],
            (object)['id' => 5, 'name' => 'Thursday'],
            (object)['id' => 6, 'name' => 'Friday'],
            (object)['id' => 7, 'name' => 'Saturday'],
        ];
    }

}
