<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/index">Trang admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thay đổi mật khẩu</li>
            </ol>
        </nav>
        <div class="admin">
            <div class="row">
                <div class="col-12 col-sm-3 menu">
                    <h5 class="title">Trang admin</h5>
                    <p>Xin chào, <span style="color:#ff2d37;"><?= $_SESSION["admin"]->fullname?></p>
                    <ul class="list-group list-group-light">
                        <li class="list-group-item px-3 border-0">
                            <a href="<?php echo ROOT; ?>/admin/index">Thông tin tài khoản</a>
                        </li>
                        <li class="list-group-item px-3 border-0">
                            <a href="<?php echo ROOT; ?>/admin/products">Quản lý sản phẩm</a>                            
                        </li>
                        <li class="list-group-item px-3 border-0">
                            <a href="<?= ROOT; ?>/admin/users">Quản lý khách hàng</a>
                        </li>
                        <li class="list-group-item px-3 border-0">
                            <a href="<?= ROOT; ?>/admin/orders">Quản lý đơn hàng</a>
                        </li>
                        <li class="list-group-item px-3 border-0 active">
                            <a href="<?= ROOT; ?>/admin/changepassword">Đổi mật khẩu</a>
                        </li>
                        <li class="list-group-item px-3 border-0">
                            <a href="<?= ROOT; ?>/admin/logout">Đăng xuất</a>
                        </li>
                    </ul>   
                </div>
                <div class="col-sm-9">  
                    <h1 class="page-title">Đổi mật khẩu</h1>
                        <form method= "POST">
                            <?php if(isset($data['error']) && $data['error'] !=""){?>
                                <div class="alert alert-danger"><?php echo $data['error'] ?></div>
                            <?php } ?>
                            <div class="mb-4">
                                <label for="email">Email đăng nhập</label>
                                <input value="<?php echo $data['email']?>" type="text" class="form-control" id="email" name="email" readonly>
                            </div>
                            <div class="mb-4">
                            <label for="oldPassword">Mật khẩu cũ</label>
                            <input value="<?php if(isset($data['oldPassword'])) echo $data['oldPassword'] ?>" type="password" class="form-control" id="oldPassword" name="oldPassword">
                            </div>
                            <div class="mb-4">
                            <label for="newPassword1">Mật khẩu mới</label>
                            <input value="<?php if(isset($data['newPassword1'])) echo $data['newPassword1'] ?>" type="password" class="form-control" id="newPassword1" name="newPassword1">
                            </div>
                            <div class="mb-4">
                                <label for="newPassword2">Xác nhận lại mật khẩu</label>
                                <input value="<?php if(isset($data['newPassword2'])) echo $data['newPassword2'] ?>" type="password" class="form-control" id="newPassword2" name="newPassword2">
                            </div>
                            <button type="submit" name="btnChangePassword" value="ChangePassword" class="btn btn-primary">Đặt lại mật khẩu</button>
                        </form>
                    </h1>
                </div>
            </div>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
</body>
</html>
