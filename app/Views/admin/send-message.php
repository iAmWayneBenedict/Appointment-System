<?= $this->extend('layouts/admin_layouts') ?>
<?= $this->section('content') ?>
<div class="main-content">
    <div class="mt-3 mb-5">
        <h2>Send Message</h2>
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard/') ?>">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Send Message</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex">

        <!-- SMS sender -->

        <div class="spread-container" style="padding-right: 7rem; border-right: 1px solid rgba(0, 0, 0, 0.3)">
            <h4>SMS</h4><br>
            <form action="" id="sms-send-form" method="post">
                <div class="d-flex justify-content-between">

                    <!-- Send to all contacts -->

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="contact_all" checked="true" id="all-contacts" value="all" style="cursor: pointer;">
                        <label class="form-check-label" style="cursor: pointer;" for="all-contacts">All Contacts</label>
                    </div>

                    <!-- Select a user contact -->

                    <div class="d-flex">
                        <div class="contact-selected-recipient me-2">
                            <h6 class="m-0"><b>John Doe</b></h6>
                            <span style="font-size: 12px">09123456789</span>
                        </div>
                        <button type="button" class="btn select-user-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                        </button>
                    </div>
                </div>
                <br>

                <!-- Manual Select -->

                <div class="mb-3 recipient-contact">
                    <label for="to_number" class="form-label">Recipient Number</label>
                    <input type="text" class="form-control" id="to_number" name="to_number" placeholder="Input 11 digit phone number">
                </div>

                <div class="">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" placeholder="Message here" id="message" required style="height: 10rem"></textarea>
                </div>
                <input type="submit" class="btn btn-primary sms-send-btn mt-4" value="Send to all">
            </form>
        </div>

        <!-- Manual send email -->

        <div class="spread-container" style="padding-left: 7rem;">
            <h4>Email</h4><br>
            <form action="" id="email-form" method="post">

                <div class="mb-3">
                    <label for="recipient-email" class="form-label">To</label>
                    <input type="text" class="form-control" id="recipient-email" name="recipient-email" placeholder="Recipient Email">
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                </div>
                <!-- <textarea name="message" id="" cols="30" rows="10" placeholder="Message here"></textarea> -->
                <div class="">
                    <label for="message-email" class="form-label">Message</label>
                    <textarea class="form-control" name="message-email" placeholder="Message here" id="message-email" style="height: 10rem"></textarea>
                </div>
                <input type="submit" class="btn btn-primary mt-4" value="Send">
            </form>
        </div>

        <!-- select users overlay -->

        <div class="popup-overlay select-users-con shadow-lg rounded-4">
            <div class="card border-0" style="width: 25rem;">
                <form action="" id="select-user-form">
                    <div class="card-body d-flex flex-column gap-3">
                        <h5 class="mb-3">
                            <b>Select User</b>
                        </h5>
                        <div class="contact-list">
                            <div class="list-group sms-contact" style="--bs-list-group-bg: #F8F8F8">
                                <!-- contact-list -->

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Select</button>
                        <button type="button" class="btn close-select-user-contact">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        const url = document.querySelector("meta[name = base_url]").getAttribute('content')

        allContactsHandler()
        $('#all-contacts').change(allContactsHandler)

        // if all contact is checked, then disable manual sending option and remove styling for manual sending overlay
        // else, show the manual sending option
        function allContactsHandler(event) {
            if ($('#all-contacts').is(':checked')) {
                $('.recipient-contact').addClass('d-none')

                unCheckUserSelectRadio()

                removeContactActiveStyling()

                checkHasRadioValue()
            } else {
                $('.recipient-contact').removeClass('d-none')
            }

            // change button value 
            // if true, then change value to send to all
            // else, then change value to send
            activateManualBtnSend($('#all-contacts').is(':checked'))
        }

        // uncheck all radio inputs in select contact overlay
        function unCheckUserSelectRadio() {
            $('.user-contact').each(function(index, element) {
                $(this).prop('checked', false)
            })
        }

        // remove all styling in select contact overlay
        function removeContactActiveStyling() {
            let $allSelectUserSpan = $('.list-group').find('label').find('span')
            $allSelectUserSpan.each(function(index, element) {
                $(this).removeClass('active')
            })
        }

        // change send button value relative to the parameter
        // parameter: boolean
        function activateManualBtnSend(isAll) {

            if (isAll) {
                $('.sms-send-btn').val("Send to all")
            } else {
                $('.sms-send-btn').val("Send")
            }
        }

        // if clicked, show select contact overlay
        $('.select-user-btn').click(function(event) {
            $('.select-users-con').addClass('active')
        })

        // if clicked, hide select contact overlay
        $('.close-select-user-contact').click(function(event) {
            $('.select-users-con').removeClass('active')
        })

        // check if there are radio inputs are being selected
        checkHasRadioValue()

        function checkHasRadioValue() {
            // check the length of all checked contact list
            // convert into boolean
            let hasRadioValue = !!$(".contact-list").children().find(':checked').length
            // find all checked element
            let checkedElement = $(".contact-list").children().find(':checked')

            // it there is selected contact, show selected contact
            // else, hide
            if (hasRadioValue) {
                $('.contact-selected-recipient').children().first().html(checkedElement.data("name"))
                $('.contact-selected-recipient').children().last().html(checkedElement.data("number"))
                $("#to_number").val(checkedElement.data("number"))
                $("#to_number").prop('readonly', true)

                $('.contact-selected-recipient').removeClass('d-none')
                $("#all-contacts").prop('checked', false)
                $('.recipient-contact').removeClass('d-none')

            } else {
                $('.contact-selected-recipient').addClass('d-none')
                $('.contact-selected-recipient').children().first().html("")
                $('.contact-selected-recipient').children().last().html("")
                $("#to_number").val("")
                $("#to_number").prop('readonly', false)

            }

            // change button value 
            // if true, then change value to send to all
            // else, then change value to send
            activateManualBtnSend($('#all-contacts').is(':checked'))
        }

        // if checked, then add an ective styling
        // else, remove active styling
        function clickContactHandler(event) {
            // remove select contact styling
            removeContactActiveStyling()
            if ($(this).is(':checked')) {
                $(this).prev().children().first().addClass('active')
            } else {
                $(this).prev().children().first().removeClass('active')
            }
        }

        // select user contact
        function selectContact(event) {
            event.preventDefault()
            // check if there are radio inputs are being selected
            checkHasRadioValue()
            // remove active styling
            $('.select-users-con').removeClass('active')
        }

        // sms submit handler
        $('#sms-send-form').submit(function(event) {
            event.preventDefault()

            // get all form values
            // and store in data variable
            let formValues = Object.fromEntries(new FormData(this))
            let data = {
                contact_all: formValues.contact_all || "",
                number: formValues.to_number,
                message: formValues.message,
                type: $(".sms-send-btn").val()
            }

            if (data.type === "Send to all") {

                // send to all handler
                // window.location.href = `${url}/admin/dashboard/send-all-sms`
                $.ajax({
                    type: "get",
                    url: `${url}/admin/dashboard/send-all-sms`,
                    // async: true,
                    data: {
                        message: formValues.message,
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $("#preloader").modal("show");
                    },
                    success: function(response) {
                        setTimeout(() => {
                            $("#preloader").modal("hide");
                        }, 500)
                        response.forEach(element => {
                            var msg = []; //hold all error messages

                            //loop error message and push to array
                            $.each(element, function(key, val) {
                                msg.push(`${val}`)
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: msg.join('<br>'),
                            }) //sweet alert
                        });
                    }
                });
            } else {

                // manual send handler
                $.ajax({
                    type: "post",
                    url: `${url}/admin/dashboard/send-sms`,
                    // async: true,
                    data: data,
                    dataType: "json",
                    beforeSend: function() {
                        $("#preloader").modal("show");
                    },
                    success: function(response) {
                        setTimeout(() => {
                            $("#preloader").modal("hide");
                        }, 500)
                        console.log(response)
                        if (response.code === 1) {
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
                                title: response.message
                            })
                        } else {
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
                                title: response.errors.number
                            })
                        }
                    }
                });
            }
        })

        // get all user contact information
        $.ajax({
            type: "get",
            url: `${url}/admin/dashboard/sms-contact`,
            async: true,
            success: function(response) {

                $('.sms-contact').html(response);

                $('.user-contact').each(function(index, element) {
                    $(this).change(clickContactHandler)
                })
                $("#select-user-form").submit(selectContact)
            }
        });

        // manual sending email handler
        $("#email-form").submit(function(event) {
            event.preventDefault();

            let email = $("#recipient-email").val()
            let subject = $("#subject").val()
            let message = $("#message-email").val()

            $.ajax({
                type: "post",
                url: `${url}/admin/dashboard/send-email`,
                // async: true,
                dataType: 'json',
                data: {
                    email,
                    subject,
                    message
                },
                beforeSend: function() {
                    $("#preloader").modal("show");
                },
                success: function(response) {
                    setTimeout(() => {
                        $("#preloader").modal("hide");
                    }, 500)
                    // console.log(response)
                    if (response.code == 0) {
                        var msg = []; //hold all error messages

                        //loop error message and push to array
                        $.each(response.error, function(key, val) {
                            msg.push(`${val}`)
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: msg.join('<br>'),
                        })
                         //sweet alert
                        // console.log(msg)
                        return;
                    }

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        })
    })
</script>
<?= $this->endSection() ?>