<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/index">Trang admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
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
                            <li class="list-group-item px-3 border-0">
                                <a href="<?= ROOT; ?>/admin/users">Quản lý khách hàng</a>
                            </li>
                            <li class="list-group-item px-3 border-0 active">
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
                    <h1 class="page-title">Danh sách đơn hàng</h1>
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group rounded">
                                    <input type="search"  id="search" class="form-control rounded"/>
                                    <span class="input-group-text border-0" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <select name="status" class="form-select" id="status">
                                    <option selected value = "0">Đang xử lí</option>
                                    <option value = "1">Đang vận chuyển</option>
                                    <option value = "2">Hoàn thành</option>
                                    <option value = "3">Đã hủy</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <table class="table table-striped table-bordered">
                       <thead>
                          <tr class="table-dark">
                            <th>Mã đơn</th>
                            <th>Mã khách hàng</th>
                            <th>Thời gian nhận đơn</th>
                            <th>Tình trạng</th>
                            <th>Số tiền</th>
                            <th></th>
                          </tr>
                       </thead>
                       <tbody id="orders-list">
                        
                       </tbody>
                    </table>
                    <nav>
                        <ul class="pagination" id="pagination">
                            
                        </ul>
                    </nav>
                </div>
            <div>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    let orders = [];
    let obj = {}
    <?php 
        foreach ($data['orders'] as $order) {
    ?>
    obj = {}
    <?php
        foreach ($order as $key => $value) {
    ?>
            obj["<?= $key?>"] = "<?= $value?>"
    <?php
        }
    ?>
        orders.push(obj)
    <?php
        }
    ?>
</script>
<script type="text/javascript" src="<?= ROOT?>/assets/js/admin_orders.js"></script>
</body>
</html>
