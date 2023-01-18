<?php

$date = date_create($appointment->schedule);
$sched = date_format($date, 'F d, Y g:i A')
?>

<div class="d-flex gap-4">
    <div class="flex-fill">
        <div class="">
            <label for="user_type" class="form-label">User Type</label>
            <input type="text" class="form-control" id="user_type" name="user_type" placeholder="User Type" readonly value="<?= $appointment->user_type ?>">
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>

        <div class="">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" readonly value="<?= $appointment->name ?>">
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>

        <div class="">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" readonly value="<?= $appointment->zone_street.' '.$appointment->barangay.','.$appointment->municipality ?>">
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>

        <div class="">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" readonly value="<?= $appointment->contact_number ?>">
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>

    </div>

    <div class="flex-fill">
        <div class="">
            <label for="social_pos" class="form-label">Social Position</label>
            <input type="text" class="form-control" id="social_pos" name="social_pos" placeholder="Social Position" readonly value="<?= $appointment->social_pos ?>">
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>

        <div class="">
            <label for="purpose" class="form-label">Purpose</label>
            <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Purpose" readonly value="<?= $appointment->purpose ?>">
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>

        <div class="">
            <label for="sched" class="form-label">Schedule</label>
            <input type="text" class="form-control" id="sched" name="sched" placeholder="Schedule" readonly value="<?= $sched ?>">
            <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                message!</span><br>
        </div>

    </div>
</div>
<div class="d-flex justify-content-end gap-2">
    <button class="reject btn btn-danger" value="<?= $appointment->id ?>">REJECT</button>
    <button class="approve btn btn-primary" value="<?= $appointment->id ?>">APPROVE</button>
</div>
<?php

?>