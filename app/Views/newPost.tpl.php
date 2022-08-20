<?php
$today = date("Y-m-d");
?>
<div class="row">
    <div class="col-md-6 push-md-3">
        <h1>Aggiungi</h1>
        <form action="/post/save" method="POST" onsubmit="check()">
            <div class="form-group">
                <div >
                    <label for="inout">Entrata</label>
                    <input type="radio" id="IN" name="inout" value="1" checked >
                </div>
                <div>
                    <label for="inout">Uscita </label>
                    <input type="radio" id="OUT" name="inout" value="0" >
                </div>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="cat">
                    <?php
                    foreach ($cats as $cat) {
                        ?>
                    <option type="" name="categ" id="categoria" value="<?= $cat->cat_id?>"><?=$cat->descriz_cat?></option>
                    <?php
                    }
                    ?>

                    <!--
                    <option type="" name="categ" id="categoria">HOSTING</option>
                    <option type="" name="categ" id="categoria">LAVORI</option>
                    <option type="" name="categ" id="categoria">FORNITORI</option>
                    <option type="" name="categ" id="categoria">COLLABORATORI</option>
                    <option type="" name="categ" id="categoria">AFFITTO</option>
                    <option type="" name="categ" id="categoria">ATT DIGI</option>
-->
                </select><span><a href="/categoria/create">  Aggiungi</a></span>
            </div>

            <div class="form-group">
                <label>Descrizione</label>
                <input class="form-control" type="text" name="descrizione" id="descriz">
            </div>

            <script type="text/javascript">
                function check() {
                    let a = document.getElementById("import").value;

                    if (document.getElementById("IN").checked) {

                        document.getElementById("import").value = Math.abs(a);
                    } else {
                        document.getElementById("import").value =  Math.abs(a)*-1 ;
                       // alert(document.getElementById("import").value);
                    }
                }
            </script>

            <div class="form-group">
                <label>Importo</label>
                <input class="form-control" type="number" name="importo" id="import" required step="0.01" pattern="^\d*(\.\d{0,2})?$">
            </div>

            <div class="form-group">
                <label>Data</label>
                <input class="form-control" type="date" name="data" id="date" value="<?php echo $today; ?>">
            </div>
            <div class="form-group text-center">
                <button class="btn btn-success rounded-0" type="submit">Salva</button>
            </div>
        </form>

    </div>
</div>

