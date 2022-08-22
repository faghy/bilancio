<a class="nav-link" href="/posts/cercaAnno"><h4>2021</h4></a>
<form action="/posts/cercaAnno" method="POST">
    <input type="text" name="anno">
    <button class="btn btn-primary rounded-0" type="submit">invia</button>
</form>
<table class="table table-striped table-hover table-responsive">
    <thead class="thead-dark">
    <tr>
        <th>Categoria</th>
        <th>Descrizione</th>
        <th>Data</th>
        <th>Importo</th>
    </tr>
    </thead>
    <tbody>
<?php
foreach ($posts as $post) :
    ?>
        <tr>
            <td>
                <h4><a href="/post/<?=$post->id?>"><?=htmlentities($post->descriz_cat)?></a></h4>
                <p></p>
            </td>
            <td><p><?=htmlentities($post->descrizione)?></p></td>
            <td><time datetime="<?=htmlentities($post->datecreated)?>"><?php
                    $timestamp = strtotime($post->datecreated);
                    echo date("d-m-Y", $timestamp); ?></time></td>
            <td>
        <?php $importo_neg = abs($post->importo)*-1;
        if($post->entratauscita) {
            ?>
            <p class="p-importo" style="color: green;"><?=htmlentities($post->importo)?> €</p>
            <?php } else {
            ?><p class="p-importo" style="color: red;"><?=htmlentities($importo_neg)?> €</p>
            <?php
            }
        ?></td>
        </tr>


<?php
endforeach;
//var_dump($cats);
?></tbody>
</table>





