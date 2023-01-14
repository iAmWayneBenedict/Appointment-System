<?php
foreach ($stocks as $stock) {
    $total_avail = $stock->allocated + $stock->available;
?>
    <tr>
        <td><?= $stock->id ?></td>
        <td><?= $stock->category ?></td>
        <td><?= $stock->name ?></td>
        <td><?= $total_avail ?></td>
        <td>
            <button id="update" class="show-update btn btn-primary" value="<?= $stock->id ?>" data-bs-toggle="modal" data-bs-target="#updateStocksModal">Update</button>
            <button id="release" class="release-form btn btn-success" value="<?= $stock->id ?>">Set Release</button>
            <button id="claim" class="claim-form btn btn-warning" value="<?= $stock->id ?>" data-bs-toggle="modal" data-bs-target="#claimBy">Claim</button>
        </td>
    </tr>
<?php
}
?>