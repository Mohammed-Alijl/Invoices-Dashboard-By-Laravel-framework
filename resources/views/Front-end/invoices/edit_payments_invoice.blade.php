@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    {{__('Front-end/invoices.invoice.change.payment.status')}}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('Front-end/invoices.invoices')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{__('Front-end/invoices.invoice.change.payment.status')}}</span>
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
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('payments.update',$invoice->id) }}" method="post" enctype="multipart/form-data"
                          autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.invoice.number')}}</label>
                                <input type="text" class="form-control" id="inputName" value="{{$invoice->invoice_number}}"
                                       title="{{__('Front-end/invoices.invoice.number')}}" readonly>
                            </div>

                            <div class="col">
                                <label>{{__('Front-end/invoices.invoice.date')}}</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                       type="text" value="{{ $invoice->invoice_Date }}" readonly>
                            </div>

                            <div class="col">
                                <label>{{__('Front-end/invoices.due.date')}}</label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                       type="text" value="{{$invoice->due_date}}" readonly>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.section')}}   </label>
                                <select name="Section" class="form-control" onclick="console.log($(this).val())"
                                        onchange="console.log('change is firing')" readonly>
                                    <!--placeholder-->
                                    <option value=" {{ $invoice->section->id }}">
                                        {{ $invoice->section->name }}
                                    </option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.product')}}</label>
                                <select id="product" name="product_id" class="form-control" readonly>
                                    <option value="{{$invoice->product->id}}" selected>{{$invoice->product->name}}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.collection.amount')}}</label>
                                <input type="text" class="form-control" id="inputName" name="amount_collection"
                                       value="{{$invoice->amount_collection}}" readonly
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.commission.amount')}}</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                       name="amount_commission" title="{{__('Front-end/invoices.commission.amount')}}"
                                       value="{{$invoice->amount_commission}}" readonly
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.discount')}}</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="discount"
                                       title="مبلغ الخصم" value="{{$invoice->discount}}"
                                       oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                       required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.vat.rate')}}</label>
                                <select name="rate_vat" id="Rate_VAT" class="form-control" onchange="myFunction()" readonly>
                                    <!--placeholder-->
                                    @if($invoice->rate_vat === '5%')
                                        <option value="5%" selected>5%</option>
                                        <option value="10%">10%</option>
                                    @else
                                        <option value="5%">5%</option>
                                        <option value="10%" selected>10%</option>
                                    @endif
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.total.include.vat')}}</label>
                                <input type="text" class="form-control" id="Total" name="total"
                                       readonly value="{{$invoice->total}}">
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">{{__('Front-end/invoices.remaining.amount')}}</label>
                                <input type="text" class="form-control" id="Value_VAT" name="value_vat"
                                       readonly value="{{$invoice->remaining_amount}}">
                            </div>


                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">{{__('Front-end/invoices.note')}}</label>
                                <textarea class="form-control" id="exampleTextarea" rows="3" readonly>
                                    {{$invoice->note}}
                                </textarea>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">{{__('Front-end/invoices.paid.amount')}}</label>
                                <input type="text" class="form-control" id="inputName" title="{{__('Front-end/invoices.paid.amount')}}" name="collection_amount">
                            </div>

                            <div class="col">
                                <label>{{__('Front-end/invoices.paid.notes')}}</label>
                                <input class="form-control" name="note" type="text" >
                            </div>


                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">{{__('Front-end/invoices.invoice.change.payment.status')}}</button>
                        </div>


                    </form>
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
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>



    <script>
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("Value_VAT").value = sumq;

                document.getElementById("Total").value = sumt;

            }

        }

    </script>


@endsection
