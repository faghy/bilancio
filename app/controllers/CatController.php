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
        $this->content =  view('categories', compact('cats'));
    }

    public function create() {
        $this->content = view('newCat');
    }

    public function save() {
        $this->Cat->save($_POST);
        redirect('/');
    }



}