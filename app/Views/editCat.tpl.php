<div class="row">
    <div class="col-md-6 push-md-3">

        <h1>Modifica la categoria</h1>

        <form action="/categoria/<?=$cats->cat_id?>/store" method="POST" ">
            <input type="hidden" name="id" value="<?=$cats->cat_id?>">

            <div class="form-group">
                <label for="descrizione">Descrizione</label>
                <input id="cat" value="<?=$cats->descriz_cat?>" name="descriz_cat" type="text"/>
            </div>

            <div class="form-group text-md-center">
                <button class="btn  btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-striped table-hover table-responsive">
    <thead class="thead-dark">
    <tr>
        <th>Tutte le categorie</th>
    </tr>
    </thead>
    <tbody>
<?php
foreach ($cats_all as $cat) :
?>
        <tr>
            <td>
                <h5><?=$cat->descriz_cat?></h5>
            </td>
        </tr>
<?php
endforeach;
?></tbody>
</table>
