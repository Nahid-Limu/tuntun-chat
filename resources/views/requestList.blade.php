@foreach($friendsRequest as $fr)
    {{-- <option value="{{$fr->id}}">{{$fr->name}}</option> --}}
    <li class="active" onclick="chatWith('<?php echo $fr->id;?>')">
        <div class="d-flex bd-highlight">
            <div class="img_cont">
                @if (isset($fr->image))
                    <img src="{{ asset('userImage/'.$fr->image) }}" class="rounded-circle user_img">
                @else
                    <img src="{{ asset('userImage/noProfile.jpg') }}" class="rounded-circle user_img">
                @endif

                <span class="{{ ($fr->active_status == 1) ? "online_icon" : "online_icon offline" }}"></span>
            </div>
            <div class="user_info">
                <span> {{ ($fr->name == Auth::user()->name) ? "Me" : "$fr->name" }}</span>
                @php
                    $updated_at = \Carbon\Carbon::parse($fr->updated_at)->diffForHumans() ;
                @endphp
                
                <p>
                    {{$fr->name}} {{ ($fr->active_status == 1) ? " is online" : "left $updated_at" }}
                    <br>
                    <small >{{$fr->on_your_mind}}</small>
                </p>
            </div>
            <div class="user_info">
                <button onclick="" class="btn btn-sm btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
                <button onclick="" class="btn btn-sm btn-danger"><i class="fa fa-times" aria-hidden="true"></i> </button>
            </div>
        </div>
    </li>
@endforeach