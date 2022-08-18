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

    public function find($id) {

        $result = [];
        $sql = 'select * from categorie where id = :id';
        $stm = $this->conn->prepare($sql);
        $stm->execute(['id' => $id]);
        if($stm){
            $result = $stm->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function save(array $data = [])    {

        $sql = 'INSERT INTO categorie (descriz_cat)';
        $sql .= 'values (:descrizione)';

        $stm = $this->conn->prepare($sql);

        $stm->execute([
            'descrizione'=>  $data['descrizione'],
        ]);
        /* var_dump($data);*/

        return $stm->rowCount();
    }

    public function store(array $data = [])
    {
        $sql = 'UPDATE categorie SET descriz_cat =:descriz_cat';
        $sql .= ' WHERE id = :id';

        $stm = $this->conn->prepare($sql);

        $stm->execute([
                'id' => $data['id'],
                'descriz_cat' => $data['descriz_cat']
            ]
        );

        return $stm->rowCount();


    }


}