<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>
        <h1 class="page-title">Tất cả sản phẩm</h1>
        <div class = "container-xl">
            <div class = "row">
                <div class = "btn-aside d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasResponsive" aria-controls="offcanvasResponsive">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <aside class = "col-0 col-lg-3" id="aside">
                    <div class="offcanvas-lg offcanvas-end overflow-auto p-4 p-lg-0" data-bs-scroll="true" tabindex="-1" id="offcanvasResponsive" aria-labelledby="offcanvasResponsiveLabel">
                        <div class = "card w-100 border border-0 mb-5 shadow-0" id="categories">
                            <h5 class="card-header bg-white text-dark border border-0 ps-0">THỂ LOẠI</h5>
                            <ul class="list-group list-group-flush border">

                            </ul>
                        </div>
                        <div class = "card w-100 border border-0 mb-5 shadow-0" id="sub_categories">
                            <h5 class="card-header bg-white text-dark border border-0 ps-0">CHI TIẾT</h5>
                            <ul class="list-group list-group-flush border">

                            </ul>
                        </div>
                        <div class = "card w-100 border border-0 mb-5 shadow-0" id="prices">
                            <h5 class="card-header bg-white text-dark border border-0 ps-0">MỨC GIÁ</h5>
                            <ul class="list-group list-group-flush border">
                            </ul>
                        </div>
                        <!--
                        <div class = "card w-100 border border-0 mb-5 shadow-0" id="sizes">
                            <h5 class="card-header bg-white text-dark border border-0 ps-0">KÍCH CỠ</h5>
                            <div class = "d-flex flex-wrap border ps-3 pt-2 pb-2">
                            </div>
                        </div>
                        -->
                        <div class = "card w-100 border border-0 mb-5 shadow-0" id="brands">
                            <h5 class="card-header bg-white text-dark border border-0 ps-0">THƯƠNG HIỆU</h5>
                            <ul class="list-group list-group-flush border">
                            </ul>
                        </div>
                        <!--
                        <div class = "card w-100 border border-0 mb-5 shadow-0" id="colors">
                            <h5 class="card-header bg-white text-dark border border-0 ps-0">MÀU SẮC</h5>
                            <div class = "d-flex flex-wrap border ps-3 pt-2 pb-2">
                            </div>
                        </div>
                        !-->
                    </div>
                </aside>
                <div class = "col-12 col-lg-9" id="sort">
                    <h6 class = "d-inline-block me-5">Sắp xếp: </h6>
                    <div class="form-check form-check-inline text-hover-primary">
                                <input class="form-check-input me-2 border rounded-0" type="radio" id="filter-cost-increase" value="increase" name="filter-cost-sort">
                                <label class="form-check-label" for="filter-cost-increase">Giá tăng dần</label>
                    </div>
                    <div class="form-check form-check-inline text-hover-primary">
                                <input class="form-check-input me-2 border rounded-0" type="radio" id="filter-cost-decrease" value="decrease" name="filter-cost-sort">
                                <label class="form-check-label" for="filter-cost-decrease">Giá giảm dần</label>
                    </div>
                    <hr>
                    <div class = "row" id = "product-list">
                        
                    </div>
                    <nav>
                        <ul class="pagination justify-content-end" id="pagination">
                          
                        </ul>
                      </nav>
                </div>
            </div>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
    <script>
        var product_items=<?php echo json_encode($data["products"]); ?>;
        var brands = <?= json_encode($data["brands"]);?>;
        var colors = <?= json_encode($data["colors"]);?>;
        var categories = <?= json_encode($data["categories"]);?>;
        var sub_categories = <?= json_encode($data["sub_categories"]);?>;
        var root = "<?= ROOT?>"

        
    </script>
    <script type="text/javascript" src="<?= ROOT?>/assets/js/home_products.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>