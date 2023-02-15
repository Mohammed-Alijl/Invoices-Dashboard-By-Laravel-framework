@extends('layouts.master')
@section('title')
    {{__('Front-end/invoices.invoice.details')}}
@endsection
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Front-end/invoices.invoices')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Front-end/invoices.invoice.details')}}</span>
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

    @if (session()->has('invoices_details.success.msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('invoices_details.success.msg') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{Session::forget('invoices_details.success.msg')}}
    @endif
				<!-- row -->
				<div class="row">
                    <div class="panel panel-primary tabs-style-2">
                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line">
                                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">{{__('Front-end/invoices.invoice.details')}}</a></li>
                                    @can('display-payment-status')
                                    <li><a href="#tab5" class="nav-link" data-toggle="tab">{{__('Front-end/invoices.payment.status')}}</a></li>
                                    @endcan
                                    @can('display-attachments')
                                    <li><a href="#tab6" class="nav-link" data-toggle="tab">{{__('Front-end/invoices.invoice.attachments')}}</a></li>
                                    @endcan
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab4">
                                    <div class="col-xl-12">
                                        <div class="card mg-b-20">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">{{__('Front-end/invoices.invoice.details')}}</h4>
                                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                                </div>
                                                <p class="tx-12 tx-gray-500 mb-2">
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="example" class="table key-buttons text-md-nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">#</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.invoice.number')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.release.date')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.due.date')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.product')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.section')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.discount')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.rate.vat')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.value.vat')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.total')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.remaining.amount')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.status')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.employee.name')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.note')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{$invoice->id}}</td>
                                                                <td>{{$invoice->invoice_number}}</td>
                                                                <td>{{$invoice->invoice_Date}}</td>
                                                                <td>{{$invoice->due_date}}</td>
                                                                <td>{{\App\Models\Product::find($invoice->product_id)->name}}</td>
                                                                <td>{{\App\Models\Section::find($invoice->section_id)->name}}</td>
                                                                <td>{{$invoice->discount}}</td>
                                                                <td>{{$invoice->rate_vat}}</td>
                                                                <td>{{$invoice->value_vat}}</td>
                                                                <td>{{$invoice->total}}</td>
                                                                <td>{{$invoice->remaining_amount}}</td>
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
                                                                <td>{{$invoice->user->name}}</td>
                                                                <td>{{$invoice->note}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @can('display-payment-status')
                                <div class="tab-pane" id="tab5">
                                    <div class="col-xl-12">
                                        <div class="card mg-b-20">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">{{__('Front-end/invoices.payment.status')}}</h4>
                                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                                </div>
                                                <p class="tx-12 tx-gray-500 mb-2">
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="example" class="table key-buttons text-md-nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">#</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.invoice.number')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.due.date')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.total.amount.requested')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.paid.amount')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.remaining.amount')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.paid.date')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.status')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.employee.name')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.note')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($payments as $payment)
                                                            <tr>
                                                                <td>{{$invoice->id}}</td>
                                                                <td>{{$invoice->invoice_number}}</td>
                                                                <td>{{$invoice->due_date}}</td>
                                                                <td>{{$payment->total}}</td>
                                                                <td>{{$payment->collection_amount}}</td>
                                                                <td>{{$payment->remaining_amount}}</td>
                                                                <td>{{$payment->created_at}}</td>
                                                                <td>
                                                                    @switch($payment->payment_status)
                                                                        @case(3)
                                                                            <span class="badge badge-pill badge-success">{{__('Front-end/invoices.status.paid')}}</span>
                                                                            @break
                                                                        @case(2)
                                                                            <span class="badge badge-pill badge-warning">{{__('Front-end/invoices.status.partially.paid')}}</span>
                                                                            @break
                                                                        @default
                                                                            <span class="badge badge-pill badge-danger">{{__('Front-end/invoices.status.unpaid')}}</span>
                                                                            @break
                                                                    @endswitch
                                                                </td>
                                                                <td>{{$payment->user->name}}</td>
                                                                <td>{{$payment->note}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endcan
                                @can('display-attachments')
                                <div class="tab-pane" id="tab6">
                                    @can('add-attachment')
                                    <div class="card-body">
                                        <p class="text-danger">{{__('Front-end/invoices.attachment extension')}}</p>
                                        <h5 class="card-title">{{__('Front-end/invoices.attachments.add')}}</h5>
                                        <form method="post" action="{{ route('attachments.store') }}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile"
                                                       name="file_name" required>
                                                <input type="hidden" id="customFile" name="invoice_number"
                                                       value="{{ $invoice->invoice_number }}">
                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                       value="{{ $invoice->id }}">
                                                <label class="custom-file-label" for="customFile">{{__('Front-end/invoices.select.attachment')}}</label>
                                            </div><br><br>
                                            <button type="submit" class="btn btn-primary btn-sm "
                                                    name="uploadedFile">{{__('Front-end/invoices.attachment.add')}}</button>
                                        </form>
                                    </div>
                                    @endcan
                                    <div class="col-xl-12">
                                        <div class="card mg-b-20">
                                            <div class="card-header pb-0">
                                                <div class="d-flex justify-content-between">
                                                    <h4 class="card-title mg-b-0">{{__('Front-end/invoices.invoice.attachments')}}</h4>
                                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                                </div>
                                                <p class="tx-12 tx-gray-500 mb-2">
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="example" class="table key-buttons text-md-nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">#</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.attachment.name')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.add.by')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.add.date')}}</th>
                                                            <th class="border-bottom-0">{{__('Front-end/invoices.settings')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($attachments as $attachment)
                                                            <tr>
                                                                <td>{{$attachment->id}}</td>
                                                                <td>{{$attachment->file_name}}</td>
                                                                <td>{{$invoice->user->name}}</td>
                                                                <td>{{$attachment->created_at}}</td>
                                                                <td colspan="2">

                                                                    <a class="btn btn-outline-success btn-sm"
                                                                       href="{{route('attachments.show',$attachment->id) }}"
                                                                       role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                        {{__('Front-end/invoices.display')}}</a>

                                                                    <a class="btn btn-outline-info btn-sm"
                                                                       href="{{route('attachments.edit',$attachment->id)  }}"
                                                                       role="button"><i
                                                                            class="fas fa-download"></i>&nbsp;
                                                                        {{__('Front-end/invoices.download')}}</a>
                                                                    @can('delete-attachment')
                                                                    <button class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-id="{{ $attachment->id }}"
                                                                            data-target="#modaldemo5">{{__('Front-end/invoices.delete')}}</button>
                                                                    @endcan
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endcan

                            </div>
                        </div>
                    </div>

				</div>
                <div class="modal" id="modaldemo5">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content tx-size-sm">
                            <div class="modal-body tx-center pd-y-20 pd-x-20">
                                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                                <h4 class="tx-danger mg-b-20">{{__('Front-end/invoices.delete.attachment.confirm.message')}}</h4>
                                <form action="" method="post" autocomplete="off" id="delete_form">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn ripple btn-danger pd-x-25">{{__('Front-end/invoices.delete')}}</button>
                                </form>
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
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <script>
        $('#modaldemo5').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            document.getElementById("delete_form").action = "../attachments/" + id;
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
