[
    {
        "x": <?php echo $x_pos; ?>,
        "y": <?php echo $y_pos; ?>,
        "id": "<?php echo $m_id; ?>",
        "name": "<?php echo $name; ?>"
    },
    [
        {
            "character_hue": "<?php echo $avatar; ?>",
            "pattern": 2,
            "trigger": "action_button",
            "direction": "<?php echo $direction; ?>",
            "frequence": 4,
            "type": "fixed",
            "through": false,
            "stop_animation": false,
            "no_animation": false,
            "direction_fix": false,
            "alwaysOnTop": false,
            "speed": 4,
            "commands":
            [
                "SHOW_TEXT: {'text': '<?php echo $msg; ?>'}",
                "CALL: 'battle'"
            ]
        }
    ]
]