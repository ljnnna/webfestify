<?php

return [

'sitekey' => env('NOCAPTCHA_SITEKEY'),

'secret' => env('NOCAPTCHA_SECRET'),

'options' => [
    'theme' => 'light',
    'type'  => 'image',
    'size'  => 'normal',
    'callback' => null,
    'expired-callback' => null,
    'error-callback' => null,
],
];
