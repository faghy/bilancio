<div class="row">
    <div class="col-md-6 push-md-3">

        <h1>Modifica la categoria</h1>

        <form action="/categoria/<?=$post->categoria?>/store" method="POST" onsubmit="check()">
            <input type="hidden" name="id" value="<?=$post->categoria?>">

            <div class="form-group">

                <input id="cat" value="<?=$post->categoria?>" />

            </div>

        </form>
    </div>
</div>