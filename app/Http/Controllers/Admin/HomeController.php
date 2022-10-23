<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Subscribers',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Subscriber',
            'group_by_field'        => 'expiry',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'subscriber',
        ];

        $chart1 = new LaravelChart($settings1);

        $settings2 = [
            'chart_title'           => 'Receivables',
            'chart_type'            => 'bar',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Receivable',
            'group_by_field'        => 'lastupdate',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'amount',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'receivable',
        ];

        $chart2 = new LaravelChart($settings2);

        $settings3 = [
            'chart_title'           => 'Recent Subscribers',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Subscriber',
            'group_by_field'        => 'expiry',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '7',
            'group_by_field_format' => 'd-m-Y H:i:s',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'fields'                => [
                'username'  => '',
                'firstname' => '',
                'mobileno'  => '',
            ],
            'translation_key' => 'subscriber',
        ];

        $settings3['data'] = [];
        if (class_exists($settings3['model'])) {
            $settings3['data'] = $settings3['model']::latest()
                ->take($settings3['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings3)) {
            $settings3['fields'] = [];
        }

        return view('home', compact('chart1', 'chart2', 'settings3'));
    }
}
