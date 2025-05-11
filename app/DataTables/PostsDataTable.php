<?php

namespace App\DataTables;

use App\Enums\EnumPostTemplates;
use App\Models\Post;
use App\Models\PostType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */

    protected mixed $filter;

    public function __construct($filter = null)
    {
        parent::__construct();
        $this->filter = $filter;
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('postType', function($column) {
                return $column->postType?->name ?? 'N/A';
            })
            ->addColumn('tags', function($column) {
                return view('datatables.tags', compact('column'));
            })
            ->addColumn('status', function($column) {
                return $column->status;
            })
            ->addColumn('published_at', function($column) {
                return Carbon::parse($column->published_at)->format('d M Y H:i');
            })
            ->addColumn('created_at', function($column) {
                return Carbon::parse($column->created_at)->format('d M Y');
            })
            ->addColumn('actions', function($column) {
            return view('datatables.posts.actions', ['post' => $column]);
            })->rawColumns(['status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Post $model): QueryBuilder
    {
        $query = $model->newQuery();

        $query = match ($this->filter) {
            'gallery' => $query->whereHas('postType', function ($query) {
                $query->where('post_template_enum', EnumPostTemplates::Gallery);
            }),
            default => $query->whereHas('postType', function ($query) {
                $query->where('slug', $this->filter ?? 'page');
            }),
        };

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('posts-table')
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
            Column::make('title'),
            Column::make('summary'),
            Column::make('postType'),
            Column::make('tags'),
            Column::make('status'),
            Column::make('published_at'),
            Column::make('created_at'),
            Column::make('actions'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Posts_' . date('YmdHis');
    }
}
