<?php

return [
    'class' => 'yii\db\Connection',
    'charset' => 'utf8',

    'dsn' => 'mysql:host=localhost;dbname=intensivkurs', // dev
    'username' => 'root',
    'password' => '',

//    'dsn' => 'mysql:host=localhost;dbname=iefsfvbw_intensivkurs', // prod
//    'username' => 'iefsfvbw_intensivkusr',
//    'password' => '?lIGJDzG2,m&',


    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
