<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?=ROOT?>/home/products">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $data['product']->name?></li>
            </ol>
        </nav>
        <h1 class="page-title"><?= $data['product']->name?></h1>
        <div class = "container-xl mb-4">
            <div class = "row">
                <div class = "col-12 col-lg-9">
                    <div class = "container-fluid p-0">
                        <div class = "row mb-5">
                            <div class = "col-12 col-sm-6">
                                <div style = "border: 1px solid #c6cddb">
                                    <img class = "w-100" id = "image">
                                </div>
                            </div>
                            <div class = "col-12 col-sm-6">
                                 <!-- images carosel-->
                                <div class="row" class="w-100">
                                    <div class="owl-carousel owl-theme">
                                        <?php foreach ($data["images"] as $image) { ?>
                                            <div class="item mb-4 images">
                                                <div class="card border-0">
                                                    <img src="<?= ROOT?>/assets/img/<?= $image->name?>" alt="image" class="card-img-top">
                                                </div>
                                            </div>
                                        <?php }?>
                                    </div>
                                </div> 
                                 <!-- end images -->
                
                                <h4><?= $data['product']->name?></h4>
                                <div class = "mb-4">
                                    <span>Thương hiệu:
                                        <span class = "text-primary"><?= $data["product"]->brand?></span>
                                    </span>
                                    <span>
                                        <span>|</span>
                                        Tình trạng:
                                        <span class = "text-primary">Còn hàng</span>
                                    </span>
                                </div>
                                <div class = "mb-5" id="price">
                                    <span class = "text-primary fs-1 fw-bold"><?= number_format($data["products_sku"][0]->discount_price, 0, ',', '.')?>đ</span>
                                    <span class="text-decoration-line-through"><?php if ($data["products_sku"][0]->discount_price != $data["products_sku"][0]->price) echo number_format($data["products_sku"][0]->price, 0, ',', '.')?>đ</span>
                                </div>
                                <form id="details">
                                    <div id="alert">

                                    </div>
                                    <div class="mb-5">
                                        <span class = "fw-bold">Màu sắc:</span>
                                        <span id = "color-choice">

                                        </span>
                                    </div>
                                    <div class = "mb-5">
                                        <span class = "fw-bold">Kích thước:</span>
                                        <span id = "size-choice">
                                                        
                                        </span>
                                    </div>
                                    <div class = "mb-5">
                                        <span class = "fw-bold">Số lượng:</span>
                                            <div class = "quantity-choice d-inline-flex">
                                                <button type="button" class="btn btn-primary" id="quantity-decrease">-</button>
                                                <input class = "text-center" type = "number" value = "1" id="quantity" style="width: 60px" required>
                                                <button type="button" class="btn btn-primary" id="quantity-increase">+</button>
                                            </div>
                                                
                                     </div>
                                    <button type="button" class=" bg-primary px-5 py-3 rounded-5 fs-5 fw-bold" id="buy">MUA NGAY</button>
                                </form>
                            </div>
                        </div>
                        <div>
                            <ul class="nav nav-pills" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Mô tả sản phẩm</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Đánh giá</button>
                                </li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel" tabindex="0" style="white-space: pre-line">
                                    <?= $data["product"]->description?>
                                </div>
                                <div class="tab-pane fade" id="comment-tab-pane" role="tabpanel" tabindex="0">Đánh giá</div>
                              </div>
                              
                        </div>
                    </div>
                </div>
                <div class = "col-0 col-lg-3 d-none d-lg-block" >
                    <div class="col-12 mb-4">
                        <div class="row">
                            <div class="col-3">
                                <img src="//bizweb.dktcdn.net/100/342/645/themes/701397/assets/srv_1.png?1664094665337" alt="icon free shipping" style="max-width: 100%">
                            </div>
                            <div class="col-9">
                                <div style="font-weight: bold">Miễn phí vận chuyển</div>
                                <span>Miễn phí vận chuyển nội thành</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="row">
                            <div class="col-3">
                                <img img src="//bizweb.dktcdn.net/100/342/645/themes/701397/assets/srv_2.png?1664094665337" alt="icon return" style="max-width: 100%">
                            </div>
                            <div class="col-9">
                                <div style="font-weight: bold">Đổi trả hàng</div>
                                <span>Đổi trả lên tới 30 ngày</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="row">
                            <div class="col-3">
                                <img src="//bizweb.dktcdn.net/100/342/645/themes/701397/assets/srv_3.png?1664094665337" alt="This is icon" style="max-width: 100%">
                            </div>
                        <div class="col-9">
                            <div style="font-weight: bold">Tiết kiệm thời gian</div>
                                <span>Mua sắm dễ hơn khi online</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="row">
                            <div class="col-3">
                                <span><img src="//bizweb.dktcdn.net/100/342/645/themes/701397/assets/srv_4.png?1664094665337" alt="This is logo icon" style="max-width: 100%"></span>
                            </div>
                            <div class="col-9">
                                <div style="font-weight: bold">Tư vấn trực tiếp</div>
                                <span>Đội ngũ tư vấn nhiệt tình</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                responsive:{
                    0:{
                        items:4
                    },
                    600:{
                        items:4
                    },
                    1000:{
                        items:5
                    }
                }
            })

        </script>
        <script>
            products_sku = <?= json_encode($data["products_sku"]) ?>;
            images = <?= json_encode($data["images"])?>;
            $("#image").attr("src",`<?php echo ROOT?>/assets/img/${images[0].name}`);

            color_size = {}
            colors = []
            sizes = []
            products_sku.forEach(function (product, index) {
                color_size[[product["color"], product["size"]]] = product
                if (!colors.includes(product["color"])) colors.push(product["color"])
                if (!sizes.includes(product["size"])) sizes.push(product["size"])
            })

            sizes.sort(function(a, b) {
                return a - b;
            })
            $.each(colors, function(index, color) {
                $('#color-choice').append(`
                    <input type="radio" name="color-choice" value="${color}" required>
                    <label>${color}</label>
                `)
            })

            $.each(sizes, function(index, size) {
                $('#size-choice').append(`
                    <input type="radio" name="size-choice" value=${size} required>
                    <label>${size}</label>
                `)
            })

            $('#color-choice').on('change', function(e) {
                $('#size-choice').html('')
                $.each(sizes, function(index, size) {
                    disabled = color_size[[e.target.value, size]] !== undefined ? false : true
                    if (disabled) {
                        $('#size-choice').append(`
                            <input type="radio" name="size-choice" value=${size} disabled>
                            <label>${size}</label>
                        `)
                    }
                    else {
                        $('#size-choice').append(`
                            <input type="radio" name="size-choice" value=${size} required>
                            <label>${size}</label>
                        `)
                    }
                })
            })

            $('#size-choice').on('change', function(e) {
                color_choice = $('input[name=color-choice]:checked', '#details').val()
                if (color_size[[color_choice, parseInt(e.target.value)]] !== undefined) {
                    product = color_size[[color_choice, parseInt(e.target.value)]]
                    $('#price').html(`
                        <span class = "text-primary fs-1 fw-bold">${product.discount_price.toLocaleString("de-DE")}đ</span>
                        
                    `)
                    if (product.discount_price != product.price) {
                        console.log(product.price)
                        $('#price').append(`<span class="text-decoration-line-through">${product.price.toLocaleString("de-DE")}đ</span>`)
                    }
                }
            })
            $("#quantity-increase").click(function() {
                $('#quantity').val(parseInt($('#quantity').val()) + 1)
            })

            $("#quantity-decrease").click(function() {
                if ($('#quantity').val() > 1) $('#quantity').val(parseInt($('#quantity').val()) - 1)
            })
            
            $("#buy").on('click', function() {
                <?php if (empty($_SESSION["admin"])) { ?>
                    name = "<?= $data["product"]->name; ?>"
                    image = "<?= $data["images"][0]->name ?>"
                    quantity = $('#quantity').val()
                    color = $('input[name=color-choice]:checked', '#details').val()
                    size =  $('input[name=size-choice]:checked', '#details').val()
                    if (color_size[[color, size]] === undefined) {
                        $("#alert").html(`
                            <div class="alert alert-danger">Vui lòng chọn đầy đủ màu và size giày!</div>
                        `)
                    } else {
                        if (quantity <= 0) {
                            $("#alert").html(`
                                <div class="alert alert-danger">Vui lòng chọn số lượng phù hợp</div>
                            `)
                        } else {
                            price = color_size[[color, size]].price
                            discount_price = color_size[[color, size]].discount_price
                            $.post({
                                url: "add_to_cart?id=" + color_size[[color, size]].id,
                                data: jQuery.param({name: name, image: image, quantity: quantity, color: color, size: size, price: price, discount_price: discount_price}),
                                success: function(result){
                
                                    $("#alert").html(`
                                        <div class="alert alert-success">Thêm vào giỏ hàng thành công</div>
                                    `)
                                    console.log(result)
                                }
                            })
                        }
                    }
                <?php }?>
            })
            
            /*
            document.getElementById('categori').textContent = item['category']
            document.getElementById('categori2').textContent = item['category']*/
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>