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
<<<<<<< HEAD
        <td><?= $employee['designation'] ?></td>
=======
>>>>>>> 8ff353fc139802a0d4912d8a2498e6fc950f6207
        <td class="employee-status-cell <?= $employee['status'] ? "available" : "" ?>">
            <div><?= $status ?></div>
        </td>
        <td>
            <?= date('g:i A', strtotime($employee['log_time'])) ?>
        </td>
    </tr>
<?php
}

?>