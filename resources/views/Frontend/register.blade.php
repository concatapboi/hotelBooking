@extends('Frontend.layouts.master')
@section('content')
<!-- Breadcrumb Area Start -->
	<div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url({{asset('blog/img/bg-img/16.jpg')}});">
			<div class="container h-100">
					<div class="row h-100 align-items-center">
							<div class="col-12">
									<div class="breadcrumb-content text-center">
											<h2 class="page-title">Register</h2>
											<nav aria-label="breadcrumb">
													<ol class="breadcrumb justify-content-center">
															<li class="breadcrumb-item"><a href="{{action('Frontend\PageController@index')}}">Home</a></li>
															<li class="breadcrumb-item active" aria-current="page">Register</li>
													</ol>
											</nav>
									</div>
							</div>
					</div>
			</div>
	</div>
	<!-- Breadcrumb Area End -->

	<!-- Items Area Start -->
	<div class="roberto-news-area section-padding-100-0">
			<div class="container">
				<form action="{{action('Frontend\PageController@postRegister')}}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="row justify-content-center">
							<div class="col-12 col-lg-5">
								<div class="form-group mb-30">
										<label for="checkInDate">Username<span class="text-danger">*</span> </label>
										<div >
												<div class="row">
														<div class="col-12">
																<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
														</div>
												</div>
										</div>
								</div>
								<div class="form-group mb-30">
										<label for="guests">Password<span class="text-danger">*</span> </label>
										<div class="row">
												<div class="col-12">
													<input type="password" name="password" class="form-control" placeholder="Password" required>
												</div>
										</div>
								</div>
								<div class="form-group mb-30">
										<label for="guests">Re-password<span class="text-danger">*</span> </label>
										<div class="row">
												<div class="col-12">
													<input type="password" name="re_password" class="form-control" placeholder="Re-password" required>
												</div>
										</div>
								</div>
								<div class="form-group mb-30">
										<label for="guests">Email<span class="text-danger">*</span> </label>
										<div class="row">
												<div class="col-12">
													<input type="text" name="email" class="form-control" placeholder="Email" required>
												</div>
										</div>
								</div>
							</div>
							<div class="col-12 col-lg-7">
								<div class="form-group mb-30">
												<label for="guests">Name </label>
												<div class="row">
														<div class="col-12">
															<input type="text" name="name" class="form-control" placeholder="Name" value="" >
														</div>
												</div>
										</div>
										<div class="form-group mb-30">
												<label for="guests">Phone number</label>
												<div class="row">
														<div class="col-12">
															<input type="text" name="phone" class="form-control" placeholder="Phone number" value="" >
														</div>
												</div>
										</div>
										<div class="form-group mb-30">
												<label for="guests">Address</label>
												<div class="row">
														<div class="col-12">
															<textarea name="address" rows="5" class="form-control" placeholder="Address" value="" ></textarea>
														</div>
												</div>
										</div>
										<div class="form-group">
												<input type="checkbox" name="policy" value="check" checked> agreed <a href="#" class="text-primary" >the policies.</a> <br>
												<button type="submit" class="btn roberto-btn w-25">Register</button>
										</div>
							</div>
					</div>
				</form>
			</div>
	</div>
	<!-- Items Area End -->
@stop
