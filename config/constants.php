<?php

return [
    //user status
    'inactive' => 0,
    'active' => 1,
    'on_hold' => 2,

    // user roles
    'admin_role' => 1,
    'user_role' => 2,
    'salon_role' => 3,

    // gender consts
    'man' => 1,
    'woman' => 2,
    'other' => 3,

    // otp statuses
    'inactive_otp' => 0,
    'active_otp' => 1,
    // otp statuses

    // otp types
    'register_otp' => 1,
    'login_otp' => 2,
    'forgot_password_otp' => 3,
    'others_otp' => 4,
    // otp types

    // otp expires
    'otp_expires_in' => 300,
    // otp expires

    // User Profile image path
    'user_profile_path' => '/assets/users/profile_images/', // need to append "userId.email" folder name after this path
    'salon_owners_images_path' => '/assets/users/salon/owners/images/',
    'salon_logo_path' => '/assets/users/salon/logos/',
    'salon_banner_path' => '/assets/users/salon/banners/',
];
