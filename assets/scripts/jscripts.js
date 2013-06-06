$(document).ready(function(){
    $('#signup,#login').submit(function(e){

        var form = e.target.id;
        var param = $(this).serialize();
        var action = $(this).attr('action');

        $('#'+form+'_message').html('Processing...');

        $.post(action,param,function(data){

            if(!data.status) {
                $('#'+form+'_message').empty();
                $.each(data.errors,function(key,val){
                    $('#'+key).html(val);
                });
            } else {
                $('#'+form+'_message').html(data.message);
                // redirect next ??
            }

        },'json');

        e.preventDefault();
    });
});