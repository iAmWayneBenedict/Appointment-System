<?php
$index = 0;
$newData = [];
foreach ($incharge_data as $data) {
    array_push($newData, $data['incharge_to']);
}
foreach (array_unique($newData) as $data) {
?>

    <div class="my-1">
        <button type="button" class="list-group-item list-group-item-action rounded-0 border-0 py-3">
            <h6 class="m-0"><?= $data ?></h6>
        </button>
        <input type="radio" data-value="<?= $data ?>" hidden name="incharge-to" id="incharge-to-<?= $index ?>" class="incharge-to-input">
    </div>

<?php
    $index++;
}
?>