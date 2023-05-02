<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Trang khách hàng</a></li>
            </ol>
        </nav>
    
    <div class="user">
        <div class="row">
            <div class="col-12 col-sm-3 menu">
                <h5 class="title">Trang khách hàng</h5>
                <p>Xin chào, <span style="color:#ff2d37;"><?= $data['fullname']?></p>
                <ul class="list-group list-group-light">
                    <li class="list-group-item px-3 border-0 active">
                        <a href="<?php echo ROOT; ?>/user/index">Thông tin tài khoản</a>
                    </li>
                    <li class="list-group-item px-3 border-0">
                        <a href="<?php echo ROOT; ?>/user/changepassword">Đổi mật khẩu</a>
                    </li>
                    <li class="list-group-item px-3 border-0">
                        <a href="<?php echo ROOT; ?>/user/order">Quản lý đơn hàng</a>
                    </li>
                    <li class="list-group-item px-3 border-0">
                        <a href="<?php echo ROOT; ?>/user/logout">Đăng xuất</a>
                    </li>
                </ul>   
            </div>
            <div class="col-sm-9">  
                <h1 class="page-title">Thông tin tài khoản</h1>
                    <form class="form" action="" method="post">
                        <div class="mb-4">
                            <label for="fullname">Họ tên</label>
                            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Tên người dùng" value="<?php echo $data['fullname'] ?>" required/>
                        </div>
                        <div class="mb-4">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" value="<?php echo $data['email'] ?>" readonly required>
                        </div>
                        <div class="mb-4">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" value="<?php echo $data['phone'] ?>" required >
                        </div>
                        <div class="mb-4">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address'] ?>" required>
                        </div>
                        <button class="btn btn-info" name="btnUpdateUser" type="submit">Cập nhật</button>
                    </form>
            </div><!--/col-9-->
        </div><!--/row-->                                                  
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
</body>
</html>