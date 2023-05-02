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
                    <li class="list-group-item px-3 border-0">
                        <a href="<?php echo ROOT; ?>/user/index">Thông tin tài khoản</a>
                    </li>
                    <li class="list-group-item px-3 border-0 active">
                        <a href="<?php echo ROOT; ?>/user/changepassword">Đổi mật khẩu</a>
                    </li>
                    <li class="list-group-item px-3 border-0 active">
                        <a href="<?php echo ROOT; ?>/user/order">Quản lý đơn hàng</a>
                    </li>
                    <li class="list-group-item px-3 border-0">
                        <a href="<?php echo ROOT; ?>/user/logout">Đăng xuất</a>
                    </li>
                </ul>   
            </div>
            <div class="col-lg-9">
                    <h1 class="page-title">Chi tiết đơn hàng</h1>
                    <div class="mb-2">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group rounded">
                                    <!-- <input type="search"  id="search" class="form-control rounded"/>
                                    <span class="input-group-text border-0" id="search-addon">
                                        <i class="fas fa-search"></i>
                                    </span> -->
                                </div>
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3">
                                <select name="status" class="form-select" id="status" disabled>
                                    <option <?php if($data['order']->status == 0) echo "selected"; ?> value = "0">Đang xử lí</option>
                                    <option <?php if($data['order']->status == 1) echo "selected"; ?> value = "1">Đang vận chuyển</option>
                                    <option <?php if($data['order']->status == 2) echo "selected"; ?> value = "2">Hoàn thành</option>
                                    <option <?php if($data['order']->status == 3) echo "selected"; ?>value = "3">Đã hủy</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <table class="table table-striped table-bordered">
                       <thead>
                          <tr class="table-dark">
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Tổng</th>
                          </tr>
                       </thead>
                       <tbody id="orders-list">
                            <?php
                                if (is_array($data['orderitems']) || is_object($data['orderitems'])){

                                    foreach ($data['orderitems'] as $order) {
                                        $total = ((float) $order->price_per_unit) * $order->quantity;
                                        $link = ROOT;
                                        echo "<tr>";
                                        echo "<td> <a href='$link/home/product/?id=$order->product_id'> $order->name - $order->color </a> </td>";
                                        echo "<td> $order->quantity </td>";
                                        echo "<td> $order->price_per_unit </td>";
                                        echo "<td> $total </td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                       </tbody>
                    </table>
                </div>
        </div><!--/row-->                                                  
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
</body>

</html>