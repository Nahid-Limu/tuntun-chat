<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
    	@include('style')
    </head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div class="container-fluid h-100">
			<a href="{{ route('userlogout', Auth::user()->id) }}" class="btn btn-md btn-danger" style="float: right" >LogOut</a>
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
						<div class="card-header">
							<div class="input-group">
								<input type="text" placeholder="Search..." name="" class="form-control search">
								<div class="input-group-prepend">
									<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
								</div>
							</div>
						</div>
						{{-- chat list start --}}
						<div class="card-body contacts_body" id="userList">
							<ui class="contacts">
									<li class="active">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												@if (isset(Auth::user()->image))
													<img src="{{ asset('userImage/'.Auth::user()->image) }}" class="rounded-circle user_img">
												@else
													<img src="{{ asset('userImage/noProfile.jpg') }}" class="rounded-circle user_img">
												@endif

												<span class="online_icon"></span>
											</div>
											<div class="user_info">
												<span>Me</span>
												
												<p>{{Auth::user()->name}}  is online <br>
													<small >{{Auth::user()->on_your_mind}}</small>
												</p>
											</div>
										</div>
									</li>
								@foreach ($users as $user)
									@if($user->id != Auth::user()->id)

									<li class="active" onclick="chatWith('<?php echo $user->id;?>')">
										<div class="d-flex bd-highlight">
											<div class="img_cont">
												@if (isset($user->image))
													<img src="{{ asset('userImage/'.$user->image) }}" class="rounded-circle user_img">
												@else
													<img src="{{ asset('userImage/noProfile.jpg') }}" class="rounded-circle user_img">
												@endif

												<span class="{{ ($user->active_status == 1) ? "online_icon" : "online_icon offline" }}"></span>
											</div>
											<div class="user_info">
												<span> {{ ($user->name == Auth::user()->name) ? "Me" : "$user->name" }}</span>
												@php
													$updated_at = \Carbon\Carbon::parse($user->updated_at)->diffForHumans() ;
												@endphp
												
												<p>
													{{$user->name}} {{ ($user->active_status == 1) ? " is online" : "left $updated_at" }}
													<br>
													<small >{{$user->on_your_mind}}</small>
												</p>
											</div>
										</div>
									</li>

									@else
										    
									@endif
									
								@endforeach
							</ui>
						</div>
						{{-- chat list end --}}
						<div class="card-footer"></div>
					</div>
				</div>

				{{-- chat body start --}}
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" id="user_profile_btn" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								
								<div class="user_info">
									<span>Chat with Mr X</span>
									<p>1767 Messages</p>
								</div>
								<div class="video_cam">
									<span id="msg_delivery_status" class="text-success"></span>
								</div>
								<!-- <div class="video_cam" style="margin-left: 150px;" >
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
                                </div> -->
                                
							</div>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li>
										<a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i> View profile</a>
									</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>
							<div class="profile_menu action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
								</ul>
							</div>
						</div>
						<div class="card-body msg_card_body" id="msgBody">
							
							
                            @php
								$mytime = Carbon\Carbon::now();
							@endphp
							@foreach ($chats as $chat)
							@if ($chat->user_id == Auth::user()->id)
								<div class="d-flex justify-content-start mb-4">
                                    <div class="img_cont_msg">
										@if (isset(Auth::user()->image))
											<img src="{{ asset('userImage/'.Auth::user()->image) }}" class="rounded-circle user_img_msg">
										@else
											<img src="{{ asset('userImage/noProfile.jpg') }}" class="rounded-circle user_img_msg">
										@endif
                                        
                                    </div>
                                    <div class="msg_cotainer">
                                        {{$chat->message}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="msg_time"><br>{{Carbon\Carbon::parse($chat->created_at)->toTimeString()}}</span>
                                    </div>
                                </div>
							@else
								<div class="d-flex justify-content-end mb-4">
									<div class="msg_cotainer_send">
										{{$chat->message}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<span class="msg_time_send">{{Carbon\Carbon::parse($chat->created_at)->toTimeString()}}</span>
									</div>
										<div class="img_cont_msg">
										<img src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg" class="rounded-circle user_img_msg">
										</div>
								</div>
							@endif
                                
                            @endforeach
						</div>
						<div class="card-footer">
							<div class="input-group">
								<div class="input-group-append">
									<span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
								</div>
								<input type="hidden" name="reciverId" id="reciverId" value="">
								<textarea name="" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn"><i class="fas fa-location-arrow" style="color: aqua;"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{-- chat body end --}}
				<p class="text-center">TunTun Chat <kbd>Version 1.2</kbd> Update comming soon</p>
			</div>
			
		</div>
    </body>
    <script>
		$(document).ready(function(){
            $('#action_menu_btn').click(function(){
                $('.action_menu').toggle();
            });
        });
		$(document).ready(function(){
            $('#user_profile_btn').click(function(){
                $('.profile_menu').toggle();
            });
        });

		$(document).ready(function() {
			setInterval(function() {
				$('#userList').load(" #userList");
				$('#msgBody').load(" #msgBody");
				// $('#msgBody').scrollTop($('#msgBody')[0].scrollHeight);
			}, 3000);  //Delay here = 3 seconds 
		});
        $('#msgBody').scrollTop($('#msgBody')[0].scrollHeight);
    	
        //sent msg start
        $('.send_btn').click(function() {
            var _token = '{{ csrf_token() }}';
            // var myData = $('#create_course_modal_form').serialize();
            var msg = $('.type_msg').val();
			var reciverId = $('#reciverId').val();
            alert(reciverId);
            $.ajax({
                url:"{{route('sentMsg')}}",
                method:"post",
                data: { msg: msg, reciverId: reciverId, _token: _token },
                success:function (response) {
                    console.log(response);
                    // alert(response);
                     $('.type_msg').val('');
                     $('#msg_delivery_status').html('sent');
                     $("#msg_delivery_status").fadeTo(1000, 500).slideUp(500, function(){
                        // $("#msg_delivery_status").alert('close');
                    });
                    $("#msgBody").load(" #msgBody");
					$('#msgBody').scrollTop($('#msgBody')[0].scrollHeight);
                    
                }
            });
        });
		//sent msg end

		//chatWith Start
		function chatWith($userId) {
			var reciverId = $('#reciverId').val($userId); 
			alert($userId);
		}
		//chatWith end
    </script>
</html>
