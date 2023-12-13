<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Profile Admin</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <img src="<?= BASEURL; ?>/assets/images/profile/user-1.jpg" alt="" class="rounded-circle img-fluid">
                </div>
                <div class="col">
                    <h3>User Information</h3>
                    <div class="row">
                        <div class="col-6 mb-5">
                            <div class="form-group">
                                <label for="nip_admin" class="form-label">Nip :</label>
                                <input type="text" class="form-control" name="nip_admin" id="nip_admin" value="<?= $data['adm']['nip_admin']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-6 mb-5">
                            <div class="form-group">
                                <label for="nama_admin" class="form-label">Nama :</label>
                                <input type="text" class="form-control" name="nama_admin" id="nama_admin" value="<?= $data['adm']['nama_admin']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-6 mb-5">
                            <div class="form-group">
                                <label for="email_admin" class="form-label">Email :</label>
                                <input type="text" class="form-control" name="email_admin" id="email_admin" value="<?= $data['adm']['email_admin']; ?>" readonly>
                            </div>
                        </div>
                        <h3>Change Your Password Now</h3>
                        <div class="col-6 mb-5">
                            <form action="<?= BASEURL; ?>/AdminControllers/profile/changePassword" method="POST">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password :</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Change Your Password Here" required autofocus>
                                </div>
                        </div>
                        <div class="col-6 mb-5">
                            <div class="form-group">
                                <label for="confirmPassword" class="form-label">Confirm Password :</label>
                                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password Here" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-danger"><span><i class="bi bi-gear me-2"></i></span>Change Password</button>
        </form>
    </div>
</div>