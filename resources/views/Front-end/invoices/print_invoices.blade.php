@extends('layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }

    </style>
@endsection
@section('title')
    {{__('Front-end/invoices.invoice.print.show')}}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('Front-end/invoices.invoices')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{__('Front-end/invoices.invoice.print.show')}}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('invoices_success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('invoices_success_msg') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{Session::forget('invoices_success_msg')}}
    @endif
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">{{__('Front-end/invoices.invoice.collection')}}</h1>

                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">

                            <div class="col-md">
                                <label class="tx-gray-600">{{__('Front-end/invoices.invoice.info')}}</label>
                                <p class="invoice-info-row"><span>{{__('Front-end/invoices.invoice.number')}}</span>
                                    <span>{{ $invoice->invoice_number }}</span></p>
                                <p class="invoice-info-row"><span>{{__('Front-end/invoices.release.date')}}</span>
                                    <span>{{ $invoice->invoice_Date }}</span></p>
                                <p class="invoice-info-row"><span>{{__('Front-end/invoices.due.date')}}</span>
                                    <span>{{ $invoice->due_date }}</span></p>
                                <p class="invoice-info-row"><span>{{__('Front-end/invoices.section')}}</span>
                                    <span>{{ $invoice->section->name }}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="wd-20p">#</th>
                                    <th class="wd-40p">{{__('Front-end/invoices.product')}}</th>
                                    <th class="tx-center">{{__('Front-end/invoices.collection.amount')}}</th>
                                    <th class="tx-right">{{__('Front-end/invoices.commission.amount')}}</th>
                                    <th class="tx-right">{{__('Front-end/invoices.total')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="tx-12">{{ $invoice->product->name }}</td>
                                    <td class="tx-center">{{ number_format($invoice->amount_collection, 2) }}</td>
                                    <td class="tx-right">{{ number_format($invoice->amount_commission, 2) }}</td>
                                    @php
                                        $total = $invoice->amount_collection + $invoice->amount_commission ;
                                    @endphp
                                    <td class="tx-right">{{ number_format($total, 2) }}</td>
                                </tr>

                                <tr>
                                    <td class="valign-middle" colspan="2" rowspan="4">
                                        <div class="invoice-notes">
                                            <label class="main-content-label tx-13">#</label>

                                        </div><!-- invoice-notes -->
                                    </td>
                                    <td class="tx-right">{{__('Front-end/invoices.total')}}</td>
                                    <td class="tx-right" colspan="2"> {{ number_format($total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">{{__('Front-end/invoices.rate.vat')}} ({{ $invoice->rate_vat }})</td>
                                    <td class="tx-right" colspan="2">{{$invoice->value_vat}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">{{__('Front-end/invoices.discount')}}</td>
                                    <td class="tx-right" colspan="2"> {{ number_format($invoice->discount, 2) }}</td>

                                </tr>
                                <tr>
                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">{{__('Front-end/invoices.total.include.vat')}}</td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold">{{ number_format($invoice->total, 2) }}</h4>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr class="mg-b-40">



                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" > <i
                                class="mdi mdi-printer ml-1"></i> {{__('Front-end/invoices.invoice.print')}}</button>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }

    </script>
    <script>
        document.getElementById("print_Button").addEventListener("click", function() {
            var section = document.getElementById("print");
            var win = window.open("", "", "height=500,width=500");
            win.document.write("<html><head><title>Print Section</title></head><body>");
            win.document.write(section.innerHTML);
            win.document.write("</body></html>");
            win.print();
            win.close();
        });
    </script>

@endsection
