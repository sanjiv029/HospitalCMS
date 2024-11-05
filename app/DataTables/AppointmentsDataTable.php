<?php

namespace App\DataTables;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AppointmentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
          return datatables()
                ->eloquent($query)
                ->addColumn('doctor_name', function ($appointment) {
                    return $appointment->doctor ? $appointment->doctor->name : 'N/A';
                })
                ->addColumn('patient_name', function ($appointment) {
                    return $appointment->patient ? $appointment->patient->name : 'N/A';
                })
                ->addColumn('day_and_time', function ($appointment) {
                    $day = $appointment->day;
                    $timeSlot = \Carbon\Carbon::parse($appointment->time_slot)->format('h:i A');
                    return "{$day} at {$timeSlot}";
                })
                ->addColumn('action', function ($data) {
                    $url = '/admin/appointment/';
                    $buttons['view'] = true;
                    $buttons['edit'] = true;
                    $buttons['delete'] = true;
                    return view('components.action-button', compact('data', 'url', 'buttons'))->render();
                })
                ->setRowId('id');
        }

    /**
     * Get the query source of dataTable.
     */
    public function query(Appointment $model): QueryBuilder
    {
        return $model->newQuery()->with('patient', 'doctor');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('appointments-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([Button::make('reload')]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('patient_name')->title('Patient Name'),
            Column::make('doctor_name')->title('Doctor Name'),
            Column::make('day_and_time')->title('Day and Time'),
            Column::computed('status')->title('Status')->exportable(false)->printable(false),
            Column::computed('action')->title('Actions')->exportable(false)->printable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Appointments_' . date('YmdHis');
    }
}
