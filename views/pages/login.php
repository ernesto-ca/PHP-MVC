<div class=" row justify-content-center align-items-center">
    <div class="col-lg-4 col-md-3">
        <?php
        $login = FormController::ctrLogIn();

        if ($login) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                User successfully logged in, you have access to the CRUD section
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } else if (isset($_POST['log'])) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                User and / or password does not match
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
        echo "<script> 
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href);
        }
     </script>" ?>
        <div class="card Fbox m-5">
            <div class="card-body text-align-center">
                <h3 class="card-title text-center mb-3">Wellcome back!</h3>
                <form method="POST">

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="User Name" name="u_name" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-key" aria-hidden="true"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Password" name="u_password" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn form-control btn-success" value="Log In" name="log">
                    </div>
                    <p class="text-center"> If you don't have an account please <a href="index.php?page=signup">Sign Up here</a></p>
                </form>

            </div>
        </div>
    </div>
</div>
