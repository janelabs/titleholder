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
            "direction": "left",
            "frequence": 4,
            "type": "random",
            "through": false,
            "stop_animation": false,
            "no_animation": false,
            "direction_fix": false,
            "alwaysOnTop": false,
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
            "direction": "bottom",
            "frequence": 4,
            "type": "random",
            "through": false,
            "stop_animation": false,
            "no_animation": false,
            "direction_fix": false,
            "alwaysOnTop": false,
            "speed": 4,
            "commands": [
                "SHOW_TEXT: {'text': '<?php echo $msg2; ?>'}",
                "CALL: 'battle'"
            ]
        }
    ]
]