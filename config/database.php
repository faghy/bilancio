<?php
// PDO
return[
    'driver' => 'mysql', // può essere sqllite,mssql, oci
    'host' => 'localhost',
    'user' => 'bilancino_admin',
    'password' => 'Fagghy_Hacker20!',
    'database' => 'bilancino_DB',
    'dsn' =>'mysql:host=localhost;dbname=bilancino_DB;charset=utf8',
    'pdooptions' => [
        [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    ]
];