<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content')?>

<!-- TODO: This should be a pop up modal -->
<div class="main-content">
<div class="main">
    <div class="mb-5 me-md-5">
        <form action="" method="post" class="d-flex flex-md-row flex-column align-items justify-content-between gap-5" id="form-submit">
            <div class="flex-fill">
                <div class="pb-3">
                    <h6>Status</h6>
                    <p class="btn btn-success rounded-5">Walkin</p>
                </div>
                <div class="pb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="pb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="address">
                </div>
                <div class="pb-3">
                    <label for="social_pos" class="form-label">Social Position</label>
                    <select class="form-select" name="social_pos" id="social_pos">
                        <option value="Farmer">Farmers</option>
                        <option value="Fisherfolk">FisherFolks</option>
                        <option value="Barangay Official">Barangay Official</option>
                        <option value="Regional Staff">Regional Staff</option>
                        <option value="Business Owner">Business Owner</option>
                    </select>
                </div>
                <div class="pb-3">
                    <label for="c_number" class="form-label">Contact number</label>
                    <input type="text" class="form-control" name="c_number" id="c_number" placeholder="Contact Number" required>
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
                <div class="pb-3">
                    <label for="selected-date" class="form-label">Selected Date</label><br>
                    <input type="datetime-local" class="form-control" id="selected-date" name="selected-date">
                </div>
                <div class="pb-3">
                    <input type="submit" class="btn btn-warning" value="INSERT">
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");

        $('#form-submit').submit(function (e) { 
            e.preventDefault();

            const formdata = new FormData($(this)[0]);

            $.ajax({
                type: "post",
                url: `${url}/admin/dashboard/insert-walkin`,
                data: formdata,
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function (){
                    //loader
                },
                success: function (response) {
                    if(response.code == 1){
                        alert('Inserted')
                        location.reload()
                    }else{
                        alert('Not Inserted')
                    }
                },
                error: function (xhr){
                    alert("Error occured.please try again");
                    console.log(xhr.statusText + ':' + xhr.responseText)
                },
                complete: function (){
                    //hide loader
                }
            });
        });
    })
</script>

<?= $this->endSection() ?>