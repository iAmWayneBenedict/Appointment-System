<?= $this->extend('layouts/user_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div>
        <div class="pb-5">
            <h3 class="font-recoleta fw-bold">Appointment Registration</h3>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('/user/dashboard/') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appointment Registration</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="main">
        <div class="mb-5 me-md-5">
            <form action="" method="post" class="d-flex flex-md-row flex-column align-items justify-content-between gap-5" id="form-submit">
                <div class="flex-fill">
                    <div class="pb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" class="form-control" id="name" name="name" placeholder="Name" value="<?= $userData->name; ?>" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= $userData->address; ?>" id="address" placeholder="address" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="c_number" class="form-label">Contact number</label>
                        <input type="text" class="form-control" name="c_number" value="<?= $userData->contact_number; ?>" id="c_number" placeholder="Contact Number" readonly>
                    </div>

                    <div class="pb-3">
                        <label for="social_pos" class="form-label">Social Position</label>
                        <input type="text" class="form-control" name="social_pos" value="<?= $userData->social_pos; ?>" id="social_pos" placeholder="Social Position" readonly>
                    </div>
                    <div class="pb-3">
                        <label for="purpose" class="form-label">Purpose</label>
                        <select class="form-select" name="purpose" id="purpose">
                            <option value="RSBSA (Registry System for Basic Sector in Agriculture)">RSBSA (Registry System for Basic Sector in Agriculture)</option>
                            <option value="Registration of Municipal Fisherfolks">Registration of Municipal Fisherfolks</option>
                            <option value="Processing of Crop Insurance (PCIC Program)">Processing of Crop Insurance (PCIC Program)</option>
                            <option value="Distribution of Farm Inputs">Distribution of Farm Inputs</option>
                            <option value="Boat Registration">Boat Registration</option>
                            <option value="Stocks">Stocks</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                </div>

                <div class="d-flex flex-column flex-fill">
                    <div class="pb-1">
                        <h6 class="mb-3">Person(s) in-charge of purpose</h6>
                        <div class="person-incharge-con">

                        </div>
                    </div>
                    <div class="mb-4 d-none">
                        <label for="concern" class="form-label">Other Concerns</label>
                        <textarea class="form-control" name="concern" id="concern" cols="30" rows="10" placeholder="Other Concerns" disabled></textarea>
                    </div>
                    <div class="">
                        <label for="sched" class="form-label">Schedule</label>
                        <input type="datetime-local" class="form-control" id="sched" name="sched">
                    </div>
                    <input type="submit" class="btn btn-primary mt-5" value="SUBMIT">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        $('#purpose').on('change', displayPersonIncharge);
        displayPersonIncharge()

        function displayPersonIncharge(personIncharge = undefined) {

            if ($('#purpose').val() == 'other') {
                $('#concern').prop('disabled', false);
                $('#concern').parent().removeClass('d-none')
                $('.person-incharge-con').parent().addClass('d-none')
                $('.person-incharge-con').html("")
                return;
            }

            $('#concern').prop('disabled', true);
            $('#concern').parent().addClass('d-none')
            $('.person-incharge-con').parent().removeClass('d-none')
            $('.person-incharge-con').html(personInChargeCardTemplate('John Doe', 'Secretary'))

            return;

        }

        function personInChargeCardTemplate(name, designation) {
            return `<div class="alert alert-info" role="alert">
                        <h6 class="m-0 fw-semibold">${name}</h5>
                        <small class="m-0">${designation}</small>
                    </div>`
        }

        $('#form-submit').submit(function(e) {
            e.preventDefault();


            const formdata = new FormData($(this)[0]);
            if ($('#purpose').val() == 'other') {
                formdata.set('purpose', $('#concern').val());
                formdata.delete('concern')
            }

            console.log(Object.entries(formdata))

            const user_type = 001
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

                    alert(response.msg)
                    console.log(response)
                }
            });


            for (var val of formdata) {
                console.log(`${val[0]}: ${val[1]}`)
            }

        });
    });
</script>
<?= $this->endSection() ?>