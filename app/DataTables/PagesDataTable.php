<?php

namespace App\DataTables;

use App\Models\Page;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PagesDataTable extends DataTable
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
                $url = '/admin/pages/'; // Set the base URL for actions
                $buttons['edit'] = true; // Enable edit button
                $buttons['view'] = true;
                $buttons['delete'] = true; // Enable delete button
                return view('components.action-button', compact('data', 'url', 'buttons'))->render();
            })
            ->addColumn('img', function ($page) {
                // Extract the image name from the path
                return basename($page->img);
            })
            ->rawColumns(['img','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Page $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pages-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
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
            Column::make('id'), // Column for ID
            Column::make('title')
            ->width(200), // Column for Title
            Column::make('date')
            ->width(150), // Assuming you have a 'date' column in your pages table
            Column::make('slug')
            ->width(200), // Column for Slug
            Column::make('img')->title('Image')
            ->width(150), // Column for Image
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'), // Column for Action buttons
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pages_' . date('YmdHis');
    }
}
