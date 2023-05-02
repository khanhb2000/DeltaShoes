<?php require APPROOT.'/views/header.php'; ?>
  <main class="container">
        <div class="row">
            <nav aria-label="breadcrumb" class="mt-4">
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/index">Trang admin</a></li>
                  <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/orders">Danh sách đơn hàng</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Thông tin đơn hàng</li>
              </ol>
            </nav>
        </div>
    <div class="admin">
      <a href="<?= ROOT?>/admin/orders"><i class="fa-solid fa-arrow-left fa-xl p-4 ps-0"></i></a>
      <h1 class="page-title">
          Thông tin đơn hàng
      </h1>
      <div class="container">
        <h6 class="fw-bold">Người nhận</h6>
        <p>Tên: <?= $data['orderdetail']->fullname ?></p>
        <p>Số điện thoại: <?= $data['orderdetail']->phone ?></p>
        <p>Email: <?= $data['orderdetail']->email ?></p>
        <p>Địa chỉ: <?= $data['orderdetail']->address ?></p>
        <p>Ghi chú: <?= $data['orderdetail']->note ?></p>
      </div>
      <div class="container">
        <h6 class="fw-bold">Sản phẩm</h6>
          <table id="cart" class="table table-hover table-condensed">
            <thead>
              <tr>
                <th style="width:55%">Sản phẩm</th>
                <th style="width:10%">Giá</th>
                <th style="width:8%">Số lượng</th>
                <th style="width:22%" class="text-center">Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $quantities = 0;
                $total = 0;
                if ($data['orderitems']) {
                  foreach ($data['orderitems'] as $orderitem) {
                    $quantities += $orderitem->quantity;
                    $total += $orderitem->price * $orderitem->quantity;
              ?>
                <tr>
                  <td data-th="Product">
                    <div class="row">
                      <div class="col-4"><img src='<?= ROOT?>/assets/img/<?= basename($orderitem->image)?>' style="height: 100px; width: 100px" alt="Sản phẩm"></div>
                      <div class="col-8">
                        <span class="d-inline-flex flex-column">
                            <?= $orderitem->name ?>
                            <br>
                            <span><?=  $orderitem->color?>, <?=  $orderitem->size?></span>
                        </span>
                      </div>
                    </div>
                  </td>
                <td data-th="Price"><?= number_format($orderitem->price, 0, ',', '.') ?></td>
                <td data-th="Quantity"><?= $orderitem->quantity?></td>
                <td data-th="Subtotal" class="text-center"><?= number_format($orderitem->price * $orderitem->quantity, 0, ',', '.')  ?></td>
              </tr>
              <?php }}?>
            </tbody>
          </table>
        
          <div class="container">
            <div class="row">
              <div class="col">
                <form method="post" action="update_order_status?id=<?= $data['orderdetail']->id?>">
                  <select name="status" class="form-select" id="status" style="width: 200px; display: inline-block">
                      <option value = "0" <?php if ($data['orderdetail']->status == 0) echo "selected"?> >Đang xử lí</option>
                      <option value = "1" <?php if ($data['orderdetail']->status == 1) echo "selected"?> >Đang vận chuyển</option>
                      <option value = "2" <?php if ($data['orderdetail']->status == 2) echo "selected"?>>Hoàn thành</option>
                      <option value = "3" <?php if ($data['orderdetail']->status == 3) echo "selected"?>>Đã hủy</option>
                  </select>
                  <button type="submit" class="btn btn-primary" id="update-order-status">Cập nhật</button>
                </form>
              </div>
              <div class="col">
                <div class="d-flex flex-column align-items-end">
                  <div><h6 class="fw-bold">Số lượng: <?= $quantities?></h6></div>
                  <div><h6 class="fw-bold">Phí ship: <?= number_format($data['orderdetail']->shipping_cost, 0, ',', '.')?></h6></div>
                  <div><h6 class="fw-bold">Thành tiền: <?=  number_format($total + $data['orderdetail']->shipping_cost, 0, ',', '.')?></h6></div>
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
</body>

</html>