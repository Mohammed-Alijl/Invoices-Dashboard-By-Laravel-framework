@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css') }}" rel="stylesheet">

    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    @section('title')
        {{__('Front-end/reports.invoices.reports')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('Front-end/reports.reports')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Front-end/reports.invoices.reports')}}</span>
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

    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">


                <div class="card-header pb-0">

                    <form action="{{route('invoices.search')}}" method="POST" role="search" autocomplete="off">
                        @csrf


                        <div class="col-lg-3">
                            <label class="rdiobox">
                                <input checked name="radio" type="radio" value="1" id="type_div"> <span>{{__('Front-end/reports.search.invoice.type')}}</span></label>
                        </div>


                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                            <label class="rdiobox"><input name="radio" value="2" type="radio"><span>{{__('Front-end/reports.search.invoice.number')}}
                            </span></label>
                        </div><br><br>

                        <div class="row">

                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="type">
                                <p class="mg-b-10">{{__('Front-end/reports.select.invoice.type')}}</p><select class="form-control select2" name="status"
                                                                                 required>
                                    <option value="4" {{!isset($status) || $status== 4 ? 'selected' : ''}}>{{__('Front-end/reports.all.invoices')}}</option>
                                    <option value="3" {{isset($status) && $status == 3 ? 'selected' : ''}}>الفواتير المدفوعة</option>
                                    <option value="2" {{isset($status) && $status == 2 ? 'selected' : ''}}>الفواتير المدفوعة جزئيا</option>
                                    <option value="1" {{isset($status) && $status == 1 ? 'selected' : ''}}>الفواتير الغير مدفوعة</option>

                                </select>
                            </div><!-- col-4 -->


                            <div class="col-lg-3 mg-t-20 mg-lg-t-0" id="invoice_number">
                                <p class="mg-b-10">{{__('Front-end/reports.search.invoice.number')}}</p>
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number">

                            </div><!-- col-4 -->

                            <div class="col-lg-3" id="start_at">
                                <label for="exampleFormControlSelect1">{{__('Front-end/reports.start.at')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" value="{{ $start_at ?? '' }}"
                                                 name="start_at" placeholder="YYYY-MM-DD" type="text">
                                </div><!-- input-group -->
                            </div>

                            <div class="col-lg-3" id="end_at">
                                <label for="exampleFormControlSelect1">{{__('Front-end/reports.end.at')}}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div><input class="form-control fc-datepicker" name="end_at"
                                                 value="{{ $end_at ?? '' }}" placeholder="YYYY-MM-DD" type="text">
                                </div><!-- input-group -->
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-sm-1 col-md-2">
                                <button class="btn btn-primary btn-block">{{__('Front-end/reports.search')}}</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (isset($invoices))
                            <table id="example" class="table key-buttons text-md-nowrap" style=" text-align: center">
                                <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.invoice.number')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.invoice.date')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.due.date')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.product')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.section')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.discount')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.rate.vat')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.value.vat')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.total')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.status')}}</th>
                                    <th class="border-bottom-0">{{__('Front-end/invoices.note')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{$invoice->id}}</td>
                                        <td>
                                            @can('invoice-details')
                                                <a href="{{route('invoices.show',$invoice->id)}}">{{$invoice->invoice_number}}</a>
                                            @else
                                                {{$invoice->invoice_number}}
                                            @endcan
                                        </td>
                                        <td>{{$invoice->invoice_Date}}</td>
                                        <td>{{$invoice->due_date}}</td>
                                        <td>{{\App\Models\Product::find($invoice->product_id)->name}}</td>
                                        <td>{{\App\Models\Section::find($invoice->section_id)->name}}</td>
                                        <td>{{$invoice->discount}}</td>
                                        <td>{{$invoice->rate_vat}}</td>
                                        <td>{{$invoice->value_vat}}</td>
                                        <td>{{$invoice->total}}</td>
                                        <td>
                                            @switch($invoice->value_status)
                                                @case(3)
                                                    <span class="text-success">{{__('Front-end/invoices.status.paid')}}</span>
                                                    @break
                                                @case(2)
                                                    <span class="text-warning">{{__('Front-end/invoices.status.partially.paid')}}</span>
                                                    @break
                                                @default
                                                    <span class="text-danger">{{__('Front-end/invoices.status.unpaid')}}</span>
                                                    @break
                                            @endswitch
                                        </td>

                                        <td>{{ $invoice->note }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Ion.rangeSlider.min js -->
    <script src="{{ URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="{{ URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>
    <!-- Ionicons js -->
    <script src="{{ URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js') }}"></script>
    <!--Internal  pickerjs js -->
    <script src="{{ URL::asset('assets/plugins/pickerjs/picker.min.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>

    <script>
        $(document).ready(function() {

            $('#invoice_number').hide();

            $('input[type="radio"]').click(function() {
                if ($(this).attr('id') == 'type_div') {
                    $('#invoice_number').hide();
                    $('#status').show();
                    $('#start_at').show();
                    $('#end_at').show();
                } else {
                    $('#invoice_number').show();
                    $('#status').hide();
                    $('#start_at').hide();
                    $('#end_at').hide();
                }
            });
        });

    </script>


@endsection
