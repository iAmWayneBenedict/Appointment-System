<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base_url" content="<?= base_url() ?>">
    <link rel="stylesheet" href="<?= base_url('/src/css/app.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script type="module" src="<?= base_url('/src/js/app.js') ?>"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>
<body>
<?php
foreach($myAppointment as $appointment){
?>
    <form action="" method="post" class="form-submit">
        <h1>Other page or pop up</h1>
        <input type="text" name="id" id="appointment-id" value="<?= $appointment->id ?>" readonly><br>
        <input type="text" name="" id="" value="<?= $appointment->purpose ?>" disabled><br>
        <label for="">Old schedule</label>
        <input type="text" name="" id="" value="<?= $appointment->schedule ?>" disabled><br>
        <label for="">Reschedule</label>
        <input type="datetime-local" name="new_sched" id="new_sched" required>
        <input type="submit" value="Resched">
        <a href="<?= base_url("user/dashboard/delete-passed-appointment/{$appointment->id}") ?>">Delete</a>
    </form>

<?php
}
?>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");
        
        $('.form-submit').submit(function (e) { 
            e.preventDefault();
            const formdata = $(this).serialize()

            $.ajax({
                type: "post",
                url: `${url}/user/dashboard/reschedule-appointment`,
                data: formdata,
                dataType: "json",
                success: function (response) {
                    if(response.code == 500){
                        alert(response.msg)
                        return
                    }else if (response.code == 0){
                        alert(response.msg)
                    }

                    location.reload()
                }
            });
        });
    })
</script>
</body>
</html>