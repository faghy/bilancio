<?php
require ('header.php');
?>


<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">Molinari Bilancino</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/posts/ieri">Ieri<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/posts/cerca">Cerca per Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/post/create">Nuova operazione</a>
            </li>


        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>


<body>
<!--<h1 style='' class="titolo">Il Bilancino</h1>-->
<main role="main" class="container">

    <div class="starter-template">

        <div class="container">

            <?=$this->content?>
        </div>
    </div>

</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
        crossorigin="anonymous"></script>
</body>
<footer>
    <h3 id="h3totale-footer" class="h3-totale-footer" onclick="">Totale :  _</h3>
        <script>
            function verificaPasswTotale() {
                if (document.formPswTot.inputPswTot.value === 'silviovois') {
                    document.getElementById('h3totale-footer')
                        .innerHTML = "Totale : <?=round($this->sommaTot(),2)?>"
                    document.getElementById('formPswTotale').style.display='none';
                } else alert('Password cannata')
                return false;}

        </script>

    <form id="formPswTotale" name="formPswTot" />
        <input name="inputPswTot" type="password" >
        <input type="submit" onclick="verificaPasswTotale(); return false;">
    </form>
    <h3 class="orario"><?=date('Y-m-d ')?></h3>
</footer>
</html>