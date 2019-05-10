@extends('Frontend.layouts.master')
@section('content')
	<!-- Items Area Start -->
	<div class="roberto-news-area section-padding-100-0">
			<div class="container">
					<div class="row justify-content-center">
						<!-- Empty Area Start -->
						<div class="col-12 col-lg-5">
							<div class="post-thumbnail mb-100">
									<img src="{{asset('/blog/img/bg-img/39.jpg')}}" alt="">
							</div>
						</div>
						<!-- Login Area Start -->
							<div class="col-12 col-lg-7">
								<form action="{{action('Frontend\PageController@postLogin')}}" method="post" enctype="multipart/form-data">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
										<div class="form-group mb-30">
												<label for="checkInDate">Username or email<span class="text-danger">*</span> </label>
												<div >
														<div class="row">
																<div class="col-12">
																		<input type="text" class="form-control" name="username" placeholder="Username or email" required autofocus>
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
										<div class="form-group">
												<button type="submit" class="btn roberto-btn w-25">Login</button>
										</div>
								</form>
							</div>

					</div>
			</div>
	</div>
	<!-- Items Area End -->
@stop
