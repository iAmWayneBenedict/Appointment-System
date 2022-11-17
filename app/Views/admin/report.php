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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
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
    <div class="container">
        <div class="d-flex justify-content-center m-3">
                <h3>Appointment Report</h3>
        </div>
        <div class="row mb-5">
            <form action="<?= base_url('/admin/dashboard/generate-pdf') ?>" method="post" class="a_form">
                <div class="row justify-content-md-center m-3">
                    <div class="col-1">
                        <input type="text" class="form-control from" name="from_date" id="datepicker" placeholder="From"/>
                    </div>
                    <div class="col-1">
                        <input type="text" class="form-control to" name="to_date" id="datepicker2" placeholder="To"/>
                    </div>
                    <div class="col-1">
                        <input type="text" class="form-control year" name="year" id="datepicker3" placeholder="Year"/>
                    </div>
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" id="social_pos" name="social_pos">
                            <option selected value="All">All</option>
                            <option value="Farmers">Farmers</option>
                            <option value="Fisherfolk">FisherFolks</option>
                            <option value="Barangay Official">Barangay Official</option>
                            <option value="Regional Staff">Regional Staff</option>
                            <option value="Business Owner">Private Sector</option>
                        </select>
                    </div>
                    <div class="col col-lg-2">
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
                            <option value="pending canceled">Pending Canceled</option>
                            <option value="approved canceled">Approved Canceled</option>
                            <option value="done">Done</option>
                            <option value="walk in">Walk In</option>
                            <option value="rejected">Rejected</option>
                            <option value="passed">Passed</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="row justify-content-md-center">
                            <div class="col">
                                <button class="btn btn-warning" id="prev">PreView</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-secondary" id="reset">Clear</button>
                            </div>
                            <div class="col">
                                <input type="submit" class="btn btn-danger d-none" id="print" value="PRINT">
                            </div>
                        </div> 
                    </div>
                </div>
            </form>

            <hr>

            <div class="view-data" style="background-color: #fbfbeb ;">
                
            </div>
        </div>
        <hr class="" style="height: .3rem;">
        <div class=" row justify-content-md-center mt-4 mb-4">
            <div class="d-flex justify-content-center m-3">
                <h3>Stock Report</h3>
            </div>
            <form action="<?= base_url('/admin/dashboard/sgenerate-pdf') ?>" method="post" class="s-form">
                <div class="row d-flex flex-wrap align-items-center m-3">
                    <div class="col">
                        <input type="text" class="form-control sfrom" name="sfrom_date" id="datepicker" placeholder="Select Month"/>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control sto" name="sto_date" id="datepicker2" placeholder="To Month"/>
                    </div>
                    <div class="col sub-cat">
                        <select class="form-select" aria-label="Default select example" id="sub_cats" name="sub_cats">
                            <option selected value="All">All</option>
                        </select>
                    </div>
                    <div class="col">
                        <div class="row justify-content-md-center">
                            <!-- <div class="col d-flex justify-content-center"> -->
                            <div class="col">
                                <button class="btn btn-warning" id="sprev">PreView</button>
                            </div>
                            <div class="col">
                                <button class="btn btn-secondary" id="sreset">Clear</button>
                            </div>
                            <div class="col">
                                <input type="submit" class="btn btn-danger d-none" id="sprint" value="PRINT">
                            </div>   
                            <!-- </div> -->
                        </div> 
                    </div>
                </div>
            </form>

            <hr>

            <div class="sview-data">
                
            </div>
        </div>
    </div>
    
    <script>
        $("#datepicker, .sfrom").datepicker( {
            format: "mm",
            startView: "months", 
            minViewMode: "months"
        });
        $("#datepicker2, .sto").datepicker( {
            format: "mm",
            startView: "months", 
            minViewMode: "months"
        });
        $("#datepicker3").datepicker( {
            format: "yyyy",
            startView: "years", 
            minViewMode: "years"
        });

        $(document).on('change keyup', '.from, .to, #social_pos, #purpose, #state, .year', function (e) { 
            e.preventDefault();
            $('#print').addClass('d-none')
            $('#prev').show()
        });

        $(document).on('keyup change', '.sfrom, .sto, #sub_cats', function (e) { 
            e.preventDefault();
            $('#sprint').addClass('d-none')
            $('#sprev').show()
        });

        $('#sreset').click(function (e) { 
            e.preventDefault();
            $('.sview-data').empty()
            $('#sprint').addClass('d-none')
            $('#sprev').show()
            $('.s-form').trigger('reset')
        });

        $('#reset').click(function (e) { 
            e.preventDefault();
            $('.a_form').trigger('reset')
            $('.view-data').empty()
            $('#print').addClass('d-none')
            $('#prev').show()
        });


        $(()=> {
            const url = document.querySelector("meta[name = base_url]").getAttribute("content");

            //check if from input is empty then disabled the "to" input
            setInterval(() => {
                if($('.from').val() == ''){
                    $('#datepicker2').attr('disabled', 'disabled')
                }else{
                    $('#datepicker2').removeAttr('disabled')
                }

            },1000);

            setInterval(() => {
                if($('.sfrom').val() == ''){
                    $('.sto').attr('disabled', 'disabled')
                }else{
                    $('.sto').removeAttr('disabled')
                }
            },1000);


            $('#prev').click(function (e) { 
                e.preventDefault();
                var data = {
                    'from_date': $('.from').val(),
                    'to_date' : $('.to').val(),
                    'social_pos' : $('#social_pos').val(),
                    'purpose': $('#purpose').val(),
                    'state' : $('#state').val(),
                    'year' : $('.year').val()
                }

                // alert($('#state').val());
                $.ajax({
                    type: "post",
                    url: `${url}/admin/dashboard/preview`,
                    data: data,
                    success: function (response) {
                        $('.view-data').html(response)
                        $('#print').removeClass('d-none')
                        $('#prev').hide()
                    }
                });
            });

            $('#sprev').click(function (e) { 
                e.preventDefault();
                
                var data = {
                    'sfrom' : $('.sfrom').val(),
                    'sto' : $('.sto').val(),
                    'sub_cats': $('#sub_cats').val()
                }

                $.ajax({
                    type: "post",
                    url: `${url}/admin/dashboard/spreview`,
                    data: data,
                    success: function (response) {
                        $('.sview-data').html(response)
                        $('#sprint').removeClass('d-none')
                        $('#sprev').hide()
                    }
                });
            });

            select_sub()

            function select_sub(){
                $.ajax({
                type: "get",
                url: `${url}/admin/dashboard/get-subcats`,
                async: true,
                dataType: "json",
                success: function (response) {
                    $.each(response, function(key, val){
                        var option = capitalizeFirstLetter(val)
                        $('#sub_cats').append(`<option value='${val}'>${option}</option>`)
                    });
                }
            });
            }

            //capitalize first letter
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            $('#print').click(function (e) { 
                e.preventDefault();
                CreatePDFfromHTML();
                // downloadComponentInPDF();
            });

            function CreatePDFfromHTML() {
                var HTML_Width = $(".view-data").width();
                var HTML_Height = $(".view-data").height();
                var top_left_margin = 15;
                var PDF_Width = HTML_Width + (top_left_margin * 2);
                var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
                var canvas_image_width = HTML_Width;
                var canvas_image_height = HTML_Height;

                var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

                html2canvas($(".view-data")[0], { scale: '1' }).then(function (canvas) {
                    var imgData = canvas.toDataURL("image/png", 1.0);
                    var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                    for (var i = 1; i <= totalPDFPages; i++) { 
                        pdf.addPage(PDF_Width, PDF_Height);
                        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                    }
                    pdf.save("Your_PDF_Name.pdf");
                });
            }

            //try 3
            function printDocument(){
                const input = document.getElementsByClassName('view-data');
                const divHeight = $(".view-data").height();
                const divWidth = $(".view-data").width();
                const ratio = divHeight / divWidth;

                html2canvas(input, { scale: '1' }).then((canvas) => {
                    const imgData = canvas.toDataURL('image/jpeg', 1.0);
                    const pdfDOC = new jsPDF("p", "mm", "a4"); //  use a4 for smaller page

                    const width = pdfDOC.interview-dataSize.getWidth();
                    let height = pdfDOC.internal.pageSize.getHeight();
                    height = ratio * width;

                    pdfDOC.addImage(imgData, 'JPEG', 0, 0, width - 20, height - 10);
                    pdfDOC.save('summary.pdf');   //Download the rendered PDF.
                })
            }

            //try 2
            function downloadComponentInPDF(){

                    html2canvas($(".view-data")[0], {scale: '1'}).then((canvas) => {
                    const componentWidth = $(".view-data").height();
                    const componentHeight = $(".view-data").height();

                    const orientation = componentWidth >= componentHeight ? 'l' : 'p'

                    const imgData = canvas.toDataURL('image/png', 1.0)
                    const pdf = new jsPDF("p", "mm", "a4")

                    pdf.internal.pageSize.width = componentWidth
                    pdf.internal.pageSize.height = componentHeight

                    pdf.addImage(imgData, 'PNG', 0, 0, componentWidth, componentHeight)
                    pdf.save('download.pdf')
                })
            }

        })
    </script>
</body>
</html>