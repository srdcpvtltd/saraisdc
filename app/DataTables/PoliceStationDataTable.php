<?php

namespace App\DataTables;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\PoliceStation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PoliceStationDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('state_id', function (PoliceStation $policestation) {
                return ($policestation->city->state != null) ? $policestation->city->state->name : '-';
            })
            ->editColumn('city_id', function (PoliceStation $policestation) {
                return ($policestation->city != null) ? $policestation->city->name : '-';
            })
            ->addColumn('action', function (PoliceStation $policestation) {
                return view('police_station.action', compact('policestation'));
            });
    }


    public function query(PoliceStation $model)
    {
        //$query=$model->with('country');
        return $model->newQuery()->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('police_stations-table')
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
            Column::make('state_id')->title('State'),
            Column::make('city_id')->title('City'),
            Column::make('code')->title('Police Station'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }



    protected function filename()
    {
        return 'police_stations_' . date('YmdHis');
    }
}
