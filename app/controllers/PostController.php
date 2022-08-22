<?php

namespace App\Controllers;
use \PDO;
use App\Models\Post;
use App\Models\Cathegory;

class PostController {
    protected $layout = 'layout/index.tpl.php';
    public $content ='';

    protected $conn;
    protected $Post;
   // protected $Cat;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
        $this->Post = new Post($conn);
        $this->Cat = new Cathegory($conn);
    }

    public function display() {
        require $this->layout;
    }

    public function getPosts()  {
        $posts = $this->Post->all();
       // $cats = new Cathegory($this->conn);
       // $cats = $cats->allpostid($postid);
        $this->content =  view('posts', compact('posts', ));
    }

    public function show( $postid ) {
        $post = $this->Post->find($postid);

       // $cats = $this->Cat->allpostid($postid);
        $this->content = view('post', compact('post'));
    }

    public function getPostsYear() {
        $posts = $this->Post->year($_POST);
        $this->content =  view('posts', compact('posts'));
    }

    public function getPostsYesterday() {
        $posts = $this->Post->yesterday();
        $this->content =  view('posts', compact('posts'));
    }

    public function cercadata() {
        $posts = $this->Post->perdata($_POST);
        $this->content = view('cercaData',compact('posts'));
    }
    public function cerca() {
        $posts = $this->Post->perdata($_POST);
        $this->content = view('cerca',compact('posts'));
    }

    public function sommaTot() {
        $somma = $this->Post->somma();
        return $somma;
    }

    public function edit( $postid ) {
        $post = $this->Post->find($postid);

        $cats = $this->Cat->all();
        $this->content =  view('editPost', compact('post','cats'));
    }

    public function create() {
        $cats = $this->Cat->all();
        $this->content = view('newPost', compact('cats'));
    }

    public function save() {
        $this->Post->save($_POST);
        redirect('/');
    }

    public function store(string $id) {
        try {
            $result = $this->Post->store($_POST);
            redirect('/');
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete( $id){
        try {
            $result = $this->Post->delete((int)$id);
            redirect('/');
        } catch (PDOException $e){
            return $e->getMessage();
        }
    }

    public function getCategory() {
        $posts = $this->Post->allCat();
        $this->content = view('categorie', compact('posts'));
    }

}