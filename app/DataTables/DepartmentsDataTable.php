<?php

namespace App\DataTables;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DepartmentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('doctor_count', function ($department) {
            return '<a href="' . route('departments.doctors.index', $department->id) . '">' .
                   $department->doctor()->count() .
                   '</a>'; 
            })
            ->addColumn('action', function($data) {
                $url = '/admin/department/';
                $buttons['view'] = true;
                $buttons['edit'] = true;
                $buttons['delete'] = true;

                return view('components.action-button', compact('buttons', 'url', 'data'))->render();
            })
            ->setRowId('id')
            ->rawColumns(['doctor_count','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Department $model): QueryBuilder
    {
        return $model->newQuery()->with('doctor');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('departments-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'scrollX' => true,  // Enables horizontal scrolling
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
            Column::make('name')
            ->width(300),
            Column::make('code')
            ->width(300),
            Column::make('doctor_count')->title('Number of Doctors')
            ->width(200),
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
        return 'Departments_' . date('YmdHis');
    }
}
