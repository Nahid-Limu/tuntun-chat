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
function chatWith(userId) {
    $('#reciverId').val(userId);
    
    $.ajax({
        url: "{{route('reciverid')}}",
        type: "get", //send it through get method
        data: { ReciverID: userId, },
        success: function(response) {
            console.log(response);
            //Do Something
        },
        error: function(xhr) {
            //Do Something to handle error
        }
    });
}
//chatWith end