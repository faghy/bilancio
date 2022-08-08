<?php

namespace App\DB;
use App\DB\DBPDO;

class DbFactory
{
    public static function create(array $options)
    {
        if(!array_key_exists('charset', $options)) {
            $options['charset'] = 'utf8';
        }
        if(!array_key_exists('dsn',$options)) {
            if (!array_key_exists('driver', $options)) {
                throw  new \InvalidArgumentException('Nessun driver predefinito');
            }

            $dsn = '';

            switch ($options['driver']) {
                case 'mysql':
                case 'oracle':
                case 'mssql':
                    $dsn = $options['driver'].':host='. $options['host'];
                    $dsn .= ';dbname=' .$options['database'].';charset='.$options['charset'];
                    break;
                case 'sqlite':
                    $dsn = 'sqlite' . $options['database'];
                    break;
                default :
                    throw  new \InvalidArgumentException(' driver non impostato o sconosciuto');
            }
            $options['dsn'] = $dsn;
        }

        return DBPDO::getInstance($options);
    }
}