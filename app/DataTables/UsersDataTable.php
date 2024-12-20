<?php

namespace App\DataTables;

use App\Facades\UtilityFacades;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function (User $user) {
                return  UtilityFacades::dateFormat($user->created_at);
            })
            ->editColumn('role', function (User $user) {
                return (count($user->roles))?$user->roles->first()->name:'-';
            })
            ->addColumn('action', function (User $user) {
                return view('users.action', compact('user'));
            });
    }


    public function query(User $model)
    {
        return $model->newQuery()->where('id','!=',1)->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
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
            Column::make('email'),
            Column::make('role')->searchable(false)->orderable(false),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(50)
                ->addClass('text-center'),
        ];
    }


    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
