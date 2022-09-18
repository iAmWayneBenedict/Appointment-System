<?php
foreach ($employees as $employee) {
    if ($employee['status'] == 1) {
        $status = 'Available';
    } else {
        $status = 'Unavailable';
    }
?>
    <tr>
        <td class="id-con"><?= $employee['id'] ?></td>
        <td><?= $employee['name'] ?></td>
        <td class="employee-status-cell <?= $employee['status'] ? "available" : "" ?>">
            <div><?= $status ?></div>
        </td>
        <td class="inactive-time">
            <!-- time -->
        </td>
    </tr>
<?php
}

?>