<?php

namespace App\DataTables;

use App\Models\Country;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CountriesDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            /* ->editColumn('created_at', function (Country $country_setting) {
                return  UtilityFacades::dateFormat($country_setting->created_at);
            }) */
            ->addColumn('action', function (Country $country) {
                return view('countries.action', compact('country'));
            });
    }


    public function query(Country $model)
    {
        return $model->newQuery()->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('countries-table')
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
            Column::make('sortname'),
            Column::make('name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }



    protected function filename()
    {
        return 'Countries_' . date('YmdHis');
    }
}
