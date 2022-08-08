
<article>
    <div class="row">
        <div class="col-md-6 push-md-3">
            <h1>Operazione</h1>

                <time datetime="<?= $post->datecreated ?>"><?= $post->datecreated ?></time>
                <?=htmlentities($post->descrizione)?><br />
            <h4><?=htmlentities($post->categoria)?></h4>
            <time datetime="<?=htmlentities($post->datecreated)?>"><?=htmlentities($post->datecreated)?></time>
            <p><?=htmlentities($post->entratauscita)?></p>
            <h5><?=htmlentities($post->importo)?> €</h5>


            <br>
            <div class="form-group">
                <form class="form-inline" action="/post/<?= $post->id ?>/edit" method="GET">

                    <input type="submit" class="btn btn-primary" value="MODIFICA">
                </form>

                <form class="form-inline"  action="/post/<?= $post->id ?>/delete" method="POST">
                    <input type="submit" class="btn btn-danger" value="CANCELLA">

                </form>
            </div>
        </div>
    </div>








</article>