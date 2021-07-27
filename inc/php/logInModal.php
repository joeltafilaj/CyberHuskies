
<!-- Log in Modal -->
<div class="modal fade" id="logInModal" tabindex="-1" aria-labelledby="logInModal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title w-100 text-success">Log In</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">

                <!-- Log In Form -->
                <form id="logInForm" action="php/logIn.php" method="post">
                    <br>
                    <!-- Username -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">

                        <div class="col-12 form-floating">
                            <input type="text" id="usernameLog" placeholder="Username" class="form-control">
                            <label class="ms-2" for="usernameLog">Username</label>

                            <!-- Response for username -->
                            <span id="logInMessageUsername" class="text-danger mt-1"></span>
                        </div>
                    </div><br>

                    <!-- Password -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-12 form-floating">
                            <input type="password" id="passwordLog" placeholder="Password" class="form-control" aria-label="Password..." aria-describedby="but">
                            <label class="ms-2" for="passwordLog">Password</label>

                            <!-- Response for password -->
                            <span id="logInMessagePassword" class="text-danger mt-1"></span>
                        </div>
                    </div><br>

                    <!-- Remember me -->
                    <div class="form-group row justify-content-center my-1 px-lg-5 px-3">
                        <div class="col-lg-7 col-6">
                            <input class="form-check-input" type="checkbox" id="rememberMeCheck">
                            <label class="form-check-label" for="rememberMeCheck" style="user-select: none;">
                                Remember me
                            </label>
                        </div>
                        <div class="col-lg-5 col-6 text-end">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#ressetPasswordModal" data-bs-dismiss="modal" class="text-secondary">Forgot password?</a>
                        </div>
                    </div><br>

                    <!-- Log in Button -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-12">
                            <button type="submit" id="submitLogIn" class="btn btn-success w-100 " form="logInForm" style="height: 50px;">Log
                                In</button>
                        </div>
                    </div><br>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <p class="text-secondary">Don't have an account? <a href="#" class="text-success h6" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#signUpModal">Create one</a> </p>
            </div>
        </div>
    </div>
</div>
