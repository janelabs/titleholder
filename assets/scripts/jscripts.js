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

    // manual close button of battle modal
    $('#close').click(function(e){
        $('#battle').modal('hide');
        Input.lock(rpg.canvas, true);
    });

    // battle module attack action
    $('#atk').submit(function(e){
        // temporary disable attack button while waiting for server response
        $('#attack').attr('disabled','disabled');

        var action = $(this).attr('action');
        var param = $(this).serialize();

        $.post(action,param,function(response){
            $('#attack').removeAttr('disabled');

            if(response.status) {
                $('#debugger').html(JSON.stringify(response));

                $('#player_hp_div').html(response.player.hp);
                $('#enemy_hp_div').html(response.enemy.hp);

                $('#player_hp').val(response.player.hp);
                $('#enemy_hp').val(response.enemy.hp);

                if(response.player.is_dead && response.result) {
                    $('#result').html(response.result).fadeIn('fast');
                }

                if(response.enemy.is_dead && response.result) {
                    $('#result').html(response.result).fadeIn('fast');
                    $('#attack').hide();

                    if(response.has_rank) {
                        setTimeout(function(){
                            $('#result').html('You gained the rank '+response.rank_name).hide().fadeIn('fast');
                        },2000);
                    }

                    if(response.has_levelup) {
                        setTimeout(function(){
                            $('#ap_modal').modal('show');
                            $('#battle').modal('hide');
                            $('#result').html('You have level up').hide().fadeIn('fast');
                        },2000);
                    }

                    setTimeout(function(){
                        $('#result').fadeOut('fast',function(){
                                $('#close').show();
                            }
                        );
                    },2000);
                }
            }
        },'json');

        e.preventDefault();
    });

    // allocate attribute points
    $('#ap_form').on('submit',function(e){

        param = $(this).serialize();
        action = $(this).attr('action');

        $.post(action, param, function(data){
            alert(JSON.stringify(data));
        });

        e.preventDefault();
    });

});