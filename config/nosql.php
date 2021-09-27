<?php
return [
  'defaults' => [
    'db_path' => env('DB_PATH', 'text_db_files'),
    'user_file' => env('USER_FILE', 'user.txt'),
    'password_file' => env('PASSWORD_FILE', 'password.txt'),
    'password_type_file' => env('PASSWORD_TYPE_FILE', 'password_type.txt'),
    'default_user' => [
      [
        "id" => env('DEFAULT_USER_ID', 'lDN00nMXN'),
        "username" => env('DEFAULT_USERNAME', 'root'),
        "password" => env('DEFAULT_USER_PASSWORD', '25d55ad283aa400af464c76d713c07ad'),
      ]
    ],
  ]
];