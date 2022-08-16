<?php

namespace App\Models;
use \PDO;

class Cathegory
{
    protected $conn;

    public function __construct(PDO $conn)    {
        $this->conn = $conn;
    }

    public function all()    {
        $result = [];
        $stm = $this->conn->query('select * from categorie ORDER BY descriz_cat ASC;');

        if($stm && $stm->rowCount()){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }


}