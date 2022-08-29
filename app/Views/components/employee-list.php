<?php
 foreach($employees as $employee){
    if($employee['status'] == 1){
        $status = 'Present';
    }else{
        $status = 'Abasent';
    }
    ?>
        <tr>
            <td><?= $employee['id']?></td>
            <td><?= $employee['name']?></td>
            <td><?= $status ?></td>
        </tr>
    <?php
 }

?>