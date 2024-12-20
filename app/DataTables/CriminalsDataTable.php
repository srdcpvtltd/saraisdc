<?php

namespace App\DataTables;

use App\Models\Criminal;
use App\Models\Criminals;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CriminalsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('image', function (Criminal $criminal) {
                return view('criminals.image', compact('criminal'));
            })
            ->addColumn('action', function (Criminal $criminal) {
                return view('criminals.action', compact('criminal'));
            });
    }


    public function query(Criminal $model)
    {
        return $model->newQuery()->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('criminals-table')
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
            Column::make('name'),
            // Column::make('mobile'),
            Column::make('age'),
            Column::make('gender'),
            Column::make('remarks'),
            Column::computed('image')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }



    protected function filename()
    {
        return 'Criminals_' . date('YmdHis');
    }
}
