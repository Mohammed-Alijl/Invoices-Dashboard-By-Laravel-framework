@extends('layouts.master')
@section('title')
    {{__('Front-end/invoices.partially.paid.invoices.list')}}
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('Front-end/invoices.invoices')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"> / {{__('Front-end/invoices.partially.paid.invoices.list')}}</span>
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
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{__('Front-end/invoices.partially.paid.invoices.list')}}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table key-buttons text-md-nowrap">
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
                                <th class="border-bottom-0">{{__('Front-end/invoices.settings')}}</th>
                                <th class="border-bottom-0">{{__('Front-end/invoices.note')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->id}}</td>
                                    <td>
                                        <a href="{{route('invoices.show',$invoice->id)}}">{{$invoice->invoice_number}}</a>
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
                                                <span class="text-warning">{{__('Front-end/invoices.status.partially.paid')}}</span>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button">{{__('Front-end/invoices.settings')}}<i class="fas fa-caret-down ml-1"></i>
                                            </button>
                                            <div class="dropdown-menu tx-13">
                                                @can('edit-invoice')
                                                <a class="dropdown-item"
                                                   href=" {{route('invoices.edit',$invoice->id) }}">{{__('Front-end/invoices.invoice.edit')}}</a>
                                                @endcan
                                                    @can('soft-delete-invoice')
                                                    <a class="dropdown-item" href="#" data-id="{{ $invoice->id }}"
                                                   data-toggle="modal" data-effect="effect-scale"
                                                   data-target="#modaldemo5"><i
                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;{{__('Front-end/invoices.invoice.archive')}}</a>
                                                    @endcan
                                                    @can('payment-change-status')
                                                <a class="dropdown-item" href="{{route('payments.edit',$invoice->id)}}">
                                                    <i class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp; {{__('Front-end/invoices.invoice.change.payment.status')}}
                                                </a>
                                                    @endcan
                                                    @can('print-invoice')
                                                <a class="dropdown-item" href="{{route('invoices.print',$invoice->id)}}"><i
                                                        class="text-success fas fa-print"></i>&nbsp;&nbsp;{{__('Front-end/invoices.invoice.print')}}
                                                </a>
                                                    @endcan
                                            </div>
                                        </div>

                                    </td>
                                    <td>{{$invoice->note}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <div class="modal" id="modaldemo5">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                    <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger mg-b-20">{{__('Front-end/invoices.archive.invoice.confirm.message')}}</h4>
                    <form action="{{route('invoices.archive')}}" method="post" autocomplete="off" id="delete_form">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" id="id" value="">
                        <button type="submit" class="btn ripple btn-danger pd-x-25">{{__('Front-end/invoices.invoice.archive')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#modaldemo5').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>
@endsection
