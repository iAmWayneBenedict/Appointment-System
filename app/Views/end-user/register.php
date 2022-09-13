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
                <!-- generate user id button -->
                <button id="generate-id" class="btn btn-primary mt-3 rounded-5">Generate User Id</button>
                <br />

                <!-- name -->

                <div class="mb-1">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- address -->

                <div class="mb-1">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- 
                    email 
                    *optional
                -->

                <div class="mb-1">
                    <label for="email" class="form-label">Email <i class="text-primary">(optional)</i></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email / optional">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- phone number -->
                <div class="mb-1">
                    <label for="number" class="form-label">Phone number</label>
                    <input type="text" class="form-control" id="number" name="number" placeholder="number | 09">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- identification -->

                <div class="mb-1">
                    <label for="identity" class="form-label">Identification</label>
                    <input type="text" class="form-control" id="identity" name="identity" placeholder="Identity">
                    <span class="text-danger text-center display-8 fw-normal mt-2 d-none alerts">Error
                        message!</span><br>
                </div>

                <!-- password -->

                <div class="mb-1">
                    <label for="password" class="form-label">Password</label>
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

                <input type="submit" value="Register" id="submit" class="d-none btn btn-primary mt-3 rounded-5">
            </form>
        </div>
    </div>
</div>
<script src="<?= base_url('/src/js/user/register.js') ?>"></script>
<?= $this->endSection() ?>