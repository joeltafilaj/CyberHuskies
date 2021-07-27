
<!-- Modal Sign up -->
<div class="modal fade" id="signUpModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-tittle w-100 text-primary">Sign Up
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">

                <!-- Sign Up Form -->
                <form id="signUpForm" action="php/signUp.php" method="post">

                    <!-- First Name Last Name-->
                    <br>
                    <div class="form-group row justify-content-center px-lg-5 px-3">

                        <!-- First name -->
                        <div class="col-lg-6 form-floating">
                            <input type="text" id="first_name" placeholder="First name" class="form-control" />
                            <label for="first_name" class="ms-2">First name</label>

                            <!-- Response for First Name and Last Name -->
                            <span id="signUpMessageName" class="text-danger mt-1"></span>
                        </div>

                        <!-- Last name -->
                        <div class="col-lg-6 form-floating mt-lg-0 mt-4">
                            <input type="text" id="last_name" placeholder="Last name" class="form-control" />
                            <label for="last_name" class="ms-2">Last name</label>
                        </div>
                    </div>
                    <br />

                    <!-- Username -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-12 form-floating">
                            <input type="text" id="usernameSignUp" placeholder="Username" class="form-control" />
                            <label for="usernameSignUp" class="ms-2">Username</label>

                            <!-- Response for username -->
                            <span id="signUpMessageUsername" class="text-danger mt-1"> <span class="text-secondary ms-2">You can use letters, numbers,
                                    periods &
                                    dash </span> </span>
                        </div>
                    </div>
                    <br />

                    <!-- Email -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-12 form-floating">
                            <input type="text" id="email" placeholder="Email" class="form-control" />
                            <label for="email" class="ms-2">Email</label>

                            <!-- Response for email -->
                            <span id="signUpMessageEmail" class="text-danger mt-1"></span>
                        </div>
                    </div>
                    <br />

                    <!-- Password and Confirm password  -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">

                        <!-- Password -->
                        <div class="col-lg-6  form-floating">
                            <input type="password" id="passSignUp" placeholder="Password" class="form-control" />
                            <label for="passSignUp" class="ms-2">Password</label>
                        </div>

                        <!-- Confirm password -->
                        <div class="col-lg-6  form-floating mt-lg-0 mt-4">
                            <input type="password" id="confirmPassSignUp" placeholder="Confirm" class="form-control" />
                            <label for="confirmPassSignUp" class="ms-2">Confirm</label>
                        </div>

                        <!-- Response for password -->
                        <div class="col-12">
                            <span id="signUpMessagePassword" class="text-danger mt-1"></span>
                        </div>
                    </div>

                    <!-- Checkbox for show password -->
                    <div class="form-group row px-lg-5 px-3 mt-1">
                        <div class="form-group col-lg-6 col-12">
                            <input class="form-check-input" type="checkbox" id="showPasswordCheck">
                            <label class="form-check-label ms-2" for="showPasswordCheck" style="user-select: none;">
                                Show password
                            </label>
                        </div>
                    </div><br>

                    <!-- Phone Number -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-12 form-floating">
                            <input type="number" id="phone_number" placeholder="Phone number (Optional)" class="form-control" />
                            <label for="phone_number" class="ms-2">Phone number (Optional)</label>
                        </div>
                    </div>
                    <br>

                    <!-- Select for user Type -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-12 form-floating">
                            <select class="form-select" id="user_type">
                                <option value="costumer" selected>Customer</option>
                                <option value="salessman">Salessman</option>
                            </select>
                            <label for="user_type" class="ms-2">Select how you want to register
                                as</label>
                        </div>
                        <div class="col-12 mb-1 mt-3">
                            <span class="text-dark">By signing up, I agree to the Privacy Policy and
                                the Terms of Services.</span>
                        </div>
                    </div> <br>

                    <!-- Register button -->
                    <div class="row justify-content-center px-lg-5 px-3">
                        <div class="col-12 form-floating">
                            <button type="submit" form="signUpForm" id="submitSignUp" class="btn btn-primary w-100" style="height: 50px;">Register</button>
                        </div>
                    </div>
                    <br />
                </form>
            </div>

            <!-- Modal buttons -->
            <div class="modal-footer justify-content-center">
                <p class="text-secondary">Already have an account? <a href="#" class="text-primary h6" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#logInModal">Log In</a> </p>
            </div>
        </div>
    </div>
</div>