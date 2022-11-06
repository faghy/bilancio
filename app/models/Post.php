<?php
namespace App\Models;
use \PDO;

class Post {

    protected $conn;

    public function __construct(PDO $conn)    {
        $this->conn = $conn;
    }

    public function all() {
        $result = [];
        $stm = $this->conn->query('select * from movimenti as m INNER JOIN categorie as c ON m.categoria = c.cat_id WHERE YEAR ( datecreated ) = YEAR(CURDATE()) ORDER BY id DESC;');
//https://www.html.it/pag/65199/estrazione-dei-dati-e-paginazione/
        //https://github.com/hanielz/PHP-Pagination/blob/master/class/Config.php
   /*     $counter = $this->conn->query("SELECT COUNT(*) FROM movimenti");
        $row = $counter->rowCount();

        $perpage = 5;

        $page = 1;
        if(isset($_GET['page'])){ $page = filter_var($_GET['page'],FILTER_SANITIZE_NUMBER_INT); }
        $tot_pagine = ceil($row/$perpage);
        $pagina_corrente = $page;
        $primo = ($pagina_corrente-1)*$perpage;
        echo $primo;


        $stm = $this->conn->query('SELECT * FROM movimenti as m INNER JOIN categorie as c ON m.categoria = c.cat_id 
         WHERE YEAR ( datecreated ) = YEAR(CURDATE()) ORDER BY id DESC LIMIT '.$primo.','.$perpage.' ');
*/
        if($stm && $stm->rowCount()){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /*FUNGSI total_records() UNTUK MENGHITUNG BANYAKNYA DATA DALAM TABEL*/
    public function total_records()
    {
        $stmt = $this->conn->prepare("SELECT id FROM movimenti");
        $stmt->execute();
        return $stmt->rowCount();
    }

    /*FUNGSI get_data() UNTUK MENAMPILKAN DATA DI HALAMAN BROWSER*/
    public function get_data($start,$limit)
    {

        $stmt = $this->conn->prepare("SELECT * FROM movimenti LIMIT $start,$limit");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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

    public function year(array $year = []) {
        $result = $year;

        $sql2 = 'select sum(importo) from movimenti WHERE YEAR(datecreated) = :anno';
        $stm2 = $this->conn->prepare($sql2);
        $stm2->execute(['anno' => $result['anno']]);
        global $somma_anno;
        $somma_anno = $stm2->fetch(PDO::FETCH_COLUMN);


        $sql = 'select * from movimenti as m INNER JOIN categorie as c 
    ON m.categoria = c.cat_id WHERE YEAR ( datecreated ) = :anno ORDER BY id DESC';
     //   $stm = $this->conn->query('select * from movimenti WHERE YEAR ( datecreated ) = YEAR(:anno) ORDER BY id DESC');
        $stm = $this->conn->prepare($sql);

        $stm->execute(['anno' => $result['anno']]);
        global $contarow;
        $contarow = $stm->rowCount();
        if($stm && $stm->rowCount()){
            $result =  $stm->fetchAll(PDO::FETCH_OBJ);
           // die(var_dump($stm->errorInfo()));
            return $result;
        } else {
            header( "refresh:5; url=/" );
            die("<h2 style='text-align: center; color:red;'>Nessun dato disponibile per l'anno scelto!</h2>");
        }

    }

    public function yesterday() {
        $result = [];
        $stm = $this->conn->query('SELECT * FROM movimenti as m INNER JOIN categorie as c 
    ON m.categoria = c.cat_id WHERE DATE(datecreated) = DATE(NOW() - INTERVAL 1 DAY)');

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
      //  $result = []; ;
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
