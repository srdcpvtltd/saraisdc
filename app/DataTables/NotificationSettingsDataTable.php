<?php

namespace App\DataTables;

use App\Facades\UtilityFacades;
use App\Models\NotificationSetting;
use App\Models\Modual;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotificationSettingsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function (NotificationSetting $notification_setting) {
                return  UtilityFacades::dateFormat($notification_setting->created_at);
            })
            ->addColumn('action', function (NotificationSetting $notification) {
                return view('notificationsettings.action', compact('notification'));
            });
    }


    public function query(NotificationSetting $model)
    {
        return $model->newQuery()->orderBy('id', 'ASC');
    }


    public function html()
    {
        return $this->builder()
            ->setTableId('notification_settings-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->className('btn-primary '),
//                Button::make('export')->className('btn-light '),
//                Button::make('print')->className('btn-light '),
//                Button::make('reset')->className('btn-light '),
//                Button::make('reload')->className('btn-light '),
                Button::make('pageLength')->className('btn-light ')

            ) ->language([
                'buttons'=>[
                    'create'=>__('Create'),
//                    'export'=>__('Export'),
//                    'print'=>__('Print'),
//                    'reset'=>__('Reset'),
//                    'reload'=>__('Reload'),
//                    'excel'=>__('Excel'),
//                    'csv'=>__('CSV'),
                    'pageLength'=>__('Show %d rows'),
                ]
            ]);
    }


    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('age_from'),
            Column::make('age_to'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }



    protected function filename()
    {
        return 'notificationsettings_' . date('YmdHis');
    }
}
