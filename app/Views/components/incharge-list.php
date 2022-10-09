<?php
$index = 0;
$newData = [
    'RSBSA (Registry System for Basic Sector in Agriculture)',
    'Registration of Municipal Fisherfolks',
    'Processing of Crop Insurance (PCIC Program)',
    'Distribution of Farm Inputs',
    'Boat Registration'
];
// $newData = [];
// foreach ($incharge_data as $data) {
//     array_push($newData, $data['incharge_to']);
// }
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