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
                events: ['EV001', 'EV002', 'EV003', 'EV005', 'EV006', 'EV007'],
                player:  {
                    x: 26,
                    y: 18,
                    filename: player_filename
                }
            }, function () {
                rpg.player.setTypeMove("tile");
                rpg.setScreenIn("Player");

                rpg.onEventCall("battle", function(){
                    Arena.battle();
                });
            });

            Input.lock(rpg.canvas, true);
        });
    },

    battle: function() {
        var site_url = $('#site_url').val();

        // put transition here
            // transition
        // end transition
        alert(site_url);

        $.ajax({
            url: site_url,
            success: function(result) {

            }
        });
    }
};