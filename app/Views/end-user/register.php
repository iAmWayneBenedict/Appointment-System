<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="center-con" style="width: 100%; padding-top: 5rem;">
    <div class="card border-0" style="width: 25rem;">
        <div class="card-body">
            <h5 class="mb-5">
                <b>Register</b>
            </h5>

            <!-- NOTE: arrange this part loading image -->
            <div class="loading d-none">
                <img src="<?= base_url('/public/assets/img/VAyR.gif') ?>" alt="">
            </div>

            <form id="user-form">

                <!-- user id generator -->

                <div>
                    <label for="">User ID: <span id="user_id"></span></label>
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">
                        Error message!
                    </span>
                </div>
                <br />

                <div class="mb-1">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- first name -->

                <!-- <div class="mb-1">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div> -->

                <!-- middle name -->
                <div class="mb-1">
                    <label for="mname" class="form-label">Complete Middle Name</label>
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- last name -->
                <div class="mb-1">
                    <label for="lname" class="form-label">Last Name <small><i class="text-primary">(ex. Dela Cruz jr)</i></small></label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- address -->

                <div class="mb-1">
                    <label for="address" class="form-label">Address <small><i class="text-primary">(Zone Barangay, Municipality)</i></small></label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- 
                    email 
                    *optional
                -->

                <div class="mb-1">
                    <label for="email" class="form-label">Email <small><i class="text-primary">(optional)</i></small></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email / optional">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- phone number -->
                <div class="mb-1">
                    <label for="number" class="form-label">Phone number (09xxxxxxxxx)</label>
                    <input type="text" class="form-control" id="number" name="number" placeholder="number | 09xxxxxxxxx">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- Social Position -->

                <div class="mb-1">
                    <label for="social_pos" class="form-label">Social Position</label>
                    <select class="form-select" name="social_pos" id="social_pos">
                        <option value="Farmer">Farmers</option>
                        <option value="Fisherfolk">FisherFolks</option>
                        <option value="Barangay Official">Barangay Official</option>
                        <option value="Regional Staff">Regional Staff</option>
                        <option value="Business Owner">Business Owner</option>
                    </select>
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- password -->

                <div class="mb-1">
                    <label for="password" class="form-label">Password</label><br>
                    <small> <i class="text-primary">Password must atleast 6 characters, include uppercase, lowercase and number</i></small>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- confirm password -->

                <div class="mb-1">
                    <label for="c_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Confirm Password">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- show password -->

                <div>
                    <input type="checkbox" name="show-password" id="show-password">
                    <label for="show-password">Show Password</label>
                </div>

                <!-- submit button -->

                <input type="submit" value="Register" id="submit" class="btn btn-primary mt-3 rounded-5">

                <!-- register option -->

                <center class="my-5">
                    <span>Already have an account?</span>
                    <a href="<?= base_url("/user/login") ?>" class="text-decoration-none text-primary">
                        <b>Login</b>
                    </a>
                </center>
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('/src/js/user/register.js') ?>"></script>
<?= $this->endSection() ?>