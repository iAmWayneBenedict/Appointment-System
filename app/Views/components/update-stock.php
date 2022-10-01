<div>
    <h4><?= ucfirst($stocks->sub_category) ?> Stocks</h4>
    <div class="">
        <label for="quantity" class="form-label">Available to Clients</label>
        <input type="text" class="form-control" id="quantity" name="quantity" value="<?= $stocks->available ?>">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
            message!</span><br>
    </div>
    <div class="">
        <label for="allocated" class="form-label">Allocated</label>
        <input type="text" class="form-control" id="allocated" name="allocated" value="<?= $stocks->allocated ?>">
        <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
            message!</span><br>
    </div>
    <input type="hidden" name="stock_id" value="<?= $stocks->id ?>">
</div>