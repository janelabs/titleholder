var Arena = {
    initView: function() {
        var player_filename = 'c_03.png';
        var load_path = $('#hcore').val();
        var rpg;

        RPGJS.loadPath = load_path;
        RPGJS.load(function() {
            rpg = new Rpg("canvas_rpg");

            rpg.loadMap('MAP001', {
                tileset: 'tilea1.png',
                player:  {
                    x: 26,
                    y: 18,
                    filename: player_filename
                },
                bgm: {mp3: 'arena'}
            }, function () {
                rpg.player.setTypeMove("tile");
                rpg.setScreenIn("Player");
            });
        });
    }
};