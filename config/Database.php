<?php
namespace config;

/*
 * class Conf containing config variables, array variables
 */
class Database
{

    public function getDatabaseParameters()
    {
        /*config variables array 'databaseParameters'*/
        $databaseParameters = [
            'host' => "localhost",
            'name' => "root",
            'password' => "",
            'database' => "modera_test",
        ];
        $result = $databaseParameters;

        return $result;
    }

}