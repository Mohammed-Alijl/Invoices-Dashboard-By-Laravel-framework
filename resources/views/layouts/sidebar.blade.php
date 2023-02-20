<!-- Sidebar-right-->
		<div class="sidebar sidebar-left sidebar-animate">
			<div class="panel panel-primary card mb-0 box-shadow">
				<div class="tab-menu-heading border-0 p-3">
					<div class="card-title mb-0">{{__('Front-end/header.notifications')}}</div>
					<div class="card-options mr-auto">
						<a href="#" class="sidebar-remove"><i class="fe fe-x"></i></a>
					</div>
				</div>
				<div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
					<div class="tabs-menu active">
						<!-- Tabs -->
						<ul class="nav panel-tabs">
							<li><a href="#side2" data-toggle="tab" class="active"><i class="ion ion-md-notifications tx-18  ml-2"></i>
                                {{__('Front-end/header.notifications')}}</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane active " id="side2">
							<div class="list-group list-group-flush ">
                                @foreach(auth()->user()->unreadNotifications as $notification)
								<div class="list-group-item d-flex  align-items-center">
									<div class="ml-3">
										<span class="avatar avatar-lg brround cover-image" data-image-src="{{URL::asset('assets/img/users/' . $notification->data['image'])}}"><span class="avatar-status bg-success"></span></span>
									</div>
									<div>
                                        {{$notification->data['title']}}
										<div class="small text-muted">
                                            {{$notification->created_at->diffForHumans()}}
										</div>
									</div>
								</div>
                                @endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--/Sidebar-right-->
