
<article>
    <div class="row">
        <div class="col-md-6 push-md-3">
            <h1>Operazione</h1>
<br />

            <label><b>Data: </b></label><time datetime="<?=$post->datecreated?>">
                    <?php
                    $timestamp = strtotime($post->datecreated);
                    echo date("d-m-Y", $timestamp); ?></time><br />
            <label><b>Descrizione: </b></label>  <?=htmlentities($post->descrizione)?><br />
            <label><b>Categoria:&nbsp</b></label><h5 class="stessa-linea"><?=htmlentities($post->descriz_cat)?></h5><br />
            <label><b>Tipo:&nbsp</b></label><span><?php if(htmlentities($post->entratauscita) == 0) echo "uscita"; else echo "entrata";?></span><br />
            <label><b>Importo:&nbsp</b></label><h5 class="stessa-linea"><?=htmlentities($post->importo)?> €</h5><br />


            <br>
            <div class="form-group">
                <form class="form-inline" action="/post/<?= $post->id ?>/edit" method="GET">

                    <input type="submit" class="btn btn-primary" value="MODIFICA">
                </form>
                <br/>
                <form class="form-inline"  action="/post/<?= $post->id ?>/delete" method="POST">
                    <input type="submit" class="btn btn-danger" value="CANCELLA">
                </form>
            </div>
        </div>
    </div>








</article>