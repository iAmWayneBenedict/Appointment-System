<form action="" method="post" id="claimed-form">
    <div class="d-flex justify-content-start">
        <h3><?=$stocks->sub_category?></h3>
    </div>
    <div class="row mt-4 d-flex justify-content-center">
        <div class="form-group col-md-5">
            <label for="category" class="form-label">Claimed By:</label>
            <input type="text" class="form-control" id="claim_by" name="claim_by" placeholder="Name" required>
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>
        <div class="form-group col-md-2">
            <label for="sub_category" class="form-label">Claimed</label>
            <input type="number" class="form-control" id="quantity_availed" name="quantity" placeholder="Quantity" required>
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>
        <div class="form-group col-md-3">
            <label for="sub_category" class="form-label">Deduct From:</label>
            <select class="form-select" name="deduct" id="deduct">
                <option value="allocated">Allocated</option>
                <option value="available">Available</option>
            </select>
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <input type="submit" class="btn btn-success" value="SUBMIT">
    </div>
</form>