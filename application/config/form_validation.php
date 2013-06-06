<?php

$config = array(

    'signup' => array(
        array(
            'field'   => 'username',
            'label'   => 'Username',
            'rules'   => 'trim|required|min_length[3]|max_length[15]|is_unique[users.name]'
        ),
        array(
            'field'   => 'password',
            'label'   => 'Password',
            'rules'   => 'trim|required|min_length[6]'
        ),
        array(
            'field'   => 'pwordconf',
            'label'   => 'Password confirmation',
            'rules'   => 'trim|required|matches[password]'
        ),
        array(
            'field'   => 'email',
            'label'   => 'Email Address',
            'rules'   => 'trim|required|valid_email|is_unique[users.email]'
        ),
        array(
            'field'   => 'pet',
            'label'   => 'Pet',
            'rules'   => 'trim|callback__pet_required'
        ),
        array(
            'field'   => 'avatar',
            'label'   => 'Character',
            'rules'   => 'trim|callback__avatar_required'
        )
    )
);