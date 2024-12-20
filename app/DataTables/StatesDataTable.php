<?php

namespace App\DataTables;

use App\Models\State;
use App\Models\Country;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StatesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('country_id', function (State $state) {
                return ($state->country!=null)?$state->country->name:'-';
            })
            ->addColumn('action', function (State $state) {
                return view('states.action', compact('state'));
            });
    }


    public function query(State $model)
    {
        //$query=$model->with('country');
        return $model->newQuery()->orderBy('states.id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('states-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->className('btn-primary '),
                Button::make('pageLength')->className('btn-light ')

            ) ->language([
                'buttons'=>[
                    'create'=>__('Create'),
                    'pageLength'=>__('Show %d rows'),
                ]
            ]);
    }


    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('country_id')->title('Cuntry'),
            Column::make('name')->title('State'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }



    protected function filename()
    {
        return 'States_' . date('YmdHis');
    }
}
