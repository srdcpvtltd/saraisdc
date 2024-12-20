<?php

namespace App\DataTables;

use App\Facades\UtilityFacades;
use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function (Role $role) {
                return  UtilityFacades::dateFormat($role->created_at);
            })
            ->addColumn('action', function (role $role) {
                return view('roles.action', compact('role'));
            });
    }


    public function query(Role $model)
    {
        return $model->newQuery()->where('name','!=','admin')->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('roles-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->className('btn-primary '),
                Button::make('export')->className('btn-light '),
                Button::make('print')->className('btn-light '),
                Button::make('reset')->className('btn-light '),
                Button::make('reload')->className('btn-light '),
                Button::make('pageLength')->className('btn-light ')
            ) ->language([
                'buttons'=>[
                    'create'=>__('Create'),
                    'export'=>__('Export'),
                    'print'=>__('Print'),
                    'reset'=>__('Reset'),
                    'reload'=>__('Reload'),
                    'excel'=>__('Excel'),
                    'csv'=>__('CSV'),
                    'pageLength'=>__('Show %d rows'),
                ]
            ]);
    }


    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }


    protected function filename()
    {
        return 'Roles_' . date('YmdHis');
    }
}
