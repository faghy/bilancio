
<div class="row">
    <div class="col-md-6 push-md-3">
        
 
<h1>Modifica l'operazione1</h1>

<form action="/post/<?=$post->id?>/store" method="POST" onsubmit="check()">
    <input type="hidden" name="id" value="<?=$post->id?>">

    <div class="form-group">
        <div>
            <label for="inout">Entrata</label>

            <?php
            if ($post->entratauscita == 1 ) {
                echo "<input type='radio' id='IN' name='inout' value='1' checked >
        </div>
        <div>
            <label for='inout'>Uscita</label>
            <input type='radio' id='OUT' name='inout' value='0' >";
            } else {
                echo "<input type='radio' id='IN' name='inout' value='1'  >
        </div>
        <div>
            <label for='inout'>Uscita</label>
            <input type='radio' id='OUT' name='inout' value='0' checked>";
            }
            ?>
        <!--    <input type="radio" id="IN" name="inout" value="1"  >
        </div>
        <div>
            <label for="inout">Uscita</label>
            <input type="radio" id="OUT" name="inout" value="0" checked>-->
        </div>
    </div>

    <div class="form-group">
        <label for="categoria">Categoria</label>
        <select name="cat">
            <?php
            $selected = $cats->descriz_cat;
            foreach ($cats as $cat) {

                ?>

                <option type="" name="categ" id="categoria" value="<?=$cat->cat_id?>"
                <?php if($cat->descriz_cat === $selected ) { echo $selected; }?>
                ><?php echo $cat->descriz_cat; ?></option>

                <?php
            }
            ?>
        </select>
    </div>
    <h3>=  <?php echo $cats->descriz_cat;?></h3>

    <div class="form-group">
        
        <label for="descrizione">Descrizione</label>
        <input class="form-control" name="descrizione" type="text" value="<?=$post->descrizione?>" name="descrizione" id="descrizione" required>
           
    </div>

      <div class="form-group">

         <label>Importo</label>
         <input class="form-control" type="number" value="<?=$post->importo?>" name="importo" id="import" required step="0.01" pattern="^\d*(\.\d{0,2})?$">
           
    </div>

    <div class="form-group">
        <label>Data</label>
        <input class="form-control" type="date" name="datecreated" id="date" value="<?=$post->datecreated?>">
    </div>

    <div class="form-group text-md-center">
        <button class="btn  btn-primary">Save</button>
    </div>
    <script type="text/javascript">
        function check() {
            let a = document.getElementById("import").value;

            if (document.getElementById("IN").checked) {

                document.getElementById("import").value = Math.abs(a);
            } else {
                document.getElementById("import").value =  Math.abs(a)*-1 ;
                //alert(document.getElementById("import").value);
            }
        }
    </script>
    
</form>
   </div>
</div>
