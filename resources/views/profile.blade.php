<title>User Profile</title>
<link rel="icon" type="image/png" href="{!! asset('appImage/icon.png') !!}"/>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
@include('profileStyle')
<div class="container ">
	
	<div class="row">
		<div class="justify-content-center">

            <div class="card hovercard">
                <div class="cardheader">

                </div>
                <div class="avatar">
					
					@if (isset(Auth::user()->image))
						<img alt="" src="{{ asset('userImage/'.Auth::user()->image) }}">
					@else
						<img alt="" src="{{ asset('userImage/noProfile.jpg') }}">
					@endif
                </div>
                <div class="info">
                    <div class="title">
					<a target="_blank" href="https://scripteden.com/">{{Auth::user()->name}}</a>
                    </div>
                    <div class="desc">{{Auth::user()->email}}</div>
                    {{-- <div class="desc">Curious developer</div>
                    <div class="desc">Tech geek</div> --}}
                </div>
                <div class="bottom">
                    <a class="btn btn-primary btn-twitter btn-sm" href="https://twitter.com/webmaniac">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" rel="publisher"
                       href="https://plus.google.com/+ahmshahnuralam">
                        <i class="fa fa-google-plus"></i>
                    </a>
                    <a class="btn btn-primary btn-sm" rel="publisher"
                       href="https://plus.google.com/shahnuralam">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" rel="publisher" href="https://plus.google.com/shahnuralam">
                        <i class="fa fa-behance"></i>
                    </a>
				</div>
				<div>
				<form action="{{route('Updateprofile')}}" method="post" enctype="multipart/form-data">
					@csrf
					<label for="on_your_mind"><kbd>What's On Your Mind :</kbd>&nbsp&nbsp</label><input class="omMind" type="text" name="on_your_mind" id="on_your_mind" style="margin: 0 auto;" value="{{ Auth::user()->on_your_mind }}">
                    <input type="file" id="image" name="image" style="margin: 0 auto;"> 
					<br>
					<button type="submit" class="btn-sm btn-info">Update Profile</button>
				</form>
					
				</div>
            </div>
            <div class="center-block">
                <a href="{{ route('chat') }}">
                    <button class=" btn-primary center-block"> Back To Chat</button>
                </a>
            </div>
        </div>
		@if(session()->has('message'))
			<div id="alert_message" class="alert alert-success" style="text-align: center">
				{{ session()->get('message') }}
			</div>
		@endif
	</div>
</div>
<script>
  $("#alert_message").fadeTo(1000, 500).slideUp(500, function(){
      $("#alert_message").alert('close');
  });
</script>