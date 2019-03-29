<?php

namespace App\DataTables;

use App\Model\Menu;
use Yajra\DataTables\Services\DataTable;

class MenuDatatable extends DataTable
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
            ->addColumn('edit', 'admin.menu.btn.edit')
            ->addColumn('checkbox', 'admin.menu.btn.checkbox')
            ->addColumn('delete', 'admin.menu.btn.delete')
            ->addColumn('menu_image', 'admin.menu.btn.image')
            ->rawColumns([
                'edit',
                'checkbox',
                'delete',
                'menu_image'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Menu $model)
    {
        return Menu::query()->with('restaurant_id')->select('menus.*');
        // $model->newQuery();
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
                    // ->addAction(['width' => '80px'])
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
                            this.api().columns([2,3,4]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty()).
                                on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                        'language' => datatable_lang(),
                    ]);//$this->getBuilderParameters());
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
                'name'  => 'menu_name_ar',
                'data'  => 'menu_name_ar',
                'title' => trans('admin.name_ar'),
            ],[
                'name'  => 'menu_name_en',
                'data'  => 'menu_name_en',
                'title' => trans('admin.name_en'),
            ],[
                'name'  => 'restaurant_id.restaurant_name_'.session('lang'),
                'data'  => 'restaurant_id.restaurant_name_'.session('lang'),
                'title' => trans('admin.restaurant_name_'.session('lang')),
            ],[
                'name'  => 'menu_image',
                'data'  => 'menu_image',
                'title' => trans('admin.image'),
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
        return 'menus_' . date('YmdHis');
    }
}
