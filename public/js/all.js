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
			var reciverId = $('#reciverId').val();
			
			setInterval(function() {

				$('#recive_User').load(" #recive_User");
				$('#msgBody').load(" #msgBody");
				// $('#userList').load(" #userList");
				$('#loginUser').load(" #loginUser");
				$('#friendList').load(" #friendList");
				// $('#reqList').load(" #reqList");
				
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
            // alert(reciverId);
			if (reciverId == '') {
				$('#wrng_msg').text('no user selected');
			} else {
				// $('#wrng_msg').text('okky');
			}
			
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
		function chatWith(userId) {
			$('#reciverId').val(userId);
			// alert(userId);
			// $.ajax({
			// 	url: "{{route('chat')}}",
			// 	type: "get", //send it through get method
			// 	data: { ReciverID: userId, },
			// 	success: function(response) {
			// 		console.log(response);
			// 		//Do Something
			// 	},
			// 	error: function(xhr) {
			// 		//Do Something to handle error
			// 	}
			// });
			var url =window.location.href
			url = url.split("?");
			// window.location.replace(url[0]+'?ReciverID='+userId);
			// window.open(url[0]+'?ReciverID='+userId);
			window.history.pushState('', 
                     "", url[0]+'?ReciverID='+userId); 

		}
		//chatWith end

		function requestList(url) {
			alert('ok');
			$.ajax({
				url: url,
				type: "get", //send it through get method
				
				success: function(response) {
					console.log(response);
					//Do Something
					alert(response);
					$('#reqList').html(response );
					$('#friendList').hide();
					// $('#reqList').append(response );
				},
				error: function(xhr) {
					//Do Something to handle error
				}
			});
		}


		function friendtList() {
			// $('#friendList').show();
			$('#userList').load(" #userList");
		}