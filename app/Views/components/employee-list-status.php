<?php
foreach ($employees as $employee) {
    if ($employee['status'] == 1) {
        $status = 'Present';
    } else {
        $status = 'Absent';
    }
?>
    <tr>
        <td><?= $employee['id'] ?></td>
        <td><?= $employee['name'] ?></td>
        <td class="employee-status-cell <?= $employee['status'] ? "active" : "" ?>">
            <div><?= $status ?></div>
        </td>
    </tr>
<?php
}

?>