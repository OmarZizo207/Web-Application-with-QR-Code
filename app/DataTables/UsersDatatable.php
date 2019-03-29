<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Services\DataTable;

class UsersDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('edit', 'admin.users.btn.edit')
            ->addColumn('checkbox', 'admin.users.btn.checkbox')
            ->addColumn('delete', 'admin.users.btn.delete')
            ->addColumn('level', 'admin.users.btn.level')
            ->rawColumns([
                'edit',
                'checkbox',
                'delete',
                'level',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query()->where(function($q){
            if(request()->has('level')) {
                return $q->where('level',request('level'));
            }
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->addAction(['width' => '80px'])
                    //->parameters($this->getBuilderParameters());
                    ->parameters([
                        'dom'       => 'Blftrip',
                        'lengthMenu'=> [[10,25,50,100],[10,25,50,trans('admin.all_record')]],
                        'buttons'   => [
                            [
                                'text' => '<i class="fa fa-plus"></i> '.trans('admin.create') ,
                                'className' => 'btn btn-info','action'=> 'function(){
                                    window.location.href = "'.\URL::current().'/create"
                                }'
                            ] , [
                                'extend' => 'print','className' => 'btn btn-primary', 'text' => '<i class="fa fa-print"></i>'
                            ] , [
                                'extend' => 'csv','className' => 'btn btn-info', 'text' => '<i class="fa fa-file"></i> '.trans('admin.ex_csv')
                            ] , [
                                'extend' => 'excel','className' => 'btn btn-success', 'text' => '<i class="fa fa-file"></i> '.trans('admin.ex_excel')
                            ] , [
                                'extend' => 'reload','className' => 'btn btn-default', 'text' => '<i class="fas fa-sync-alt"></i>'
                            ] , [
                                'text' => '<i class="fa fa-trash"></i> '.trans('admin.delete_all') ,
                                'className' => 'btn btn-danger delBtn'
                            ]
                        ],
                        "initComplete" => " function () {
                            this.api().columns([2,3]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty()).
                                on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                        'language' => datatable_lang(),
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'  => 'checkbox',
                'data'  => 'checkbox',
                'title' => '<input type="checkbox" class="check_all" onclick="check_all()" />',
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],[
                'name'  => 'id',
                'data'  => 'id',
                'title' => trans('admin.id'),
            ],[
                'name'  => 'name',
                'data'  => 'name',
                'title' => trans('admin.user_name'),
            ],[
                'name'  => 'email',
                'data'  => 'email',
                'title' => trans('admin.user_email'),
            ],[
                'name'  => 'level',
                'data'  => 'level',
                'title' => trans('admin.user_level'),
            ],[
                'name'  => 'created_at',
                'data'  => 'created_at',
                'title' => trans('admin.created_at'),
            ],[
                'name'  => 'updated_at',
                'data'  => 'updated_at',
                'title' => trans('admin.updated_at'),
            ],[
                'name'  => 'edit',
                'data'  => 'edit',
                'title' => trans('admin.edit'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],
            [
                'name'  => 'delete',
                'data'  => 'delete',
                'title' => trans('admin.delete'),
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}
