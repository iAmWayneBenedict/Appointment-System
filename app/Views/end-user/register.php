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
                    <label for="municipality" class="form-label">Municipality</label>
                    <!-- <input type="text" class="form-control" id="municipality" name="municipality" placeholder="Municipality"> -->
                    <select name="municipality" id="municipality" class="form-control">

                    </select>
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- address -->

                <div class="mb-1">
                    <label for="barangay" class="form-label">Barangay</label>
                    <!-- <input type="text" class="form-control" id="barangay" name="barangay" placeholder="Barangay"> -->
                    <select name="barangay" id="barangay" class="form-control">
                        <option value="">--Select Barangay--</option>
                    </select>
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <div class="mb-1">
                    <label for="zone_street" class="form-label">Zone / Street</label>
                    <input type="text" class="form-control" id="zone" name="zone" placeholder="Zone or Street">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>
                <!-- 
                    email 
                    *optional
                -->

                <div class="mb-1">
                    <label for="email" class="form-label">Email <small><i class="text-primary">(optional)</i></small></label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email / optional">
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

                <center class="mt-5" style="font-size: 14px;">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error message!</span><br>
                    <input type="checkbox" name="data-privacy-agreement" id="data-privacy-agreement">
                    <span>By checking this, I hereby agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#terms-and-conditions-modal">Terms and Conditions</a> and <a href="#" data-bs-toggle="modal" data-bs-target="#privacy-policy-modal">Privacy Policy</a></span>
                </center>

                <!-- submit button -->

                <input type="submit" value="Register" id="submit" class=" btn btn-primary mt-3 rounded-5">

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

<!-- Terms and Conditions -->
<div class="modal fade" id="terms-and-conditions-modal" tabindex="-1" aria-labelledby="terms-and-conditions-modal-abel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50rem;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Terms and Conditions</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= view("components/data-privacy-template/terms-and-conditions") ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Privacy Policy Modal -->
<div class="modal fade" id="privacy-policy-modal" tabindex="-1" aria-labelledby="privacy-policy-modal-label" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50rem;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Privacy Policy</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= view("components/data-privacy-template/privacy-policy") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('/src/js/user/register.js') ?>"></script>
<script src="<?= base_url('/src/js/address.js') ?>"></script>
<?= $this->endSection() ?>