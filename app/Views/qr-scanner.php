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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js" integrity="sha512-E8QSvWZ0eCLGk4km3hxSsNmGWbLtSCSUcewDQPQWZF6pEU8GlT8a5fF32wOl1i8ftdMhssTrF/OhyGWwonTcXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Appointment System | QR Scanner</title>
</head>

<body>

    <div class="m-5 qr-con">
        <div class="scanner-container">
            <div>
                <div id="reader" style="width: 500px; height:500px"></div>
            </div>
            <!-- <video id="preview"></video> -->
            <input type="text" hidden class="data my-3">
            <div class="employees">
                <table id="employees" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            const url = document.querySelector("meta[name = base_url]").getAttribute('content')
            // const QR_scanner = new Instascan.Scanner({
            //     video: document.querySelector('#preview'),
            //     mirror: true
            // });

            $(".qr-con").addClass("d-none")

            Swal.fire({
                title: 'Enter password',
                input: 'password',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                confirmButtonText: 'Login',
                showLoaderOnConfirm: true,
                preConfirm: (password) => {
                    $.ajax({
                        type: "post",
                        url: `${url}/admin/verify-admin`,
                        data: {
                            password
                        },
                        async: true,
                        dataType: "json",
                        success: function(response) {
                            try {
                                if (response.status === "error") throw response.status
                                else {
                                    $(".qr-con").removeClass("d-none")
                                    $(".swal2-container").remove()
                                    $("body").removeClass()

                                }
                            } catch (err) {
                                Swal.showValidationMessage(
                                    "Invalid password!"
                                )
                                return false;
                            }
                        },
                        error: function(err) {
                            console.error(err)
                        }
                    });

                    return false;
                },
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Verified"
                    })
                }
            })

            //auto update and display the employee and thier status
            display_employees();
            // setInterval(() => {
            //     display_employees();
            // }, 1000)
            let lastScannedResult = '';
            setInterval(() => {
                lastScannedResult = ''
            }, 5000)

            function onScanSuccess(decodedText, decodedResult) {
                // handle the scanned code as you like, for example:
                // console.log(`Code matched = ${decodedText}`, decodedResult);
                const secret = "/.,;[]+_-*$#@12~|";
                let bytes = CryptoJS.AES.decrypt(decodedText, secret);
                let id = bytes.toString(CryptoJS.enc.Utf8);
                $('.data').val(id);

                if (lastScannedResult === id) return;

                lastScannedResult = id;
                console.log(id)

                $.ajax({
                    type: "post",
                    url: `${url}/scanner/track-employee`,
                    data: {
                        emp_ID: id
                    },
                    dataType: "json",
                    success: function(res) {
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
                            title: res.msg
                        })

                        // update employees after scan
                        display_employees(res);
                    }
                });
            }

            function onScanFailure(error) {
                // handle scan failure, usually better to ignore and keep scanning.
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    }
                },
                /* verbose= */
                false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);


            // Instascan.Camera.getCameras().then(function(cameras) {

            //     if (cameras.length > 0) {
            //         QR_scanner.start(cameras[0])
            //     } else {
            //         alert('No cameras found');
            //     }
            // }).catch(function(e) {
            //     console.error(e);
            // });

            // QR_scanner.addListener('scan', function(data) {
            //     const secret = "/.,;[]+_-*$#@12~|";
            //     let bytes = CryptoJS.AES.decrypt(data, secret);
            //     let id = bytes.toString(CryptoJS.enc.Utf8);
            //     console.log(JSON.parse(id));
            //     $('.data').val(data);

            //     $.ajax({
            //         type: "post",
            //         url: `${url}/scanner/track-employee`,
            //         data: {
            //             emp_ID: id
            //         },
            //         dataType: "json",
            //         success: function(res) {
            //             const Toast = Swal.mixin({
            //                 toast: true,
            //                 position: 'top-end',
            //                 showConfirmButton: false,
            //                 timer: 3000,
            //                 timerProgressBar: true,
            //                 didOpen: (toast) => {
            //                     toast.addEventListener('mouseenter', Swal.stopTimer)
            //                     toast.addEventListener('mouseleave', Swal.resumeTimer)
            //                 }
            //             })

            //             Toast.fire({
            //                 icon: 'success',
            //                 title: res.msg
            //             })

            //             // update employees after scan
            //             display_employees(res);
            //         }
            //     });
            // });


            function display_employees(res = undefined) {
                $.ajax({
                    type: 'get',
                    url: `${url}/scanner/get-employee-status`,
                    async: true,
                    success: function(response) {
                        $('.list').html(response);
                        $('.id-con').each(function(index, element) {

                            getTimeSession($(this), res)

                        })
                        // datatable initialization
                        // $('#employees').DataTable();
                    }
                });
            }

            function getCurrentTime() {
                const currentDate = new Date()
                let meridiem = currentDate.getHours() < 12 ? "am" : "pm";
                const formatter = new Intl.NumberFormat(undefined, {
                    minimumIntegerDigits: 2
                })
                return `${currentDate.getHours() % 12}:${formatter.format(currentDate.getMinutes())} ${meridiem}`;
            }

            function setTimeSession(user, time) {
                // sessionStorage.clear()
                let currentSessionData = sessionStorage.getItem('appointment-system')
                if (currentSessionData) {
                    let sessionData = JSON.parse(currentSessionData)
                    let hasUserData = false;

                    for (const users of sessionData) {
                        if (users.user === user) {
                            users.time = time
                            hasUserData = true;
                            break;
                        }
                        hasUserData = false;
                    }

                    if (hasUserData) {
                        sessionStorage.setItem('appointment-system', JSON.stringify(sessionData))

                    } else {
                        sessionStorage.setItem('appointment-system', JSON.stringify([
                            ...sessionData, {
                                user,
                                time
                            }
                        ]))
                    }
                } else {

                    sessionStorage.setItem('appointment-system', JSON.stringify([{
                        user,
                        time
                    }]))
                }
            }

            function getTimeSession(self, res = undefined) {
                let currentSessionData = JSON.parse(sessionStorage.getItem('appointment-system'))
                if (currentSessionData) {
                    for (const users of currentSessionData) {
                        if (!self.next().next().hasClass('available')) {
                            if (res) {

                                setTimeSession(res.id, getCurrentTime())
                                if (res.id === self.text())
                                    self.parent().children().last().text(getUserTimeSession(res.id).time)
                                else
                                if (users.user === self.text()) {

                                    self.parent().children().last().text(users.time)

                                }
                            } else {

                                if (users.user === self.text()) {
                                    self.parent().children().last().text(users.time)

                                }
                            }
                        } else {
                            self.parent().children().last().text("")
                        }

                    }
                } else {
                    if (res) {

                        setTimeSession(res.id, getCurrentTime())
                    }
                }
            }

            function getUserTimeSession(user) {
                let currentSessionData = JSON.parse(sessionStorage.getItem('appointment-system'))
                if (currentSessionData) {
                    for (const users of currentSessionData) {

                        if (users.user === user) {
                            return users;
                        }
                    }
                }
                return 0
            }
        });
    </script>

</body>

</html>