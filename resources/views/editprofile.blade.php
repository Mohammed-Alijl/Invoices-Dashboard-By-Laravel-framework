@extends('layouts.master')
@section('title')
    {{__('Front-end/profile.profile')}}
@endsection
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{__('Front-end/profile.profile')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Front-end/profile.edit.profile')}}</span>
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
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        {{Session::forget('success')}}
    @endif
				<!-- row -->
				<form class="row row-sm" method="post" action="{{route('profile.update',auth()->id())}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
					<!-- Col -->
					<div class="col-lg-4">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="pl-0">
									<div class="main-profile-overview">
										<div class="main-img-user profile-user">
											<img alt="" src="{{URL::asset('assets/img/users/' . auth()->user()->image)}}">
                                            <div class="image-upload">
                                            <label for="profile_pic" style="position:relative;bottom: 100px;right: 70px; color: #0a7ffb;cursor: pointer">
                                                <i class="fas fa-camera profile-edit"></i>
                                            </label>
                                            <input type="file" id="profile_pic" style="display: none" accept="image/png, image/jpeg, image/svg" name="pic">
                                            </div>
										</div>
										<div class="d-flex justify-content-between mg-b-20">
											<div>
												<h5 class="main-profile-name">{{auth()->user()->name}}</h5>
												<p class="main-profile-name-text">{{auth()->user()->email}}</p>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4 col mb20">
												<h5>{{auth()->user()->invoices()->count()}}</h5>
												<h6 class="text-small text-muted mb-0">{{__('Front-end/profile.invoices')}}</h6>
											</div>
											<div class="col-md-4 col mb20">
												<h5>{{auth()->user()->roles()->count()}}</h5>
												<h6 class="text-small text-muted mb-0">{{__('Front-end/profile.roles')}}</h6>
											</div>
										</div>

									</div><!-- main-profile-overview -->
								</div>
							</div>
						</div>
					</div>

					<!-- Col -->
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="mb-4 main-content-label">{{__('Front-end/profile.profile')}}</div>
								<div class="form-horizontal">
									<div class="form-group ">
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('Front-end/profile.username')}}</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="{{__('Front-end/profile.profile')}}" value="{{auth()->user()->name}}" name="name">
											</div>
										</div>
									</div>
									<div class="form-group ">
										<div class="row">
											<div class="col-md-3">
												<label class="form-label">{{__('Front-end/profile.email')}}</label>
											</div>
											<div class="col-md-9">
												<input type="text" class="form-control"  placeholder="{{__('Front-end/profile.email')}}" value="{{auth()->user()->email}}" name="email">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="card-footer text-left">
								<button type="submit" class="btn btn-primary waves-effect waves-light">{{__('Front-end/profile.update.profile')}}</button>
							</div>
						</div>
					</div>
					<!-- /Col -->
				</form>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
@endsection
