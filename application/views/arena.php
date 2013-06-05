<!DOCTYPE html>

<html>
    <head>
        <title>TitleHolder</title>

        <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/scripts/rpgJs/rpg-beta-2.js'); ?>"></script>
        <script type="text/javascript">
            var rpg;
            RPGJS.loadPath = "<?php echo base_url('assets/scripts/rpgJs/core/'); ?>";
            RPGJS.load(function() {
                rpg = new Rpg("canvas_rpg");
                rpg.loadMap('MAP001', {
                    tileset: 'tilea1.png',
                    player:  {
                        x: 26,
                        y: 18,
                        filename: 'c_03.png'
                    }
                }, function () {
                    //rpg.playBGM({mp3: 'arena'});
                    rpg.player.setTypeMove("tile");
                    rpg.setScreenIn("Player");
                });
            });
        </script>
    </head>

    <body style="margin: 0; overflow: hidden; background-color: #000;">
    <canvas id="canvas_rpg" width="640px" height="480px" style="margin-top: 10;"></canvas>
    </body>
</html>