<?php
?>
    <div class="row mb-3">
        <div class="col p-2">
            Total of Appointments recieved <b style="margin-right: 20px;">:</b> <?= $total_appointment?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col border border-secondary p-2">
            Pending Canceled <b style="margin-right: 20px;">:</b> <?= $state['pending_canceled'] ?>
        </div>
        <div class="col border border-secondary p-2">
            Approved Canceled <b style="margin-right: 20px;">:</b> <?= $state['approved_canceled'] ?>
        </div>
        <div class="col border border-secondary p-2">
            Done <b style="margin-right: 20px;">:</b> <?= $state['done']?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col border border-secondary p-2">
            Walkin <b style="margin-right: 20px;">:</b> <?= $state['walkin']?>
        </div>
        <div class="col border border-secondary p-2">
            Rejected <b style="margin-right: 20px;">:</b> <?= $state['reject']?>
        </div>
        <div class="col border border-secondary p-2">
            Passed <b style="margin-right: 20px;">:</b> <?= $state['pass']?>
        </div>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr class="table-warning">
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
            <tr class="table-success">
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
    <div class="row mb-3">
        <hr>
        <p>From Results : <?= $from_result['all']?></p>
        <div class="col border border-secondary p-2">
            Pending Canceled <b style="margin-right: 20px;">:</b> <?= $from_result['pending_canceled']?>
        </div>
        <div class="col border border-secondary p-2">
            Approved Canceled <b style="margin-right: 20px;">:</b> <?= $from_result['approved_canceled']?>
        </div>
        <div class="col border border-secondary p-2">
            Done <b style="margin-right: 20px;">:</b> <?= $from_result['done']?>
        </div>
        <div class="col border border-secondary p-2">
            Walk In <b style="margin-right: 20px;">:</b> <?= $from_result['walkin']?>
        </div>
        <div class="col border border-secondary p-2">
            Rejected <b style="margin-right: 20px;">:</b> <?= $from_result['reject']?>
        </div>
        <div class="col border border-secondary p-2">
            Passed <b style="margin-right: 20px;">:</b> <?= $from_result['pass']?>
        </div>
    </div>
<?php

?>