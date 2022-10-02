<?php

?>

    <div class="row mb-3">
        <div class="col border border-secondary p-3">
            Total of Appointments recieved <b style="margin-right: 20px;">:</b> <?= $total_appointment?>
        </div>
        <div class="col border border-secondary p-3">
            Total Appointments From Result <b style="margin-right: 20px;">:</b> <?= $from_result?>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Schedule</th>
                <th>Client</th>
                <th>Purpose</th>
                <th>Social Positions</th>
                <th>State</th>
            </tr>
        </thead>
        <tbody class="results">
        <?php
            foreach($results as $result){
        ?>
            <tr>
                <td><?= $result['schedule']?></td>
                <td><?= $result['name'] ?></td>
                <td><?= $result['purpose']?></td>
                <td><?= $result['social_pos'] ?></td>
                <td><?= $result['state'] ?></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
<?php

?>