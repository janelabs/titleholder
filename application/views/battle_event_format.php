[
    {
        "x": <?php echo $x_pos; ?>,
        "y": <?php echo $y_pos; ?>,
        "id": "<?php echo $m_id; ?>",
        "name": "<?php echo $name; ?>"
    },

    [
        {

            "character_hue": "<?php echo $avatar; ?>","pattern": 2,
            "trigger": "action_button",
            "direction": "<?php echo $directions_1; ?>",
            "frequence": 4,
            "type": "fixed",
            "through": false,
            "stop_animation": false,
            "no_animation": false,
            "direction_fix": false,
            "alwaysOnTop": true,
            "speed": 4,
            "commands": [
                "SHOW_TEXT: {'text': '<?php echo $msg1; ?>'}",
                "SELF_SWITCH_ON: 'A'"
            ]
        },

        {
            "conditions": {"self_switch": "A"},
            "character_hue": "<?php echo $avatar; ?>","pattern": 0,
            "trigger": "action_button",
            "direction": "<?php echo $directions_2; ?>",
            "frequence": 4,
            "type": "fixed",
            "through": false,
            "stop_animation": false,
            "no_animation": false,
            "direction_fix": false,
            "alwaysOnTop": true,
            "speed": 4,
            "commands": [
                "SHOW_TEXT: {'text': '<?php echo $msg2; ?>'}"
                <?php echo $eventCall; ?>
            ]
        }
    ]
]