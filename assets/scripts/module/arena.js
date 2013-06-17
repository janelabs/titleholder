var Arena = {
    initView: function() {

        var player_filename = $('#avatar_file').val();
        var load_path = $('#hcore').val();
        var rpg;

        RPGJS.loadPath = load_path;
        RPGJS.load(function() {
            rpg = new Rpg("canvas_rpg");

            rpg.loadMap('MAP001', {
                tileset: 'tilea1.png',
                events: ['EV001', 'EV002', 'EV005', 'EV006', 'EV007'],
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
                    Arena.battle(enemy_id);
                });

            });

            Input.lock(rpg.canvas, true);
        });
    },

    battle: function(enemy_id) {
        var site_url = $('#site_url').val();
        enemy_id = enemy_id > 0 ? enemy_id:0;
        // put transition here
            // transition
        // end transition

        $.ajax({
            url: site_url + 'battle',
            type: 'POST',
            data: {
                id: enemy_id
            },
            success: function(result) {
                if (result) {
                    $('#battle').html(result);
                    $('#battle').modal({backdrop: 'static', keyboard: false});
                }
            }
        });
    }
//    // mute is 0. on is 1
//    toggleSound: function(val){
//        Arena.setVolumeAudio(val);
//    }
};

