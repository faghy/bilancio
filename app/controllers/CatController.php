<?php

namespace App\Controllers;
use \PDO;
use App\Models\Cathegory;

class CatController
{
    protected $layout = 'layout/index.tpl.php';
    public $content ='';
    protected $conn;

    protected $Cat;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
        $this->Cat = new Cathegory($conn);
    }

    public function display() {
        require $this->layout;
    }

    public function getCategories()    {
        $cats = $this->Cat->all();
        $this->content =  view('categorie', compact('cats'));
    }

    public function create() {
        $this->content = view('newCat');
    }

   /* public function editcat( $catid ) {
        $cats = $this->Cat->find($catid);
        $cats_all = $this->Cat->all();
        $this->content =  view('editCat', compact('cats','cats_all'));
    }*/

    public function save() {
        $this->Cat->save($_POST);
        redirect('/post/create');
    }

    public function store(string $id) {
        try {
            $result = $this->Cat->store($_POST);
            redirect('/categorie');
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete( $id){
        try {
            $result = $this->Cat->delete((int)$id);
            redirect('/categorie');
        } catch (PDOException $e){
            return $e->getMessage();
        }
    }




}