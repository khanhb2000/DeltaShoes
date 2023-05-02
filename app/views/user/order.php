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
                    <li class="list-group-item px-3 border-0">
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
                            <th>Thời gian tạo đơn</th>
                            <th>Tình trạng</th>
                            <th>Phí giao hàng </th>
                            <th>Số tiền</th>
                            <th>Chi tiết đơn hàng </th>
                          </tr>
                       </thead>
                       <tbody id="orders-list">
                            <?php
                                if (is_array($data['orders']) || is_object($data['orders'])){
                                    foreach ($data['orders'] as $order) {
                                        echo "<tr>";
                                        echo "<td> $order->id </td>";
                                        echo "<td> $order->created_at </td>";
                                        $shippingStatus = "Đang xử lí";
                                        if($order->status == 1) {
                                            $shippingStatus = "Đang vận chuyển";
                                        } else if($order->status == 2) { 
                                            $shippingStatus = "Hoàn thành";
                                        } else if($order->status == 3) { 
                                            $shippingStatus = "Đã hủy";
                                        }
                                    
                                        $link = ROOT;
                                        echo "<td> $shippingStatus </td>";
                                        echo "<td> $order->shipping_cost </td>";
                                        echo "<td> $order->total_price </td>";
                                        echo "<td><a type='button' class='btn btn-primary' href='$link/user/orderdetail?id=$order->id'> Xem  </a></td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                       </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li>
                                <a class="page-link" aria-label="Previous" id="btn-prev" disabled>
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link">1</a></li>
                            <li class="page-item"><a class="page-link">2</a></li>
                            <li class="page-item"><a class="page-link">3</a></li>
                            <li>
                                <a class="page-link" aria-label="Next" id="btn-next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div><!--/row-->                                                  
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
</body>
</html>