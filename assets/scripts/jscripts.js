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
                if(data.success) {$("#msg").addClass('alert-success');}else{$("#msg").addClass('alert-error');}

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

        $('#logs_window').html('Loading content...');
        $.get(action,function(data){
            $('#logs_window').html(data);
        });
        e.preventDefault();
    });

    $('#rankTab a:first').tab('show');
    $('#rankTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });


    $('#sound').click(function() {
        var bgm = $("#arenabgm");
        var val = 1;
        if ($('#soundicon').hasClass("icon-volume-up")) {
            $('#soundicon').removeClass('icon-volume-up');
            $('#soundicon').addClass('icon-volume-off');
            bgm.get(0).pause();
            val = 0;

        }
        else {
            $('#soundicon').removeClass('icon-volume-off');
            $('#soundicon').addClass('icon-volume-up');
            bgm.get(0).play();
            val = 1;
        }

        setCookie("rpg-volume", val);
    });

    var cookie = getCookie();
    if (cookie['rpg-volume'] == 0) {
        $('#sound').trigger("click");
    }


    // manual close button of battle modal
    $('#close').click(function(e){
        $('#battle').modal('hide');
        $('#result').hide();

        // return focus on the arena
        Input.lock(rpg.canvas, true);
    });

    // battle module attack action
    $('#atk').submit(function(e){
        // temporary disable attack button while waiting for server response
        $('#attack').addClass('disabled').attr('disabled','disabled');

        var action = $(this).attr('action');
        var param = $(this).serialize();

        $.post(action,param,function(response){
            $('#attack').removeClass('disabled').removeAttr('disabled');

            if(response.status) {
                //$('#debugger').html(JSON.stringify(response));

                $('#player_hp_div').html(response.player.hp);
                $('#enemy_hp_div').html(response.enemy.hp);

                $('#player_hp').val(response.player.hp);
                $('#enemy_hp').val(response.enemy.hp);

                updateHPBars('player_bar',response.player.hp_percent);
                updateHPBars('enemy_bar',response.enemy.hp_percent);

                if(response.player.is_dead && response.result) {
                    $('#attack').hide();
                    $('#result').html(response.result).fadeIn('fast');

                    setTimeout(function(){
                        $('#result').fadeOut('fast',function(){
                                $('#close').show();
                            }
                        );
                    },2000);
                }

                if(response.enemy.is_dead && response.result) {
                    $('#result')
                    .html(response.result)
                    .fadeIn('fast',function(){
                        $('#attack').hide();
                    })
                    .delay(1000)
                    .fadeOut('fast',function(){

                        if(response.has_levelup && response.has_rank) {

                            $('#result')
                            .html('You gained the rank '+response.rank_name)
                            .fadeIn('fast')
                            .delay(2000)
                            .fadeOut('fast',function(){
                                $('#result')
                                .html('You have level up!')
                                .fadeIn('fast')
                                .delay(2000)
                                .fadeOut(function(){
                                    $('#attr_points').html(response.ap);
                                    $('#ap_modal').removeData("modal").modal({backdrop: 'static', keyboard: false})
                                    $('#battle').modal('hide');
                                });
                            });

                        } else if(response.has_levelup) {

                            $('#result').html('You have level up!')
                            .fadeIn('fast')
                            .delay(2000)
                            .fadeOut(function(){
                                $('#attr_points').html(response.ap);
                                $('#ap_modal').removeData("modal").modal({backdrop: 'static', keyboard: false})
                                $('#battle').modal('hide');
                            });

                        } else if(response.has_rank) {

                            $('#result')
                            .html('You gained the rank '+response.rank_name)
                            .fadeIn('fast')
                            .delay(2000)
                            .fadeOut('fast',function(){
                                $('#close').show();
                            });

                        }


                    });
                }
            }
        },'json');

        e.preventDefault();
    });



    var cookie = getCookie();
    if (cookie == 0) {
        $('#sound').trigger("click");
    }

});

function updateHPBars(pbar_id,percent_to) {

    // get width in percentage, will result in n%
    var str = $('#'+pbar_id+' .bar')[0].style.width;

    var percent_from = str.slice(0,-1);

    while(percent_from > percent_to) {
        percent_from--;
        $('#'+pbar_id+' .bar').css('width',percent_from+'%');
    }
}


function setCookie (name, value) {
    var expire = new Date() ;
    expire.setTime(new Date().getTime() + 60*60*24*14);
    document.cookie = name + "=" + value + ";expires=" + expire.toGMTString();
}
function getCookie()
{
    var c_name = 'rpg-volume'
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1)
    {
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1)
    {
        c_value = 1;
    }
    else
    {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1)
        {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
}

function changeBGM(sound){
    var src="/assets/Audio/BGM/" + sound;
    audio_core_ogg=$('#arenabgm').attr('src', src + '.ogg')[1]
    audio_core_ogg.play();

    audio_core_mp3=$('#arenabgm').attr('src', src + '.mp3')[0]
    audio_core_mp3.play();
}
