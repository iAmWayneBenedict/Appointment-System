<?php

    if($stocks->release_date != NULL){
?>
<form action="<?= base_url('admin/dashboard/update-release-date') ?>" method="post" class="release-date">
<h4>Update Stocks (pop up)</h4>
    <h4><?= ucfirst($stocks->sub_category)?> Stocks</h4>
    <label for="available">Update Date:</label>
    <input type="date" name="r_date" id="date" required><br>
    <input type="hidden" name="id" id="stock_id" value="<?= $stocks->id?>"><br>
    <input type="submit" value="UPDATE">
</form>
<?php
    }else{
?>
<form action="<?= base_url('admin/dashboard/set-release-date') ?>" method="post" class="release-date">
<h4>Update Stocks (pop up)</h4>
    <h4><?= ucfirst($stocks->sub_category)?> Stocks</h4>
    <label for="available">Set Date:</label>
    <input type="date" name="r_date" id="date" required><br>
    <input type="hidden" name="id" id="stock_id" value="<?= $stocks->id?>"><br>
    <input type="submit" value="SET">
</form>
<?php
    }

?>