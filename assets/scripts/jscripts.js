$(document).ready(function(){

    // hide radio on registration
    $('.options input:radio').addClass('radio_hidden');

    $('.options').click(function() {
        $(this).addClass('opt_selected').siblings().removeClass('opt_selected');
    });


    $('#signup,#login').submit(function(e){

        var form = e.target.id;
        var param = $(this).serialize();
        var action = $(this).attr('action');

        $('#'+form+'_message').html('Processing...');
        $('.vspan').empty();

        $.post(action,param,function(data){

            if(!data.status) {
                $('#'+form+'_message').empty();
                $.each(data.errors,function(key,val){
                    $('#'+key).html(val);
                });
            } else {
                $('#'+form+'_message').html(data.message);

                if(data.success) {
                    setTimeout(function(){
                        window.location.href = data.location;
                    },2000);
                }

            }

        },'json');

        e.preventDefault();
    });
});