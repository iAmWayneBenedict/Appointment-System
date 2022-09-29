<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="base_url" content="<?= base_url() ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Latest compiled and minified CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>

    <!-- Bootstrap datepicker JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <title>Appointment Report</title>
</head>
<body>
    <?php
        if(session()->has('success')){
            echo '<pre>';
            print_r(session('success'));
            echo '<pre>';
        }
    ?>
    <div class="container align-items-center">
        <div class="d-flex justify-content-center m-3">
            <h3>Make Report</h3>
        </div>
        <form action="<?= base_url('/admin/dashboard/generate-pdf') ?>" method="post">
        <div class="row justify-content-md-center m-3">
            <div class="col">
                <input type="text" class="form-control from" name="from_date" id="datepicker" placeholder="Select Month"/>
            </div>
            <div class="col">
                <input type="text" class="form-control to" name="to_date" id="datepicker2" placeholder="To Month"/>
            </div>
            <div class="col">
                <select class="form-select" aria-label="Default select example" id="social_pos" name="social_pos">
                    <option selected value="All">All</option>
                    <option value="Farmer">Farmers</option>
                    <option value="Fisherfolk">FisherFolks</option>
                    <option value="Barangay Official">Barangay Official</option>
                    <option value="Regional Staff">Regional Staff</option>
                    <option value="Business Owner">Private Sector</option>
                </select>
            </div>
            <div class="col">
                <select class="form-select" aria-label="Default select example" id="purpose" name="purpose">
                    <option selected value="All">All</option>
                    <option value="RSBSA (Registry System for Basic Sector in Agriculture)">RSBSA (Registry System for Basic Sector in Agriculture)</option>
                    <option value="Registration of Municipal Fisherfolks">Registration of Municipal Fisherfolks</option>
                    <option value="Processing of Crop Insurance (PCIC Program)">Processing of Crop Insurance (PCIC Program)</option>
                    <option value="Distribution of Farm Inputs">Distribution of Farm Inputs</option>
                    <option value="Boat Registration">Boat Registration</option>
                </select>
            </div>
            <div class="col">
                <select class="form-select" aria-label="Default select example" id="state" name="state">
                    <option selected value="All">All</option>
                    <option value="canceled">Canceled</option>
                    <option value="done">Done</option>
                </select>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-warning" id="prev">PreView</button>
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-danger d-none" id="print" value="PRINT">
                    </div>
                </div> 
            </div>
        </div>
        </form>

        <hr>

        <div class="view-data">
            
        </div>
    </div>

    <script>
        $("#datepicker").datepicker( {
            format: "yyyy-mm",
            startView: "months", 
            minViewMode: "months"
        });
        $("#datepicker2").datepicker( {
            format: "yyyy-mm",
            startView: "months", 
            minViewMode: "months"
        });

        $(()=> {
            const url = document.querySelector("meta[name = base_url]").getAttribute("content");
            $('#prev').click(function (e) { 
                e.preventDefault();
                var data = {
                    'from_date': $('.from').val(),
                    'to_date' : $('.to').val(),
                    'social_pos' : $('#social_pos').val(),
                    'purpose': $('#purpose').val(),
                    'state' : $('#state').val()
                }

                $.ajax({
                    type: "post",
                    url: `${url}/admin/dashboard/preview`,
                    data: data,
                    success: function (response) {
                        $('.view-data').html(response)
                        $('#print').removeClass('d-none')
                    }
                });
            });
        })
    </script>
</body>
</html>