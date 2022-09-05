<?php
foreach ($employees as $employee) {
    if ($employee['status'] == 1) {
        $status = 'Available';
    } else {
        $status = 'Unavailable';
    }
?>
    <tr>
        <td><?= $employee['name'] ?></td>
        <td><?= $employee['role'] ?></td>
        <td class="employee-status-cell <?= $employee['status'] ? "active" : "" ?>">
            <div><?= $status ?></div>
        </td>
    </tr>
<?php
}

?>