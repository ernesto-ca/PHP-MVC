<div class=" row justify-content-center align-items-center">
    <div class="col-lg-4 col-md-3">
        <?php
        if (FormController::ctrSignUp()) :
            echo "<script> 
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                 </script>"; ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                User successfully registered
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
        <div class="card Fbox m-5">
            <div class="card-body text-align-center">
                <h3 class="card-title text-center mb-3">Hi & Wellcome!</h3>
                <form method="POST">

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="User Name" name="u_user_s" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Full Name" name="u_fname_s" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Password" name="u_password_s" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn form-control btn-success" value="Log In" name="sign">
                    </div>
                    <p class="text-center"> If you already have an account please <a href="index.php?page=login">Log In here</a></p>
                </form>

            </div>
        </div>
    </div>
</div>
