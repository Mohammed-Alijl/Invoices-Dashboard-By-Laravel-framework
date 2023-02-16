@extends('layouts.master')
@section('title')
    {{__('Front-end/transactions.transactions')}}
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
                <h4 class="content-title mb-0 my-auto">{{__('Front-end/transactions.banks.transactions')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Front-end/transactions.transactions')}}</span>
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

    @if (session()->has('products_success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('products_success_msg') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{Session::forget('products_success_msg')}}
    @endif
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                    </div>
                    @can('add-product')
                    <p class="tx-12 tx-gray-500 mb-2"><div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mg-sm-t-0">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo8">{{__('Front-end/transactions.add.transactions')}}</a>
                    </div></p>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{__('Front-end/transactions.transactions.name')}}</th>
                                <th class="border-bottom-0">{{__('Front-end/transactions.transactions.description')}}</th>
                                <th class="border-bottom-0">{{__('Front-end/transactions.bank')}}</th>
                                <th class="border-bottom-0">{{__('Front-end/transactions.settings')}}</th>
                                <th class="border-bottom-0">.</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->section->name}}</td>
                                    <td>
                                        @can('edit-product')
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           data-id="{{ $product->id }}" data-product_name="{{ $product->name }}"
                                            data-description="{{ $product->description }}" data-section_name="{{ $product->section->name }}"
                                           data-toggle="modal" href="#modaldemo1" title="{{__('Front-end/transactions.edit')}}"><i class="las la-pen"></i></a>
                                        @endcan
                                        @can('delete-product')
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           data-id="{{ $product->id }}" data-product_name="{{ $product->name }}"
                                           data-toggle="modal" href="#modaldemo5" title="{{__('Front-end/transactions.delete')}}"><i
                                                class="las la-trash"></i></a>
                                            @endcan
                                    </td>
                                    <td>.</td>
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
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{__('Front-end/transactions.edit.transactions')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6>{{__('Front-end/transactions.edit.transactions')}}</h6>
                    <form action="products/update" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="recipient-name" class="col-form-label">{{__('Front-end/transactions.transactions.name')}}</label>
                            <input class="form-control" name="name" id="product_name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">{{__('Front-end/transactions.transactions.description')}}</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{__('Front-end/transactions.bank')}}</label>
                        <select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2" required>
                            @foreach ($sections as $section)
                                <option>{{ $section->name }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('Front-end/transactions.edit')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Front-end/transactions.cancel')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{__('Front-end/transactions.add.transactions')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6>{{__('Front-end/transactions.add.transactions')}}</h6>
                    <form action="products" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{__('Front-end/transactions.transactions.name')}}</label>
                            <input type="text" class="form-control" id="product_name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{__('Front-end/transactions.transactions.description')}}</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{__('Front-end/transactions.bank')}}</label>
                            <select name="section_id" id="section_name" class="custom-select my-1 mr-sm-2" required>
                                <option value="" selected disabled>{{__('Front-end/transactions.select.bank')}}</option>
                                @foreach ($sections as $section)
                                    <option value="{{$section->id}}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">{{__('Front-end/transactions.add')}}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Front-end/transactions.cancel')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo5">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger mg-b-20">{{__('Front-end/transactions.delete.bank.confirm.message')}}</h4>
                    <form action="products/destroy'" method="post" autocomplete="off">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" id="id" value="">
                        <button type="submit" class="btn ripple btn-danger pd-x-25">{{__('Front-end/transactions.delete')}}</button>
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

    <script>
        $('#modaldemo1').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var description = button.data('description')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #section_name').val(section_name);
        })
    </script>
    <script>
        $('#modaldemo5').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })
    </script>
@endsection
