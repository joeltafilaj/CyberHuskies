
<!-- Forget Password Modal -->
<div class="modal fade" id="ressetPasswordModal" tabindex="-1" aria-labelledby="ressetPasswordModal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title w-100 text-dark" style="font-size: 70px;"><i class="fad fa-lock-alt"></i></h1>
            </div>
            <div class="modal-body text-dark">

                <!-- Password Resset Form -->
                <form id="ressetPasswordForm" action="php/passwordResset.php" method="post">

                    <!-- Username -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-12 text-center mb-1">
                            <span class="h5">Trouble Logging In?</span><br>
                        </div>
                        <div class="col-12 text-center mb-3">
                            <span class="">Enter your username and we'll send you a link to
                                get back into your account.</span>
                        </div> <br><br>
                        <div class="col-12 form-floating">
                            <input type="text" id="usernameResset" placeholder="Username" class="form-control">
                            <label class="ms-2" for="usernameResset">Username</label>

                        </div>
                    </div><br>

                    <!-- Resset Password Button -->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-12">
                            <button type="submit" id="submitRessetPassword" class="btn btn-primary w-100 " form="ressetPasswordForm" style="height: 50px;">Send Password Resset Link</button>
                        </div>
                    </div><br>

                    <!-- OR create new account-->
                    <div class="form-group row justify-content-center px-lg-5 px-3">
                        <div class="col-5">
                            <hr>
                        </div>
                        <div class="col-2 text-center">
                            <span class="text-secondary"> OR</span>
                        </div>
                        <div class="col-5">
                            <hr>
                        </div>
                        <div class="col-12 text-center">
                            <a href="#" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#signUpModal" class="text-dark h6">Create New
                                Account</a>
                        </div>

                        <!-- Message -->
                        <span id="ressetMessageLink" class="col-12 mt-4 text-center alert d-none"></span>

                    </div> <br>
                </form>
            </div>

            <!-- Back to log in Button -->
            <a href="#" class="modal-footer justify-content-center text-dark h6 w-100 mb-0 py-3" data-bs-toggle="modal" data-bs-dismiss="modal" data-bs-target="#logInModal" style="background-color: whitesmoke; text-decoration: none;">Back to Login</a>
        </div>
    </div>
</div>