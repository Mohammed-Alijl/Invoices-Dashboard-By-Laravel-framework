<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $unpaid_invoices = round(Invoice::where('value_status', '1')->count() / Invoice::count() * 100);
        $partially_paid_invoices = round(Invoice::where('value_status', '2')->count() / Invoice::count() * 100);
        $paid_invoices = round(Invoice::where('value_status', '3')->count() / Invoice::count() * 100);

        //===============================START BAR CHART===============================
        $barChart = app()->chartjs
            ->name('barChartInvoices')
            ->type('bar')
            ->size(['width' => 200, 'height' => 120])
            ->labels(['الفواتير الغير مدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير مدفوعة",
                    'backgroundColor' => ['#FF597B'], //unpaid, partially paid invoices
                    'data' => [$unpaid_invoices],
                    'hoverBackgroundColor'=>'#EB455F'
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#6ECCAF'], //all, paid invoices
                    'data' => [$paid_invoices],
                    'hoverBackgroundColor'=>'#68B984'
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#FFB26B'], //all, paid invoices
                    'data' => [$partially_paid_invoices],
                    'hoverBackgroundColor'=>'#F2921D'
                ],
            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
                    ],
                    'xAxes' => [
                        [
                            'barThickness' => 50
                        ]
                    ],
                ]
            ]);
//===============================END BAR CHART===============================




//===============================START PIE CHART=============================
        $pieChart = app()->chartjs
            ->name('pieChartInvoices')
            ->type('pie')
            ->size(['width' => 200, 'height' => 130])
            ->labels(['الفواتير الغير مدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF597B', '#6ECCAF','#FFB26B'],
                    'hoverBackgroundColor' => ['#EB455F', '#68B984','#F2921D'],
                    'data' => [$unpaid_invoices, $paid_invoices ,$partially_paid_invoices]
                ]
            ])
            ->options([]);
//===============================END PIE CHART===============================


        return view('Front-end.dashboard', compact('barChart','pieChart'));
    }
}
