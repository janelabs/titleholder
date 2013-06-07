<?php
echo $header;
?>

<div id="player" style="display: block"><strong>Name: </strong><div id="player_name" style="display: inline" ></div></div><br />
<div ><strong>HP: </strong><div id="player_hp" style="display: inline"></div></div><br />
<br />

<h2>Enemy:</h2><br />
<div><strong>Name: </strong><div id="enemy_name" style="display: inline"></div></div><br />
<div><strong>HP: </strong><div id="enemy_hp" style="display: inline"></div></div><br />
<input type="button" id="attack" value="Attack!" />

<script type="text/javascript">
$("#attack").on("click", function(){
    $.post("<?php echo site_url('battle/view') ?>",{ id: "2" }, function(data) {
        $("#player_name").html(data.player.name);
        $("#enemy_name").html(data.enemy.name);
    },"json");
});
</script>

</body>
</html>