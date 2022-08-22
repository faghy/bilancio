
<table class="table table-striped table-hover table-responsive">
    <thead class="thead-dark">
    <tr>
        <th>Categorie</th>
    </tr>
    </thead>
    <tbody>
<?php
foreach ($cats as $cat) :
    ?>
        <tr>
            <td>
                <h4><a href="/categoria/<?= $cat->cat_id ?>/edit/"><?=htmlentities($cat->descriz_cat)?></a></h4>
            <form class="form-inline" style="display: inline;" action="/categoria/<?=$cat->cat_id?>/delete" method="POST">
                <button class="btn btn-primary">
                    <a style="color: white;" href="/categoria/create">Aggiungi</a>
                </button>
                <input type="submit" class="btn btn-danger" value="CANCELLA" style="float: right;">
            </form>
            </td>
        </tr>

<?php
endforeach;
?></tbody>
</table>




