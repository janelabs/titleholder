$(document).ready(function(){


    // hide radio on registration
    $('.options input:radio').addClass('radio_hidden');

    $('.options').click(function() {
        $(this).addClass('opt_selected').siblings().removeClass('opt_selected');
    });
    $('.close').click(function() {
        $('.alert').hide();
    })

    $('#signup,#login').submit(function(e){
        $('input').tooltip('destroy');
        var form = e.target.id;
        var param = $(this).serialize();
        var action = $(this).attr('action');

        $('.vspan').empty();
        // TODO: use each
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if($("input[name=email]").val() == ""){

            $("input[name=email]").tooltip({
                title: "Please provide valid email",
                placement: "right",
                trigger: "manual"
            });
            $("input[name=email]").tooltip('show');

        } else if($("input[name=password]").val() == ""){

            $("input[name=password]").tooltip({
                title: "Please provide password",
                placement: "right",
                trigger: "manual"
            });
            $("input[name=password]").tooltip('show');

        }else{

        $.post(action,param,function(data){
            var btn = $('#login-btn');
            btn.button('loading');
            if(!data.status) {
                $('#'+form+'_message').empty();
                $.each(data.errors,function(key,val){
                    $("input[name=" + key + "]").tooltip({
                        title: val,
                        placement: "right",
                        trigger: "manual"
                    });
                    $("input[name=" + key + "]").tooltip('show');
                });

                btn.button('reset');

            } else {
                $('#'+form+'_message').html(data.message);
                $(".msgcontainer").css("visibility","visible");
                $('.alert').show();
                btn.button('reset');
                if(data.success) {
                    setTimeout(function(){
                        window.location.href = data.location;
                    },2000);
                }
            }
        },'json');

        }
        e.preventDefault();
    });

    $('.log_nav').click(function(e){
        action = $(this).attr('href');

        $('#logs_window').html('Loading content...')
        $.get(action,function(data){
            $('#logs_window').html(data);
        });
        e.preventDefault();
    });

    $('#rankTab a:first').tab('show');
    $('#rankTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })


    $('#sound').click(function() {
        var bgm = $("#arenabgm");
        if ($(this).hasClass("sound-play")) {
            $(this).removeClass('sound-play');
            $(this).addClass('sound-mute');
            bgm.get(0).pause();

        }
        else {
            $(this).removeClass('sound-mute');
            $(this).addClass('sound-play');
            bgm.get(0).play();
        }

        //setCookie("rpg-volume", val);
    });

});