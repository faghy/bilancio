<?php

namespace App\Controllers;
use \PDO;
use App\Models\Post;

class PostController {
    protected $layout = 'layout/index.tpl.php';
    public $content ='';

    protected $conn;
    protected $Post ;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
        $this->Post = new Post($conn);
    }

    public function display() {
        require $this->layout;
    }

    public function getPosts()    {
        $posts = $this->Post->all();
        $this->content =  view('posts', compact('posts'));
    }

    public function getPostsYear()    {
        $posts = $this->Post->year();
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

    public function show( $postid )    {
         $post = $this->Post->find($postid);
        $this->content = view('post', compact('post'));
    }

    public function edit( $postid ) {
        $post = $this->Post->find($postid);
        $this->content =  view('editPost', compact('post'));
    }

    public function create() {
        $this->content = view('newPost');
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