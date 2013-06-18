var Arena = {
    initView: function() {
        var site_url = $('#site_url').val();

        var player_filename = $('#avatar_file').val();
        var load_path = $('#hcore').val();
        var rpg;
        var battle_events = [];

        $('.events').each(function(key, val){
            battle_events.push($(this).val());
        });

        RPGJS.loadPath = load_path;
        RPGJS.load(function() {
            rpg = new Rpg("canvas_rpg");

            rpg.loadMap('MAP001', {
                tileset: 'tilea1.png',
                events: ['EV001', 'EV002'].concat(battle_events),
                player:  {
                    x: 26,
                    y: 19,
                    filename: player_filename
                }
            }, function () {
                rpg.player.setTypeMove("tile");
                rpg.setScreenIn("Player");

                rpg.onEventCall("battle", function(){
                    var enemy_id = $(this)[0].id;
                    rpg.removeEvent(enemy_id);

                    $.ajax({
                        url: site_url + 'battle',
                        type: 'POST',
                        data: {
                            id: enemy_id
                        },
                        success: function(result) {
                            if (result) {
                                $('#battle').html(result);
                                $('#battle').modal();
                            }
                        }
                    });

                    rpg.refreshMap();
                    $.post(site_url + "arena/replaceevent", {id: enemy_id}, function(){
                        rpg.addEventAjax('MAP001/EVREP/EV_REP_'+enemy_id);
                    });
                });
            });

            Input.lock(rpg.canvas, true);
        });
    },

    battleInitView: function() {
        // allocate attribute points
        $('#ap_form').on('submit',function(e){

            // disable buttons while waiting for server response
            $('#ap_form .btn').addClass('disabled').attr('disabled','disabled');

            param = $(this).serialize();
            action = $(this).attr('action');

            $.post(action, param, function(data){
                $('#ap_form .btn').removeClass('disabled').removeAttr('disabled');
                alert(data.message);
                $('#attk, #def, #hp').val(0);
            },'json');

            e.preventDefault();
        });

        // if input is not numeric, change to 0
        $('#attk, #def, #hp').on('keyup',function(){
            var input = $(this).val();
            var is_numeric = $.isNumeric(input);
            if (!is_numeric) {
                $(this).val(0);
            }
        });

        // plus-minus function for those who don't like to use the keyboard
        $('#attk-p, #def-p, #hp-p, #attk-m, #def-m, #hp-m').on('click',function(event){

            var btns = event.target.id;
            var btn = btns.split('-');
            var total_ap = parseInt($('#attr_points').text());
            var txt_val = ($('#'+btn[0]).val()) ? $('#'+btn[0]).val() : 0;
            var value = 0;

            // if method is plus
            if (btn[1] == 'p') {
                if(total_ap) {
                    value = parseInt(txt_val) + 1;
                    total_ap = total_ap - 1;

                    $('#'+btn[0]).val(value);
                }
            }

            // if method is minus
            if (btn[1] == 'm') {
                if(txt_val > 0) {
                    value = parseInt(txt_val) - 1;
                    total_ap = total_ap + 1;
                }

                $('#'+btn[0]).val(value);
            }

            $('#attr_points').text(total_ap);

        });
    }
};

