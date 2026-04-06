<?php

return [
    'title' => env('APP_NAME', 'Template Project'),
    'subtitle' => 'Software House',

    'logo_auth' => 'files/images/LOGO EXATA INDONESIA.svg',
    'logo_auth_background' => 'white',

    'logo_panel' => 'files/images/LOGO EXATA INDONESIA.svg',
    'logo_panel_background' => 'white',

    'registration_route' => 'register',
    'registration_default_role' => 'Super Admin',

    'forgot_password_route' => 'password.request',
    'reset_password_route' => 'password.reset',

    // 'email_verification_route' => 'verification.index',
    'email_verification_route' => '',
    'email_verification_delay_time' => 30,

    'email_verify_route' => 'verification.verify',

    'profile_route' => 'profile',
    'profile_image' => 'assets/media/avatars/profile.png',

    'menu' => [
        [
            'text' => 'Alur Pencairan',
            'route'  => 'alur_pencairan.index',
            'icon' => 'ki-duotone ki-element-11',
        ],
        [
            // 'id' => 'menu_admin'
            'text' => 'Alur Proses',
            'icon' => 'ki-duotone ki-shield-tick',
            'submenu' => [

                [
                    'text' => 'SPEED 20',
                    'route'  => 'alur_proses_speed_20.index',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'NORMAL',
                    'route'  => 'alur_proses_normal.index',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'PROSES 80',
                    'route'  => 'alur_proses_proses_80.index',
                    'icon_color' => 'success',
                ],
            ],
        ],
        [
            // 'id' => 'menu_admin'
            'text' => 'Admin',
            'icon' => 'ki-duotone ki-shield-tick',
            'submenu' => [
                [
                    'text' => 'Pengguna',
                    'route' => 'user.index',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Jabatan',
                    'route' => 'role.index',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Akses',
                    'route' => 'permission.index',
                    'icon_color' => 'primary',
                ],
            ],
        ],
    ],
];
