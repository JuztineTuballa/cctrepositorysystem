<?php
include 'includes/z-forgot-password-header.php';
?>

<body>
<BR><BR><BR>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-forgot-pass-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                        and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form action="z-admin-password-reset-code.php" method="POST" class="user">
                                        
                                        <!--PHP CODE FOR ERRORS -->
                                        <?php if (isset($_GET['error'])){ ?>
                                        <p class="modal-error"><?php echo $_GET['error']; ?></p>
                                        <?php } ?>

                                        <div class="form-group">
                                            <input type="email" name="admin_email_reset" class="form-control text-gray-900" placeholder="Enter Email Address...">
                                        </div>
                                        <button type="submit" name="admin_password_reset_button" class="btn btn-primary btn-user btn-block blockz">Send Link</button>
                                    </form>
                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<?php
include 'includes/z-forgot-password-footer.php';
?>