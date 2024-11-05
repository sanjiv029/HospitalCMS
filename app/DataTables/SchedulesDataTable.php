<?php

namespace App\DataTables;

use App\Models\DoctorSchedule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class SchedulesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
        {
            return (new EloquentDataTable($query))
                ->addColumn('doctor_name', function ($schedule) {
                    return $schedule->doctor ? $schedule->doctor->name : 'N/A'; // Get doctor name
                })
                ->addColumn('day_and_time', function ($schedule) {
                    // Combine day of the week with formatted start and end time
                    $day = $schedule->day_of_week;
                    $startTime = \Carbon\Carbon::parse($schedule->start_time)->format('h:i A');
                    $endTime = \Carbon\Carbon::parse($schedule->end_time)->format('h:i A');
                    return "{$day}: {$startTime} - {$endTime}";
                })
                ->addColumn('action', function ($schedule) {
                    $url = '/admin/schedule/';
                    $buttons['view'] = true;
                    $buttons['edit'] = true;
                    $buttons['delete'] = true;
                    return view('components.action-btn-schedule', compact('buttons', 'url', 'schedule'))->render();
                })
                ->setRowId('id');
        }


    /**
     * Get the query source of dataTable.
     */
    public function query(DoctorSchedule $model): QueryBuilder
    {
        return $model->newQuery()
            ->select('id', 'doctor_id',  'day_of_week', 'start_time', 'end_time')
            ->with('doctor');
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('schedules-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->responsive(true)
                    ->parameters([
                        'responsive' => true,
                        'autoWidth' => true,
                        'scrollX' => true,
                    ])
                    ->buttons([
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('doctor_name')->title('Doctor')->width(250),
            Column::make('day_and_time')->title('Day & Time')->width(400), // Update width as necessary
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Schedules_' . date('YmdHis');
    }
}
