<?php
//include __DIR__ . '/../layout/header.php';
?>

<main role="main" class="container" id="main-cerca">

    <form class="my-2 my-lg-0" action="/posts/cerca" method="POST">
        <div class="form-group">
            <label><h2>Scegli la data : </h2></label><br />
            <input class="form-control mr-sm-2" type="date" placeholder="" name="data" id="data" aria-label="Search">
        </div><br />
        <div class="form-group text-center">
            <button class="btn btn-success rounded-0" type="submit"> Cerca</button>
        </div>
    </form>
</main>
<!--<form action="/posts/cerca" method="POST">
    <div class="form-group">
        <label>Scegli la data</label>
        <input class="form-control" type="date" name="data" id="data">
    </div>
    <div class="form-group text-center">
        <button class="btn btn-success rounded-0" type="submit">Cerca</button>
    </div>
</form>-->





