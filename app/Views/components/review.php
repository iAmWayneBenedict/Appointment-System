<?php
    
    $date = date_create($appointment->schedule);
    $sched = date_format($date, 'F d, Y g:i A')
?>
<input type="text" readonly value="<?= $appointment->user_type ?>">
<input type="text" readonly value="<?= $appointment->name ?>">
<input type="text" readonly value="<?= $appointment->address ?>">
<input type="text" readonly value="<?= $appointment->contact_number ?>">
<input type="text" readonly value="<?= $appointment->social_pos ?>"><br>

<label for="">Purpose</label>
<input type="text" readonly value="<?= $appointment->purpose ?>"><br>

<label for="">Schedule</label>
<input type="text" readonly value="<?= $sched ?>"><br>

<button class="reject" value="<?= $appointment->id ?>">REJECT</button>
<button class="approve" value="<?= $appointment->id ?>">APPROVE</button>
<?php
    
?>
