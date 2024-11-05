<?php

namespace App\DataTables;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MenusDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $url = '/admin/menus/';
                $buttons['edit'] = true;
                $buttons['delete'] = true;
                return view('components.action-button', compact('data', 'url', 'buttons'))->render();
            })
            ->editColumn('display', function ($data) {
                return $data->display ? 'Yes' : 'No'; // Display 'Yes' or 'No'
            })
            ->editColumn('type', function ($data) {
                // Display type based on its value and related data
                if ($data->type === 'module') {
                    return optional($data->module)->title;
                } elseif ($data->type === 'page') {
                    return optional($data->page)->title;
                } elseif ($data->type === 'external_link') {
                    return $data= 'External Link';
                } else {
                    return 'N/A';
                }
            })
            ->editColumn('status', function ($data) {
                return $data->status ? 'Active' : 'Inactive'; // Display 'Active' or 'Inactive'
            })
            ->editColumn('parent_id', function ($data) {
                return $data->parent_id ? optional(Menu::find($data->parent_id))->title : 'None'; // Show parent title or 'None'
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Menu $model): QueryBuilder
    {
        return $model->with(['module', 'page'])->newQuery(); // Eager load module and page relationships
    }

    /**
     * Optional method if you want to use the HTML builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('menus-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('reload'),
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('print'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('display'),
            Column::make('type'),
            Column::make('status'),
            Column::make('parent_id')->title('Parent Menu')
            ->width(150),
            Column::make('external_link')->title('External Link')
            ->width(150),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Menus_' . date('YmdHis');
    }
}
