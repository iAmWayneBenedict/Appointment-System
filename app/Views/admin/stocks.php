<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>

<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Stocks Management</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Stocks Management</li>
            </ol>
        </nav>
    </div>
    <!-- swalfire -->
    <?php
    if (session()->has('success')) {
    ?>
        <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: '<?= session('success') ?>'
            })
        </script>
    <?php
    }
    if (session()->has('invalid')) {
    ?>
        <script type="text/javascript">
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: '<?= session('invalid') ?>'
            })
        </script>
    <?php
    }
    ?>

    <!-- Button trigger modal -->
    <div class="my-5">
        <h3>Add Stocks</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStocksModal">
            Add Stock
        </button>
    </div>


    <div class="view-stocks" style="margin-top: 1rem;">
        <!-- DataTable -->

        <div style="width: 90%;">
            <table id="stocks" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category</th>
                        <th scope="col">Sub Cat.</th>
                        <th scope="col">Total Stocks</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="stock-list">
                    <!-- employee data insert here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- modal for add stocks -->
    <div class="modal fade" id="addStocksModal" tabindex="-1" aria-labelledby="addStocks" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStocks">Add Stocks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="stock-form" class="">
                    <div class="modal-body">
                        <div class="d-flex gap-3">
                            <div class="flex-fill">
                                <div class="">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" name="category" id="category">
                                        <option value="seeds" selected>Seeds</option>
                                        <option value="seedlings">Seedlings</option>
                                        <option value="fertilizers">Fertilizers</option>
                                        <option value="vouchers">Vouchers</option>
                                        <option value="pesticides">Pesticides</option>
                                    </select>
                                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                        message!</span><br>
                                </div>
                                <div class="">
                                    <label for="sub_category" class="form-label">Sub Category</label>
                                    <input type="text" class="form-control" id="sub_category" name="sub_category" placeholder="Sub Category" required>
                                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                        message!</span><br>
                                </div>

                                <div class="">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
                                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                        message!</span><br>
                                </div>
                                <div class="">
                                    <label for="allocated" class="form-label">Allocated</label>
                                    <input type="text" class="form-control" id="allocated" name="allocated" placeholder="Allocated" required>
                                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                        message!</span><br>
                                </div>
                            </div>
                            <div class="flex-fill">
                                <div class="">
                                    <label for="per_type" class="form-label">Retail</label>
                                    <select class="form-select" name="per_type" id="per_type">
                                        <option value="per kilo" data-entry="seeds-fertilizers" selected>Per Kilo</option>
                                        <option value="per sack" data-entry="fertilizers">Per Sack</option>
                                        <option value="per piece" data-entry="vouchers">Per Piece</option>
                                        <option value="per sachet" data-entry="seeds">Per Sachet</option>
                                        <option value="per plant" data-entry="seedlings">Per Plant</option>
                                        <option value="per bottle" data-entry="pesticides">Per Bottle</option>
                                    </select>
                                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                        message!</span><br>
                                </div>
                                <div class="d-none">
                                    <label for="any-type-textbox" class="form-label">Specify type</label>
                                    <input type="number" class="form-control" id="avail-c" name="any-type-textbox" placeholder="Specify type">
                                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                        message!</span><br>
                                </div>
                                <div class="">
                                    <label for="available" class="form-label">Available</label>
                                    <input type="number" class="form-control" id="avail-c" name="available" placeholder="Available" readonly>
                                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                                        message!</span><br>
                                </div>
                                <div class="">
                                    <label for="des" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="des" id="des" cols="30" rows="5" placeholder="Short Description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" value="Add">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- modal for update stocks -->
    <div class="modal fade" id="updateStocksModal" tabindex="-1" aria-labelledby="updateStocks" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 30rem;">
            <div class="modal-content">
                <form action="<?= base_url('admin/dashboard/update-a-stock') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStocks">Update Stocks</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="update">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-transparent" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" value="Update">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- modal for release stocks -->
    <div class="modal fade" id="releaseStocksModal" tabindex="-1" aria-labelledby="releaseStocks" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="update-sched"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal for claim-by -->
    <div class="modal fade" id="claimBy" tabindex="-1" aria-labelledby="claimeby" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 50%;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="claimby-form">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute("content");

        // datatable initialization
        let $table = $("#stocks").DataTable();

        // setInterval(function() {
        display_stock();
        // }, 5000);

        $.ajax({
            type: "get",
            url: `${url}/admin/dashboard/get-all-stock`,
            async: true,
            dataType: 'json',
            success: function(response) {
                response.stocks.map((data) => {
                    $("#stock_id").append(`
                        <option value="${data.id}">${data.sub_category}</option>
                    `)
                })
            }
        });

        $('.submit-register-recipient-stocks').click(function() {
            let stock_id = $('#stock_id').val()
            let avail_by = $('#avail_by').val()
            let quantity_availed = $('#quantity_availed').val()
            console.log(stock_id, avail_by, quantity_availed)
        })

        $("#category").change(initCategory)

        initCategory()

        function initCategory() {
            let categoryValue = $("#category").val()

            $("#per_type").children().each(function() {
                $(this).removeAttr("selected")
                $(this).removeAttr("disabled")
                $(this).removeClass("d-none")
            })

            $("#per_type").children().each(function() {
                let {
                    entry
                } = $(this).data()

                if (entry.includes(categoryValue)) {
                    $(this).attr("selected", true)
                } else {
                    $(this).addClass("d-none")
                    $(this).attr("disabled", true)

                }
            })
        }

        let quantity = 0
        let allocated = 0
        $("#quantity").each(function() {
            $(this).on('keydown keyup', handleComputeAvailable)
        });
        $("#allocated").each(function() {
            $(this).on('keydown keyup', handleComputeAvailable);
        })
        $("#per_type").change(function() {
            if ($(this).val() === "Any") {
                $(this).parent().next().removeClass("d-none")
                console.log(2)
                console.log(2)
            } else {
                $(this).parent().next().addClass("d-none")
            }
        })

        function handleComputeAvailable() {
            let input = $(this).val().split("")
            let inputLength = input.length - 1
            let data = 0;
            let specialChars = /[ `!@#$%^&*()_\=\[\]{};':"\\|,.<>\/?~]/;
            let letters = /[a-zA-Z]/;

            if (letters.test(input[inputLength]) || specialChars.test(input[inputLength])) {
                input.pop()
                $(this).val(input.join(''))
            }

            // new input length
            inputLength = $(this).val().length - 1
            if ($(this).val().includes('-')) {
                if ($(this).val()[0] !== '-' && $(this).val()[inputLength] !== '-') {
                    data = eval($(this).val())
                    $('button[value=Add], button[value=Update]').removeClass('disabled')
                } else {
                    $('button[value=Add], button[value=Update]').addClass('disabled')
                }
            } else if ($(this).val().includes('+')) {
                if ($(this).val()[0] !== '+' && $(this).val()[inputLength] !== '+') {
                    data = eval($(this).val())
                    $('button[value=Add], button[value=Update]').removeClass('disabled')
                } else {
                    $('button[value=Add], button[value=Update]').addClass('disabled')
                }
            } else {
                $('button[value=Add], button[value=Update]').removeClass('disabled')
                data = parseInt($(this).val())
            }

            if (data < 0) {
                $(this).next().removeClass('d-none')
                $(this).next().text('Input cannot be less than 0')
                $('button[value=Add], button[value=Update]').attr('disabled', true)
            } else {
                $(this).next().addClass('d-none')
                $('button[value=Add], button[value=Update]').removeAttr('disabled')
                console.log(this.id)
                if (this.id === 'allocated') {
                    allocated = data;
                } else {
                    quantity = data
                }
                set_val();
            }
        }

        function set_val() {
            // console.log(quantity, allocated)
            let data = quantity - allocated
            if (data < 0) {
                $('#avail-c').next().removeClass('d-none')
                $('#avail-c').next().text('Input cannot be less than 0')
                $('button[value=Add], button[value=Update]').attr('disabled', true)
            } else {
                $('#avail-c').next().addClass('d-none')
                $('button[value=Add], button[value=Update]').removeAttr('disabled')
            }
            return $('#avail-c').val(quantity - allocated)
        }


        $('#stock-form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: `${url}/admin/dashboard/add-stock`,
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    location.reload()
                }
            });
        });

        function display_stock() {
            $table.destroy()
            $.ajax({
                type: "get",
                url: `${url}/admin/dashboard/get-all-stocks`,
                async: true,
                success: function(response) {
                    $('.stock-list').html(response)

                    // after population of tbody
                    // datatable reinitialization
                    $table = $("#stocks").DataTable({
                        columnDefs: [{
                            width: "30%",
                            targets: 4,
                        }, ],
                    });

                    $('.show-update').click(function(e) {
                        e.preventDefault();
                        var stock_id = $(this).attr('value');
                        $.ajax({
                            type: "get",
                            url: `${url}/admin/dashboard/get-a-stock/${stock_id}`,
                            async: true,
                            success: function(res) {
                                $('.update').html(res)
                                $("#quantity, #allocated").each(function() {
                                    $(this).on('keydown keyup', handleComputeAvailable)
                                });
                            }
                        });
                    });

                    $('.release-form').click(function(e) {
                        e.preventDefault();
                        var stock_id = $(this).attr('value');

                        $.ajax({
                            type: "get",
                            url: `${url}/admin/dashboard/display-release/${stock_id}`,
                            async: true,
                            success: function(res) {
                                $('.update-sched').html(res)
                            }
                        });
                    });


                    $('.claim-form').click(function(e) {
                        e.preventDefault();
                        var stock_id = $(this).attr('value');

                        $.ajax({
                            type: "get",
                            url: `${url}/admin/dashboard/display-claim/${stock_id}`,
                            async: true,
                            success: function(res) {
                                $('.claimby-form').html(res)

                                $('#claimed-form').submit(function(e) {
                                    e.preventDefault();

                                    $.ajax({
                                        type: "post",
                                        url: `${url}/admin/dashboard/insert-claimer`,
                                        data: {
                                            id: stock_id,
                                            claim_by: $('#claim_by').val(),
                                            quantity: $('#quantity_avail').val(),
                                            deduct: $('#deduct').val()
                                        },
                                        dataType: "json",
                                        beforeSend: function() {
                                            //loader
                                        },
                                        success: function(response) {
                                            const res = response.code == 1 ? response.msg : response.msg;
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'info',
                                                title: res,
                                                showConfirmButton: false,
                                                timer: 1500
                                            })
                                            location.reload()

                                        },
                                        error: function(xhr) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'warning',
                                                title: 'Try Again',
                                                showConfirmButton: false,
                                                timer: 2500
                                            })
                                            console.log(xhr.statusText + ':' + xhr.responseText)
                                        },
                                        complete: function() {
                                            //hide loader
                                        }
                                    });
                                });
                            }
                        });
                    });


                    // $('.remove-stock').click(function(event) {
                    //     event.preventDefault()
                    //     let deleteURL = this.href

                    //     Swal.fire({
                    //         title: "Are you sure?",
                    //         text: "You won't be able to revert this!",
                    //         icon: "warning",
                    //         showCancelButton: true,
                    //         confirmButtonColor: "#ff0000",
                    //         cancelButtonColor: "#d0d0d0d",
                    //         confirmButtonText: "Yes, delete it!",
                    //     }).then((result) => {
                    //         location.href = deleteURL;
                    //     });
                    // })

                }
            });
        }


    });
</script>
<?= $this->endSection() ?>