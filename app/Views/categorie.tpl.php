
<table class="table table-striped table-hover table-responsive">
    <thead class="thead-dark">
    <tr>
        <th>Categorie</th>
    </tr>
    </thead>
    <tbody>
<?php
foreach ($posts as $post) :
    ?>
        <tr>
            <td>
                <h4><a href="/categoria/<?=$post->categoria?>"><?=htmlentities($post->categoria)?></a></h4></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>


<?php
endforeach;
?></tbody>
</table>




