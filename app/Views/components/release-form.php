<?php

if (isset($stocks->release_date)) {
?>
    <form action="<?= base_url('admin/dashboard/update-release-date') ?>" method="post" class="release-date">
        <div class="d-flex justify-content-between mb-3">
            <h4>Update Release of Stocks</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <h4><?= ucfirst($stocks->sub_category) ?> Stocks</h4>
        <div>
            <label for="r_date" class="form-label">Update Date:</label>
            <input type="date" name="r_date" id="date" class="form-control" required><br>
            <input type="hidden" name="id" id="stock_id" value="<?= $stocks->id ?>"><br>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="UPDATE">
        </div>
    </form>
<?php
} else {
?>
    <form action="<?= base_url('admin/dashboard/set-release-date') ?>" method="post" class="release-date">
        <div class="d-flex justify-content-between mb-3">
            <h4>Set a release Date</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <h4><?= ucfirst($stocks->sub_category) ?> Stocks</h4>
        <div>
            <label for="r_date" class="form-label">Update Date:</label>
            <input type="date" name="r_date" id="date" class="form-control" required><br>
            <input type="hidden" name="id" id="stock_id" value="<?= $stocks->id ?>"><br>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="SET">
        </div>
    </form>
<?php
}

?>