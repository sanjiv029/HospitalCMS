<?php

namespace App\DataTables;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DoctorsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
                    ->editColumn('date_of_birth_ad', function($doctor) {
                        return \Carbon\Carbon::parse($doctor->date_of_birth_ad)->format('Y-m-d'); // Format A.D. date
                    })
                    ->addColumn('department_name', function ($doctor) {
                        return $doctor->department ? $doctor->department->name : 'N/A'; // Get department name
                    })
                    ->addColumn('user_id', function ($doctor) {
                        return $doctor->user ? $doctor->user->id : 'N/A';
                    })
            ->addColumn('action', function($data){
                $url = '/admin/doctor/';
                $buttons['view'] = true;
                $buttons['edit'] = true;
                $buttons['delete'] = true;

                return view('components.action-button', compact('buttons' , 'url' , 'data'))->render();
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Doctor $model): QueryBuilder
    {
        return $model->newQuery()->with('department');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('doctors-table')
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
                    ]) ;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->width(50),
            Column::make('name')
            ->width(150),
            Column::make('department_name')
            ->title('Department'),
            Column::make('email')
            ->width(200),
            COlumn::make('user_id')
            ->width(100),
            Column::make('phone')
            ->width(100),
            Column::make('date_of_birth_ad')
                ->title('Date of Birth (A.D)')
                ->width(150),
            Column::make('status')
            ->width(150),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(250)
                ->addClass('text-center'),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Doctors_' . date('YmdHis');
    }

}
