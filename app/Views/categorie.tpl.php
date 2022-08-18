
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
                <h4><a href="/categoria/<?= $cat->id ?>/edit/"><?=htmlentities($cat->descriz_cat)?></a></h4></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>


<?php
endforeach;
?></tbody>
</table>




