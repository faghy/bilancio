
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
                <h4><a href="/categoria/<?= $cat->id ?>/edit/"><?=htmlentities($cat->descriz_cat)?></a></h4>
            <form class="form-inline"  action="/categoria/<?=$cat->id?>/delete" method="POST">
                <input type="submit" class="btn btn-danger" value="CANCELLA">
            </form>
            </td>
        </tr>


<?php
endforeach;
?></tbody>
</table>




