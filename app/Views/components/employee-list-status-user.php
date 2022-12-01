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
        <td>
            <ul>
        <?php
            foreach($employee['incharge'] as $incharge){
                echo '<li>'.$incharge.'</li>';
            }
        ?>
            </ul>
        </td>
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