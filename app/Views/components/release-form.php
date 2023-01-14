<?php

if (isset($stocks->release_date)) {
?>
    <form action="<?= base_url('admin/dashboard/update-release-date') ?>" method="post" class="release-date">
        <div class="d-flex justify-content-between mb-3">
            <h4>Update Release of Stocks</h4>
            <button type="button" class="btn-close btn-close-release"></button>
        </div>
        <h4><?= ucfirst($stocks->name) ?> Stocks</h4>
        <div>
            <!-- <label for="r_date" class="form-label">Update Date:</label> -->
            <!-- <input type="date" name="r_date" id="date" class="form-control" required><br> -->
            <div class="mb-3">
                <!-- <label for="holiday_to" class="form-label">Holiday To</label>
                        <input name="holiday_to" class="form-control" id="holiday_to" type="date"> -->
                <label for="sched" class="form-label">Schedule</label><br>
                <input type="text" hidden class="form-control" id="r_date" name="r_date">
                <button type="button" id="select-date" class="btn btn-primary select-date" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    Select Date
                </button>
                <br>
                <br>
                <div class="pb-1 selected-date-con d-none">
                    <label for="selected-date" class="form-label">Selected Date</label><br>
                    <input type="text" disabled class="form-control selected-date" id="selected-date" data-selected-date="r_date" name="selected-date">
                </div>
            </div>
            <input type="hidden" name="id" id="stock_id" value="<?= $stocks->id ?>"><br>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-transparent">Close</button>
            <input type="submit" class="btn btn-primary" value="UPDATE">
        </div>
    </form>
<?php
} else {
?>
    <form action="<?= base_url('admin/dashboard/set-release-date') ?>" method="post" class="release-date">
        <div class="d-flex justify-content-between mb-3">
            <h4>Set a release Date</h4>
            <button type="button" class="btn-close btn-close-release"></button>
        </div>
        <h4><?= ucfirst($stocks->name) ?> Stocks</h4>
        <div>
            <!-- <label for="r_date" class="form-label">Update Date:</label> -->
            <!-- <input type="date" name="r_date" id="date" class="form-control" required><br> -->
            <div class="mb-3">
                <!-- <label for="holiday_to" class="form-label">Holiday To</label>
                        <input name="holiday_to" class="form-control" id="holiday_to" type="date"> -->
                <label for="sched" class="form-label">Schedule</label><br>
                <input type="text" hidden class="form-control" id="r_date" name="r_date">
                <button type="button" id="select-date" class="btn btn-primary select-date" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    Select Date
                </button>
                <br>
                <br>
                <div class="pb-1 selected-date-con d-none">
                    <label for="selected-date" class="form-label">Selected Date</label><br>
                    <input type="text" disabled class="form-control selected-date" id="selected-date" data-selected-date="r_date" name="selected-date">
                </div>
            </div>
            <input type="hidden" name="id" id="stock_id" value="<?= $stocks->id ?>"><br>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-transparent btn-close-release">Close</button>
            <input type="submit" class="btn btn-primary" value="SET">
        </div>
    </form>
<?php
}

?>