<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $unpaid_invoices = round(Invoice::where('value_status', '1')->count() / Invoice::count() * 100);
        $partially_paid_invoices = round(Invoice::where('value_status', '2')->count() / Invoice::count() * 100);
        $paid_invoices = round(Invoice::where('value_status', '3')->count() / Invoice::count() * 100);

        $barChart = $this->barChart($unpaid_invoices, $paid_invoices, $partially_paid_invoices);
        $pieChart = $this->pieChart($unpaid_invoices, $paid_invoices, $partially_paid_invoices);
        $doughnutChart = $this->doughnutChart();
        $lineChart = $this->lineChart();

        return view('Front-end.dashboard', compact('barChart', 'pieChart', 'doughnutChart', 'lineChart'));
    }

    private function barChart($unpaid_invoices, $paid_invoices, $partially_paid_invoices)
    {
        return app()->chartjs
            ->name('barChartInvoices')
            ->type('bar')
            ->size(['width' => 200, 'height' => 120])
            ->labels(['الفواتير الغير مدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير الغير مدفوعة",
                    'backgroundColor' => ['#FF597B'], //unpaid, partially paid invoices
                    'data' => [$unpaid_invoices],
                    'hoverBackgroundColor' => '#EB455F'
                ],
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#6ECCAF'], //all, paid invoices
                    'data' => [$paid_invoices],
                    'hoverBackgroundColor' => '#68B984'
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#FFB26B'], //all, paid invoices
                    'data' => [$partially_paid_invoices],
                    'hoverBackgroundColor' => '#F2921D'
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
    }

    private function pieChart($unpaid_invoices, $paid_invoices, $partially_paid_invoices)
    {
        return app()->chartjs
            ->name('pieChartInvoices')
            ->type('pie')
            ->size(['width' => 200, 'height' => 130])
            ->labels(['الفواتير الغير مدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF597B', '#6ECCAF', '#FFB26B'],
                    'hoverBackgroundColor' => ['#EB455F', '#68B984', '#F2921D'],
                    'data' => [$unpaid_invoices, $paid_invoices, $partially_paid_invoices]
                ]
            ])
            ->options([]);
    }

    private function doughnutChart()
    {
        $activeUser = round(User::where('status', 1)->count() / User::count() * 100);
        $unActiveUser = round(User::where('status', 2)->count() / User::count() * 100);
        return app()->chartjs
            ->name('donatChartUsers')
            ->type('doughnut')
            ->size(['width' => 200, 'height' => 90])
            ->labels(['المستخدمين المعطلين', 'المستخدمين الفعالين'])
            ->datasets([
                [
                    'label' => 'Users',
                    'data' => [$activeUser, $unActiveUser],
                    'backgroundColor' => [
                        '#FF597B',
                        'rgb(54, 162, 235)',
                    ],
                    'hoverOffset' => 1,
                ]
            ])
            ->options([]);
    }

    private function lineChart()
    {
        $januaryUnpaidInvoices = Invoice::where('value_status', 1)->whereMonth('invoice_Date', '01')->whereYear('invoice_Date', date('Y'))->count();
        $februaryUnpaidInvoices = Invoice::where('value_status', 1)->whereMonth('invoice_Date', '02')->whereYear('invoice_Date', date('Y'))->count();
        $marchUnpaidInvoices = Invoice::where('value_status', 1)->whereMonth('invoice_Date', '03')->whereYear('invoice_Date', date('Y'))->count();
        $aprilUnpaidInvoices = Invoice::where('value_status', 1)->whereMonth('invoice_Date', '04')->whereYear('invoice_Date', date('Y'))->count();
        $mayUnpaidInvoices = Invoice::where('value_status', 1)->whereMonth('invoice_Date', '05')->whereYear('invoice_Date', date('Y'))->count();
        $juneUnpaidInvoices = Invoice::where('value_status', 1)->whereMonth('invoice_Date', '06')->whereYear('invoice_Date', date('Y'))->count();
        $julyUnpaidInvoices = Invoice::where('value_status', 1)->whereMonth('invoice_Date', '07')->whereYear('invoice_Date', date('Y'))->count();

        $januaryPartPaidInvoices = Invoice::where('value_status', 2)->whereMonth('invoice_Date', '01')->whereYear('invoice_Date', date('Y'))->count();
        $februaryPartPaidInvoices = Invoice::where('value_status', 2)->whereMonth('invoice_Date', '02')->whereYear('invoice_Date', date('Y'))->count();
        $marchPartPaidInvoices = Invoice::where('value_status', 2)->whereMonth('invoice_Date', '03')->whereYear('invoice_Date', date('Y'))->count();
        $aprilPartPaidInvoices = Invoice::where('value_status', 2)->whereMonth('invoice_Date', '04')->whereYear('invoice_Date', date('Y'))->count();
        $mayPartPaidInvoices = Invoice::where('value_status', 2)->whereMonth('invoice_Date', '05')->whereYear('invoice_Date', date('Y'))->count();
        $junePartPaidInvoices = Invoice::where('value_status', 2)->whereMonth('invoice_Date', '06')->whereYear('invoice_Date', date('Y'))->count();
        $julyPartPaidInvoices = Invoice::where('value_status', 2)->whereMonth('invoice_Date', '07')->whereYear('invoice_Date', date('Y'))->count();

        $januaryPaidInvoices = Invoice::where('value_status', 3)->whereMonth('invoice_Date', '01')->whereYear('invoice_Date', date('Y'))->count();
        $februaryPaidInvoices = Invoice::where('value_status', 3)->whereMonth('invoice_Date', '02')->whereYear('invoice_Date', date('Y'))->count();
        $marchPaidInvoices = Invoice::where('value_status', 3)->whereMonth('invoice_Date', '03')->whereYear('invoice_Date', date('Y'))->count();
        $aprilPaidInvoices = Invoice::where('value_status', 3)->whereMonth('invoice_Date', '04')->whereYear('invoice_Date', date('Y'))->count();
        $mayPaidInvoices = Invoice::where('value_status', 3)->whereMonth('invoice_Date', '05')->whereYear('invoice_Date', date('Y'))->count();
        $junePaidInvoices = Invoice::where('value_status', 3)->whereMonth('invoice_Date', '06')->whereYear('invoice_Date', date('Y'))->count();
        $julyPaidInvoices = Invoice::where('value_status', 3)->whereMonth('invoice_Date', '07')->whereYear('invoice_Date', date('Y'))->count();




        return app()->chartjs
            ->name('lineChartInvoices')
            ->type('line')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
            ->datasets([
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$januaryPaidInvoices, $februaryPaidInvoices, $marchPaidInvoices, $aprilPaidInvoices, $mayPaidInvoices, $junePaidInvoices, $julyPaidInvoices],
                ],
                [
                    "label" => "الفواتير الغير مدفوعة",
                    'backgroundColor' => "rgba(255, 89, 123, 0.31)",
                    'borderColor' => "rgba(255, 89, 123 , 0.7)",
                    "pointBorderColor" => "rgba(255, 89, 123 , 0.7)",
                    "pointBackgroundColor" => "rgba(255, 89, 123 , 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$januaryUnpaidInvoices, $februaryUnpaidInvoices, $marchUnpaidInvoices, $aprilUnpaidInvoices, $mayUnpaidInvoices, $juneUnpaidInvoices, $julyUnpaidInvoices],
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => "rgba(242, 146, 29, 0.31)",
                    'borderColor' => "rgba(242, 146, 29 , 0.7)",
                    "pointBorderColor" => "rgba(242, 146, 29 , 0.7)",
                    "pointBackgroundColor" => "rgba(242, 146, 29 , 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [$januaryPartPaidInvoices, $februaryPartPaidInvoices, $marchPartPaidInvoices, $aprilPartPaidInvoices, $mayPartPaidInvoices, $junePartPaidInvoices, $julyPartPaidInvoices],
                ]

            ])
            ->options([
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'min' => 0,
                            ],
                        ],
                    ],
            ]
            ]);
    }


}

