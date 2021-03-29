<?php

return [
//    mysql:
        "driver" => "mysql",
        "class" => \app\factory\dbFactory\MySQLFactory::class,
        "host" => "localhost",
        "login" => "root",//"evgeniy",
        "password" => "123", //"Fx80788078123",
        "database" => "phpPatterns",
        "charset" => "utf8"
//    postgresql
//        "driver" => "pgsql",
//        "class" => \app\factory\dbFactory\PostgreSQLFactory::class,
//        "host" => "localhost",
//        "login" => "postgres",
//        "password" => "123",
//        "database" => "postgres"

//    "oracle" - не тестировал, т.к. установить не удалось :-(
//        "driver" => "oci",
//        "class" => \app\factory\dbFactory\OracleFactory::class,
//        "host" => "localhost",
//        "login" => "evgeniy",
//        "password" => "123",
//        "database" => "evgeniy",
];
