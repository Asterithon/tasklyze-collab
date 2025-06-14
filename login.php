
<button type="button" class="btn btn-outline-primary container-fluid fw-bold" data-bs-toggle="modal" data-bs-target="#login">
    Login
</button>
<!-- Modal login -->
<div class="modal fade" id="login" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
            <div class="modal-body">
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <h5 class="col-12 modal-title text-center display-5" id="staticBackdropLabel"> Login</h5>
                <!-- form login -->
                <form action="config/aksi_login.php" method="POST">
                    <div class="form-floating my-3">
                        <input class="form-control" id="inputusername" type="text" placeholder="username" name="username"
                        required />
                        <label for="inputusername"><i class="fa-solid fa-user fa-xs mx-2"></i>Username</label>
                    </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password"
                    required />
                    <label for="inputPassword"><i class="fa-solid fa-lock fa-xs mx-2"></i>Password</label>
                </div>
            
            </div>

        <div class=" px-3 py-3">
            <button type="submit" class="btn btn-primary container-fluid mb-2">Login Now</button>
            <button type="button" class="btn btn-dark container-fluid mt-2" data-bs-toggle="modal"
            data-bs-target="#register">
            Register
        </button></form>
    </div>
        </div>
    </div>
    <!-- /Modal login -->
</div>
