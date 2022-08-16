<div class="row">
    <div class="col-md-6 push-md-3">
        <h1>Aggiungi categoria</h1>
        <form action="/cat/save" method="POST" onsubmit="check()">

            <div class="form-group">
                <label>Aggiungi Categoria</label>
                <input class="form-control" type="text" name="descrizione" id="descriz">
            </div>
            <div class="form-group text-center">
                <button class="btn btn-success rounded-0" type="submit">Salva</button>
            </div>
        </form>
    </div>
</div>

