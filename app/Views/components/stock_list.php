<?php
    foreach($stocks as $stock){
        $total_avail = $stock->allocated + $stock->available;
?>
    <tr>
        <td><?= $stock->id ?></td>
        <td><?= $stock->category ?></td>
        <td><?= $stock->sub_category ?></td>
        <td><?= $total_avail ?></td>
        <td>
            <button id="update" class = "show-update" value="<?= $stock->id ?>">Update</button>
            <a href="<?= base_url("admin/dashboard/delete-a-stock/{$stock->id}") ?>">DELETE</a>
        </td>
    </tr>
<?php
    }
?>