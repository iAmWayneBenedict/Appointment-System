<div>
    <h4><?= ucfirst($stocks->name) ?> Stocks</h4>
    <div class="">
        <label for="quantity" class="form-label">Available to Clients</label>
        <input type="text" class="form-control quantity" value="<?= $stocks->available ?>">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
            message!</span><br>
    </div>
    <div class="">
        <label for="allocated" class="form-label">Allocated</label>
        <input type="text" class="form-control allocated" value="<?= $stocks->allocated ?>">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
            message!</span><br>
    </div>
    <input type="hidden" name="stock_id" value="<?= $stocks->id ?>">
</div>