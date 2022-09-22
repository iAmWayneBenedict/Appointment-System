
<form action="<?= base_url('admin/dashboard/update-a-stock')?>" method="post">
<h4>Update Stocks (pop up)</h4>
    <h4><?= ucfirst($stocks->sub_category)?> Stocks</h4>
    <label for="available">Available to Clients:</label>
    <input type="number" name="quantity" id="quantity" value="<?= $stocks->available ?>"><br>
    <label for="available">Allocated:</label>
    <input type="number" name="allocated" id="allocated" value="<?= $stocks->allocated ?>"><br>
    <input type="hidden" name="stock_id" value="<?= $stocks->id?>">
    <input type="submit" value="Update">
</form>