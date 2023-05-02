<?php require APPROOT.'/views/header.php'; ?>
  <main class="container-md">
    <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
        </ol>
    </nav>
    <h1 class="page-title">Giỏ hàng của bạn</h1>
        <?php if (empty($_SESSION["cart"])) {?>
            <div class="alert alert-info" style="max-width: 500px; margin: auto" role="alert">
                Bạn chưa có sản phẩm nào trong giỏ hàng
            </div>
        <?php } else {?>
                <table id="cart" class="table table-hover table-condensed">
                <thead>
                    <tr>
                    <th style="width:50%">Sản phẩm</th>
                    <th style="width:15%">Giá</th>
                    <th style="width:12%">Số lượng</th>
                    <th style="width:22%" class="text-center">Thành tiền</th>
                    <th style="width:1%"> </th>
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
                    <tr id = "<?= $key ?>">
                        <td data-th="Product" >
                            <span><img src='<?= ROOT?>/assets/img/<?= basename($value["image"])?>' style="height: auto; max-width: 100px" alt="Sản phẩm"></span>
                            <span class="d-inline-flex flex-column">
                                <?= $value['name'] ?>
                                <br>
                                <span><?=  $value['color']?>, <?=  $value['size']?></span>
                            </span>
                        </td>
                        <td data-th="Price"><?= number_format($value['discount_price'], 0, ',', '.')?> đ </td>
                        <td data-th="Quantity"><input type="number" class="form-control quantity-change" value="<?= $value["quantity"]?>" /> </td>
                        <td data-th="Subtotal" class="text-center"><?= number_format($value["quantity"] * $value["discount_price"], 0, ',', '.')  ?> đ</td>
                        <td>
                            <a href="<?= ROOT?>/home/remove_from_cart?id=<?=$key?>">
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-end">
                <h6 class="fw-bold">Số lượng: <?= $quantity?></h6>
                <h6 class="fw-bold">Thành tiền: <?= number_format($total, 0, ',', '.') ?></h6>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?= ROOT?>/home/products" class="btn btn-primary">
                    <i class="fa fa-angle-left"></i> Tiếp tục mua hàng
                </a>
                <a href="<?= ROOT?>/home/payment" class="btn btn-primary"
                    >Thanh toán <i class="fa fa-angle-right"></i>
                </a>
            </div>
        
        <?php }?>
      </div>
  </main>
  <?php require_once APPROOT.'/views/footer.php'; ?>
  <script>
    $(".quantity-change").on("change", function() {
        console.log($(this).closest("tr"));
        btn = $(this).closest("tr")
        quantity = $(this).val()
        $.post({
            url: "update_quantity",
            data: jQuery.param({ key: $(this).closest("tr").attr("id"), quantity: $(this).val()}),
            success: function(result){
                /*console.log($(`#${btn.attr("id")} td:eq(1)`).text().splice(0, -1))
                $(`#${btn.attr("id")} td:eq(3)`).text(
                    $(`#${btn.attr("id")} td:eq(2)`) * $(`#${btn.attr("id")} td:eq(2)`) 
                )*/
            }
        })
    })
  </script>
</body>

</html>