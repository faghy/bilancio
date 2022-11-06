<?php

namespace App\Controllers;
use \PDO;
use App\Models\Post;
use App\Models\Cathegory;

class PostController {
    protected $layout = 'layout/index.tpl.php';
    public $content ='';

    protected $total_records;
    protected $limit = 40;

    protected $conn;
    protected $Post;
    protected $Cat;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
        $this->Post = new Post($conn);
        $this->Cat = new Cathegory($conn);
        $this->total_records = $this->Post->total_records();
    }

    public function display() {
        require $this->layout;
    }

    public function getPosts()  {
     /*   $posts = $this->Post->all();
      //  $cats = new Cathegory($this->conn);
       // $cats = $this->Cat->all();*/

        $pages = $this->get_pagination_numbers();
        $post_controller = $this;

        $start = 0;
        if ($this->current_page() > 1 ) {
            $start = ($this->current_page()*$this->limit) - $this->limit;
        }
        $posts = $this->Post->get_data($start,$this->limit);


        $this->content = view('posts', compact('posts', 'pages', 'post_controller' ));
    }


    /* current_page() PRENDE POSIZIONE DELLA PAGINA CHE STA PUBBLICANDO*/
    public function current_page()
    {
        return isset($_GET['page']) ? (int)$_GET['page'] : 1;
    }

    /* get_pagination_numbers() RICHIEDE IL NUMERO TOTALE DI PAGINE */
    public function get_pagination_numbers()
    {
        return ceil($this->total_records / $this->limit);
    }

    /*SPOSTA DI UNA PAGINA PRECEDENTE*/
    public function prev_page()
    {
        return ($this->current_page() != 1 ) ? $this->current_page() - 1 : 1;
    }

    /* SPOSTA DI UNA PAGINA SUCCESSIVA */
    public function next_page()
    {
        return(	$this->current_page() < $this->get_pagination_numbers() ) ? $this->current_page() + 1 : $this->get_pagination_numbers();
    }

    public function is_active_page($i)
    {
        return ( $this->current_page() == $i ) ? 'active' : '' ;
    }

    public function show( $postid ) {
        $post = $this->Post->find($postid);

       // $cats = $this->Cat->allpostid($postid);
        $this->content = view('post', compact('post'));
    }

    public function getPostsYear() {
        $posts = $this->Post->year($_POST);
        $conta = $GLOBALS['contarow'];
        $somma_anno = $GLOBALS['somma_anno'];
        $this->content =  view('posts', compact('posts','conta', 'somma_anno'));
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