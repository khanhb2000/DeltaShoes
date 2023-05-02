<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="<?= ROOT?>/assets/css/stylePayment.css" />
        <title>Delta Shoes</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="<?= ROOT?>/assets/css/main.css">
    </head>
    <body>
        <main class="container py-5">
            <h1 class="page-title">Đặt hàng</h1>
            <p class="text-center">Sau khi hoàn tất đặt hàng, đơn hàng của bạn sẽ được chuẩn bị sẵn sàng trong vòng 7 ngày.</p>
            <h4>Đơn hàng</h4>

            <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                    <th style="width:50%">Sản phẩm</th>
                    <th style="width:16%">Giá</th>
                    <th style="width:12%">Số lượng</th>
                    <th style="width:22%" class="text-center">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $quantity = 0;
                    $total = 0;
                    foreach ($data as $key => $value) {
                        $quantity += $value["quantity"];
                        $total += $value["quantity"] * $value["discount_price"];
                    ?>
                    <tr>
                        <td>
                            <img src='<?= ROOT?>/assets/img/<?= basename($value["image"])?>' style="height: auto; max-width: 100px" alt="Sản phẩm">
                            <span class="d-inline-flex flex-column">
                                <?= $value['name'] ?>
                                <br>
                                <span><?=  $value['color']?>, <?=  $value['size']?></span>
                            </span>
                        </td>
                        <td><?= number_format($value['discount_price'], 0, ',', '.') ?> đ</td>
                        <td><?= $value['quantity'] ?></td>
                        <td><?= number_format($value["quantity"] * $value["discount_price"], 0, ',', '.')  ?> đ</td>
                    </tr>
                    <?php
                    }?>
                    <tr>
                        <td colspan="3" style="border:0; text-align:right;">Tiền hàng</td>
                        <td><?php echo $quantity ?></td>
                    </tr>

                    <tr>
                        <td colspan="3" style="border:0; text-align:right;">Tiền hàng</td>
                        <td><?= number_format($total, 0, ',', '.')  ?> đ</td>
                    </tr>

                    <tr>
                        <td colspan="3" style="border:0; text-align:right;">Phí vận chuyển</td>
                        <td>50.000 đ</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="border:0; text-align:right;">Tổng cộng</td>
                        <td><?= number_format($total + 50000, 0, ',', '.') ?> đ</td>
                    </tr>
            </table>
            <h4>Thông tin nhận hàng</h4>
            <form method="post" action="order">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="form-outline">
                            <input type="text" id="fullname" class="form-control" name="fullname" value="<?php if (!empty($_SESSION["user"])) echo $_SESSION["user"]->fullname?>" required/>
                            <label class="form-label" for="fullname">Họ tên</label>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="form-outline">
                            <input type="email" id="email" class="form-control" name="email" value="<?php if (!empty($_SESSION["user"])) echo $_SESSION["user"]->email?>" required/>
                            <label class="form-label" for="email">Email</label>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="form-outline">
                            <input type="tel" pattern="[0-9]{10}" id="phone" class="form-control" name="phone" value="<?php if (!empty($_SESSION["user"])) echo $_SESSION["user"]->phone?>" required/>
                            <label class="form-label" for="phone">Số điện thoại</label>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="form-outline">
                            <input type="text" id="address" class="form-control" name="address" value="<?php if (!empty($_SESSION["user"])) echo $_SESSION["user"]->address?>" required/>
                            <label class="form-label" for="address">Địa chỉ</label>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="form-outline">
                            <textarea class="form-control" id="note" name="note" rows="4"></textarea>
                            <label class="form-label" for="note">Ghi chú (nếu có)</label>
                        </div>                  
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?= ROOT?>/home/cart" class="btn btn-primary">
                        <i class="fa fa-angle-left"></i> Quay lại giỏ hàng
                    </a>
                    <button class="btn btn-primary" type="submit">Đặt hàng</button>
                </div>
            </form>
        </main>
    </body>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script>
        document.querySelectorAll('.form-outline').forEach((formOutline) => {
            new mdb.Input(formOutline).init();
        });
    </script>
</html>