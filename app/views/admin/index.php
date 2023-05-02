<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <div class="row">
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Trang admin</a></li>
                </ol>
            </nav>
        </div>
        <div class="admin">
            <div class="row">
                <div class="col-12 col-sm-3 menu">
                    <h5 class="title">Trang Admin</h5>
                    <p>Xin chào, <span style="color:#ff2d37;"><?= $_SESSION["admin"]->fullname?></p>
                    <ul class="list-group list-group-light">
                        <li class="list-group-item px-3 border-0 active">
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
                        <li class="list-group-item px-3 border-0">
                            <a href="<?= ROOT; ?>/admin/changepassword">Đổi mật khẩu</a>
                        </li>
                        <li class="list-group-item px-3 border-0">
                            <a href="<?= ROOT; ?>/admin/logout">Đăng xuất</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-9">
                        <h1 class="page-title">Thông tin tài khoản</h1>
                            <form class="form" action="" method="post">
                            <div class="mb-4">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" name="fullname" class="form-control" value="<?php echo $data['fullname'] ?>" required/>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $data['email'] ?>" readonly required/>
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" pattern="[0-9]{10}" name="phone" class="form-control" value="<?php echo $data['phone'] ?>" required/>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="<?php echo $data['address'] ?>" required/>
                            </div>
                            <button class="btn btn-primary" name="btnUpdateUser" type="submit">Cập nhật</button>
                        </form>
                </div>
            </div>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
</body>