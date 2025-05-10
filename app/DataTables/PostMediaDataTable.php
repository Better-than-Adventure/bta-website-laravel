<?php

namespace App\DataTables;

use App\Models\GalleryItem;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostMediaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */

    protected mixed $post_id;

    public function __construct($post_id)
    {
        parent::__construct();
        $this->post_id = $post_id;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('image_path', function($column) {
                return $column->image_path;
            })
            ->addColumn('image_description', function($column) {
                return $column->image_description;
            })
            ->addColumn('created_at', function($column) {
                return Carbon::parse($column->created_at)->format('d M Y');
            })
            ->addColumn('thumbnail', function($column) {
                return view('datatables.posts.media.thumbnail', ['item' => $column]);
            })
            ->addColumn('actions', function($column) {
            return view('datatables.posts.media.actions', ['galleryItem' => $column]);
            })->rawColumns(['status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(GalleryItem $model): QueryBuilder
    {
        return $model->where('post_id', $this->post_id);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('post-media-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('thumbnail'),
            Column::make('image_description'),
            Column::make('created_at'),
            Column::make('actions'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PostGalleryItems_' . date('YmdHis');
    }
}
