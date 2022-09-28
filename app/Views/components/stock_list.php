<?php
foreach ($stocks as $stock) {
    $total_avail = $stock->allocated + $stock->available;
?>
    <tr>
        <td><?= $stock->id ?></td>
        <td><?= $stock->category ?></td>
        <td><?= $stock->sub_category ?></td>
        <td><?= $total_avail ?></td>
        <td>
            <button id="update" class="show-update btn btn-primary" value="<?= $stock->id ?>" data-bs-toggle="modal" data-bs-target="#updateStocksModal">Update</button>
            <button id="release" class="release-form btn btn-success" value="<?= $stock->id ?>" data-bs-toggle="modal" data-bs-target="#releaseStocksModal">Set Release</button>
            <a href="<?= base_url("admin/dashboard/delete-a-stock/{$stock->id}") ?>" class="btn btn-danger remove-stock">DELETE</a>
        </td>
    </tr>
<?php
}
?>