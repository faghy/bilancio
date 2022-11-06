
<label><b>Cerca per anno: </b></label><script>
    function verificaPasswCercaAnno() {
        if (document.formPswCercaAnno.inputCercaAnno.value === 'silviovois') {
            document.getElementById('formCercaAnno').style.display='unset';

        } else alert('Password cannata')
        return false;}
</script>

<form id="formPswCercaAnno" name="formPswCercaAnno" style="display: inline"/>
<input name="inputCercaAnno" type="password" >
<input type="submit" onclick="verificaPasswCercaAnno(); return false;" value="Invia" class="btn btn-primary rounded-0">
</form>

<form id="formCercaAnno" action="/posts/cercaAnno" method="POST" style="display: none">
    <label><b>Digita l'anno: </b></label>


    <input type="text" name="anno" id="delete2" style="display: unset;">
    <button class="btn btn-primary rounded-0" type="submit">invia</button>
</form>
<?php
if(isset($conta)) echo"<span>Totale records: <b>" . $conta . "</b></span>";
if(isset($somma_anno)) echo"<span> - Totale saldo: <b>" . round($somma_anno, 3) . "€</b></span>";?>


<table class="table table-striped table-hover table-responsive" style="margin-top: 10px;">
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

?></tbody>
</table>

<?php
if(isset($post_controller)) {
?>
<hr>
<a href="?page=<?php echo $post_controller->prev_page()?>"> << </a>
<?php
for ($i=1; $i<=$pages; $i++):?>
    <a class="<?php echo $post_controller->is_active_page($i) ?>" href="?page=<?php echo $i?>"><?php echo $i?></a>
<?php endfor;?>
<a href="?page=<?php echo $post_controller->next_page()?>"> >> </a>
<?php
}
?>


<?php
/*
while($row = $posts) {
    $out.='<tr>';
    $out.='<td>'.$row['id'].'</td>';
    $out.='<td>'.$row['nome'].'</td>';
    $out.='<td>'.$row['cognome'].'</td>';
    $out.='<td>'.$row['email'].'</td>';
    $out.='<td><a href="?azione=dettaglio&id='.$row['id'].'"><span class="glyphicon glyphicon-zoom-in"></span></a></td>';
    $out.='<td><a href="?azione=form&id='.$row['id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
    $out.='<td><a href="?azione=elimina&id='.$row['id'].'"><span class="glyphicon glyphicon-remove"></span></a></td>';
    $out.='</tr>';
}


$out.='<tr><td colspan="7"><nav><ul class="pagination">';
                for($i=1; $i<=$tot_pagine; $i++)
                {
                $out .='<li><a href="?page='.$i.'">'.$i.'</a></li>';
                }
                $out .= "</ul></nav></td></tr>";
$out.='</table>';
return($out);

*/
?>






