<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>
<div class="main d-flex justify-content-center">
    <div class="mt-5" style="max-width: 30rem; width: 100%;">
        <form action="" method="post" class="d-flex flex-column" id="form-submit">
            <h3 class="font-recoleta fw-bold my-5">Guest Appointment Registration</h3>
            <div class="mb-1">
                <label for="name" class="form-label">Name</label>
                <input type="name" class="form-control" id="name" name="name" placeholder="Name">
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
            </div>
            <div class="mb-1">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
            </div>
            <div class="mb-1">
                <label for="c_number" class="form-label">Contact number</label>
                <input type="text" class="form-control" id="c_number" name="c_number" placeholder="Contact Number">
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
            </div>

            <div class="mb-1">
                <label for="social_pos" class="form-label">Social Position</label>
                <input type="text" class="form-control" id="social_pos" name="social_pos" placeholder="Social Position">
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
            </div>

            <div class="mb-1">
                <label for="purpose" class="form-label">Purpose</label>
                <select class="form-select" name="purpose" id="purpose">
                    <option value="p1">P!</option>
                    <option value="p2">p2</option>
                    <option value="p3">p3</option>
                    <option value="other">Other</option>
                </select>
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
            </div>
            <div class="mb-4">
                <label for="concern" class="form-label">Example textarea</label>
                <textarea class="form-control" name="concern" id="concern" cols="30" rows="10" placeholder="Other Concerns" disabled></textarea>
            </div>
            <div class="mb-1">
                <label for="sched" class="form-label">Schedule</label>
                <input type="datetime-local" class="form-control" id="sched" name="sched">
                <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                    message!</span><br>
            </div>
            <input type="submit" class="btn btn-primary" value="SUBMIT">
        </form>
    </div>
</div>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        $('#purpose').on('change keyup', function(e) {
            if ($(this).val() == 'other') {
                $('#concern').prop('disabled', false);
                return;
            }
            $('#concern').prop('disabled', true);
            return;
        });

        $('#form-submit').submit(function(e) {
            e.preventDefault();


            const formdata = new FormData($(this)[0]);
            if ($('#purpose').val() == 'other') {
                formdata.set('purpose', $('#concern').val());
                formdata.delete('concern')
            }

            const user_type = 000 //guest
            $.ajax({
                type: "post",
                url: `${url}/appointments/${user_type}/submit-appointment`,
                data: formdata,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function(response) {
                    if (response.code == 0) {
                        console.log(response.errors);
                        return;
                    }

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    console.log(response)
                    location.reload();
                }
            });

        });
    });
</script>
<?= $this->endSection() ?>