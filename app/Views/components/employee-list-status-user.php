<?php
foreach ($employees as $employee) {
    if ($employee->status == 1) {
        $status = 'Available';
    } else {
        $status = 'Unavailable';
    }
?>
    <tr>
        <td><?= $employee->incharge_to ?></td>
        <td class="employee-status-cell <?= $employee->status ? "available" : "" ?>">
            <div><?= $status ?></div>
        </td>
        <td>
            <?= date('g:i A', strtotime($employee->log_time)) ?>
        </td>
    </tr>
<?php
}

?>