<?php
namespace App\Models;
use \PDO;

class Post {

    protected $conn;

    public function __construct(PDO $conn)    {
        $this->conn = $conn;
    }

    public function all()    {
        $result = [];
        $stm = $this->conn->query('select * from movimenti as m INNER JOIN categorie as c ON m.categoria = c.cat_id WHERE YEAR ( datecreated ) = YEAR(CURDATE()) ORDER BY id DESC;');
       // $stm = $this->conn->query('select * from movimenti AS m JOIN categorie AS c ON m.categoria = c.id WHERE YEAR ( datecreated ) = YEAR(CURDATE()) ORDER BY id DESC;');
       // $stm = $this->conn->query('select * from movimenti as m INNER JOIN categorie as c ON m.categoria = c.id');

        if($stm && $stm->rowCount()){
            $result =  $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function find($id) {

        $result = [];
        $sql = 'select * from movimenti as m INNER JOIN categorie as c ON m.categoria = c.cat_id where id = :id';
        $stm = $this->conn->prepare($sql);
        $stm->execute(['id' => $id]);
        if($stm){
            $result = $stm->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function year($year) {
        $result = [];
        $sql = 'select * from movimenti WHERE YEAR ( datecreated ) = YEAR(:anno) ORDER BY id DESC';
     //   $stm = $this->conn->query('select * from movimenti WHERE YEAR ( datecreated ) = YEAR(:anno) ORDER BY id DESC');
        $stm = $this->conn->prepare($sql);
        $stm->execute(['anno' => $year]);
        die(var_dump($stm->errorInfo()));
        if($stm && $stm->rowCount()){
            $result =  $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    public function yesterday() {
        $result = [];
        $stm = $this->conn->query('SELECT * FROM movimenti as m INNER JOIN categorie as c ON m.categoria = c.cat_id WHERE DATE(datecreated) = DATE(NOW() - INTERVAL 1 DAY)');

        if($stm && $stm->rowCount()){
            $result =  $stm->fetchAll(PDO::FETCH_OBJ);
        }

        $sql2 = 'select sum(importo) from movimenti WHERE DATE(datecreated) = DATE(NOW() - INTERVAL 1 DAY)';
        $stm2 = $this->conn->prepare($sql2);
        $stm2->execute();
        $result2 = $stm2->fetch(PDO::FETCH_COLUMN);

        echo "<h2 class=\"h3-totale\">TOTALE : ";
        echo round($result2, 3);
        echo " €</h2>";
        return $result ;
    }

/*
    public function sommaIeri() {
        $result ;
        $sql = 'select sum(importo) from movimenti WHERE DATE(datecreated) = DATE(NOW() - INTERVAL 1 DAY)';
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_COLUMN);
        return $result;
    }*/

    public function perdata($data) {
        $result = [];
        if($data) {
            $sql = 'SELECT * FROM movimenti INNER JOIN categorie ON movimenti.categoria = categorie.cat_id WHERE DATE(datecreated) = DATE(:datecreated)';
            //$sql .= '2019-04-24)';

            $stm = $this->conn->prepare($sql);
            $stm->execute(['datecreated' => $data['data']]);

            if ($stm && $stm->rowCount()) {
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
            }

            $sql2 = 'SELECT sum(importo) FROM movimenti WHERE DATE(datecreated) = DATE(:datecreated)';
            $stm2 = $this->conn->prepare($sql2);
            $stm2->execute(['datecreated' => $data['data']]);
            $result2 = $stm2->fetch(PDO::FETCH_COLUMN);

            echo "<h2 class=\"h3-totale\">TOTALE : ";
            echo round($result2,3);
            echo " €</h2>";
            return $result;
        }
    }

    public function somma() {
        $result = []; ;
        $sql = 'select sum(importo) from movimenti';
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    public function save(array $data = [])    {

        $sql = 'INSERT INTO movimenti (categoria, descrizione, datecreated, entratauscita, importo)';
        $sql .= 'values (:categoria, :descrizione, :datecreated, :entratauscita, :importo)';

        $stm = $this->conn->prepare($sql);
       //die(var_dump($data));
        $stm->execute([
            'categoria' => $data['cat'],
            'descrizione'=>  $data['descrizione'],
           /* 'datecreated' => date('Y-m-d H:i:s'),*/
            'datecreated' => $data['data'],
            'entratauscita' => $data['inout'],
            'importo' => $data['importo'],
        ]);


    return $stm->rowCount();
    }

    public function store(array $data = [])
    {
        $sql = 'UPDATE movimenti SET entratauscita =:entratauscita, categoria =:categoria, descrizione =:descrizione, 
                     importo =:importo, datecreated =:datecreated WHERE id = :id';

        $stm = $this->conn->prepare($sql);

        $x = $stm->execute([
                'id' => $data['id'],
                'entratauscita' => $data['inout'],
                'categoria' => $data['cat'],
                'descrizione'=>  $data['descrizione'],
                'importo'=>  $data['importo'],
                'datecreated' => $data['datecreated']
            ]

        );
       // die(var_dump($stm->errorInfo()));
        return $stm->rowCount();
    }

    public function delete(int $id)
    {
        $sql = 'DELETE FROM movimenti WHERE id = :id';

        $stm = $this->conn->prepare($sql);
        $stm->bindParam(':id',$id, PDO::PARAM_INT);
        $stm->execute();

        return $stm->rowCount();
    }


}
