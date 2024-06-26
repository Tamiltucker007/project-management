<?php

namespace App\DataTables;

use App\Models\Task;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class TaskDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('project', function (Task $task) {
                return $task->project ? $task->project->name : 'N/A';
            })
            ->addColumn('action', function ($row) {
            // Check user role
            $user = auth()->user();
            $roles = $user->roles;
            $isTeamMember = $roles->contains('name', 'team-member');

            $viewBtn = '<a href="'.route('tasks.show', $row->id).'" class="btn btn-sm btn-success">View</a>';
            if ($isTeamMember) {
                return $viewBtn;
            } else {
                $editBtn = '<a href="'.route('tasks.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>';
                $deleteBtn = '<button class="btn btn-sm btn-danger ms-2 delete-btn" data-url="'.route('tasks.destroy', $row->id).'" data-name="'.$row->title.'">Delete</button>';
                return $viewBtn.' '.$editBtn.' '.$deleteBtn;
            }
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Task $model): QueryBuilder
    {
        return $model->newQuery()->with('project');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('task-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')
                ->title('S.No'),
            Column::make('project')
                  ->data('project')
                  ->title('Project'),
            Column::make('title'),
            Column::make('deadline'),
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
        return 'Task_' . date('YmdHis');
    }
}
