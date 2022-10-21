<?php
foreach ($employees as $employee) {
    if ($employee->status == 1) {
        $status = 'Available';
    } else {
        $status = 'Unavailable';
    }
    print_r($employee)

?>
    <tr>
        <td><?= $employee->name ?></td>
        <td><?= $employee->incharge_to ?></td>
        <td class="employee-status-cell <?= $employee->status ? "available" : "" ?>">
            <div><?= $status ?></div>
        </td>
        <td class="inactive-time">
            <?= date('g:i A', strtotime($employee->log_time)) ?>
        </td>
    </tr>
<?php
}

?>