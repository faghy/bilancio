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
        <h4><a href="/post/<?=$post->id?>"><?=htmlentities($post->categoria)?></a></h4></td>
    <td><p><?=htmlentities($post->descrizione)?></p></td>
    <td><time datetime="<?=htmlentities($post->datecreated)?>"><?=htmlentities($post->datecreated)?></time></td>

    <td><p><?php $importo_neg = abs($post->importo)*-1;
            if($post->entratauscita) {
            ?>
        <p style="color: green;"><?=htmlentities($post->importo)?> €</p>
        <?php } else {
            ?><p style="color: red;"><?=htmlentities($importo_neg)?> €</p>
            <?php
        }
        ?>
    </td>
</tr>
<?php
endforeach;
?>
    </tbody>
</table>



