<?php

namespace App\Controllers;
use \PDO;
use App\Models\Post;


class PostController2 {

    protected $layout = 'layout/index.tpl.php';
    protected $conn;

    public function __construct(PDO $conn)    {
        $this->conn = $conn;

        $this->Post = new Post($conn);

        /*return view('posts', ['posts' => $posts]);
         return $this->content = view('posts', compact('posts'));*/
    }

    public function dispatch() {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = trim($url, '/');

        $tokens = explode('/',$url);
        $action = $tokens[0];
        $token2 = isset($tokens[1])?$tokens[1]:'';

        switch ($action) {
            case 'posts':
                $this->content = call_user_func(array($this, 'getPosts'));
                break;
            case 'post':

                if($_SERVER['REQUEST_METHOD'] === 'GET') {
                    //$this->content = call_user_func(array($this, 'show'),$tokens[1]);
                    if ($token2) {
                        if (is_numeric($token2)) {
                            $this->content = $this->show($token2);
                        } else {
                            if (method_exists($this, $token2)) {
                                $this->content = $this->{$token2} ();
                            } else {
                                $this->content = 'Metodo non trovato';
                            }
                        }
                    } else {
                        $this->content = 'Metodo non trovato';
                    }
                } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($token2) {
                        if (is_numeric($token2)) {
                            $this->content = $this->updates($token2);
                        } else {
                            if (method_exists($this, $token2)) {
                                $this->content = $this->{$token2} ();
                            } else {
                                $this->content = 'Metodo non trovato';
                            }
                        }
                    } else {
                        $this->content = 'Metodo non trovato';
                    }

                }

                break;
        }
    }

    public function display() {
        require $this->layout;
    }

    public function getPosts() {
        $posts = $this->Post->all();
        return view('posts', compact('posts'));
    }

    public function show($postid) {
        $post = $this->Post->find($postid);
        return view('post', compact('post'));
    }

    public function create() {
        return view('newPost');
    }

    public function save() {
        $this->Post->save($_POST);
        //redirect('/posts');

        /*header("Content-Type:applicaion/json");
        return json_encode($_POST);
        exit;*/
    }
}