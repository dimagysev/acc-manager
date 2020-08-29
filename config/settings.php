<?php

return [
    'global_salt' => base64_encode(env('GLOBAL_SALT', 'default_salt')),
];
