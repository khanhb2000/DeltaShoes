<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/index">Trang admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quản lý khách hàng</a></li>
            </ol>
        </nav>
        <div class="admin">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-3">
                        <div class="menu">
                            <h5 class="title">Trang Admin</h5>
                            <p>Xin chào, <span style="color:#ff2d37;"><?= $_SESSION["admin"]->fullname?></span>&nbsp;!</p>
                            <ul class="list-group list-group-light">
                                <li class="list-group-item px-3 border-0">
                                    <a href="<?php echo ROOT; ?>/admin/index">Thông tin tài khoản</a>
                                </li>
                                <li class="list-group-item px-3 border-0">
                                    <a href="<?php echo ROOT; ?>/admin/products">Quản lý sản phẩm</a>                            
                                </li>
                                <li class="list-group-item px-3 border-0 active">
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
                    </div>
                    <div class="col-lg-9">
                        <h1 class="page-title">Danh sách khách hàng</h1>
                        <div class="input-group rounded mb-2" style="max-width: 500px">
                            <input type="search"  id="search" class="form-control rounded"/>
                            <span class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-dark">
                                <th>Email</th>
                                <th>Họ và tên</th>
                                <th>Số điện thoại</th>
                                <th>Tham gia từ</th>
                                <th>Số đơn hàng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id = "users-list">
                            
                        </tbody>
                        </table>
                        <nav>
                            <ul class="pagination" id="pagination">
                                
                            </ul>
                        </nav>
                        <div class="modal fade" id="user-info" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thông tin tài khoản</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="info"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        let users = [];
        let obj = {}
        <?php 
            foreach ($data['users'] as $user) {
        ?>
        obj = {}
        <?php
            foreach ($user as $key => $value) {
        ?>
                obj["<?= $key?>"] = "<?= $value?>"
        <?php
            }
        ?>
            users.push(obj)
        <?php
            }
        ?>
    </script>
    <script type="text/javascript" src="<?= ROOT?>/assets/js/admin_users.js"></script>
</body>