<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <div class="row">
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/index">Trang admin</a></li>
                <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/products">Quản lý sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa sản phẩm</li>
                </ol>
            </nav>
        </div>
        <div class="admin">
        <a href="<?= ROOT?>/admin/products"><i class="fa-solid fa-arrow-left fa-xl p-4 ps-0"></i></a>
        <h1 class="page-title">
            Chỉnh sửa sản phẩm
        </h1>

            <form method="POST" action="update_product?id=<?= $data['product']->id ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-8 mb-4">
                        <label for="name" class="form-label">Sản phẩm</label>
                        <input type="text" name="name" class="form-control form-control-lg" value="<?= $data['product']->name?>"/>
                    </div>
                    <div class="col-4 mb-4">
                        <label for="brand" class="form-label">Thương hiệu</label>
                        <input type="text" name="brand" class="form-control form-control-lg" value="<?= $data['product']->brand?>"/>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="categories_id" class="form-label">Thể loại</label>
                        <select name="categories_id" class="form-select" id="category">
                            <?php
                                foreach ($data['categories'] as $category) {
                                    echo "<option value='$category->id'".($category->id == $data['product']->categories_id ? "selected>" : ">");
                                    echo $category->name;
                                    echo "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="sub_categories_id" class="form-label">Tiểu thể loại</label>
                        <select name="sub_categories_id" class="form-select" id="sub_category">
                            <?php
                                foreach ($data['sub_categories'] as $sub_category) {
                                    if ($sub_category->categories_id == $data['product']->categories_id) {
                                        if ($sub_category->id === $data['product']->sub_categories_id) 
                                            echo "<option value=$sub_category->id selected>$sub_category->name</option>";
                                        else echo "<option value=$sub_category->id>$sub_category->name</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 mb-4">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control form-control-lg description"><?= $data['product']->description?></textarea>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" name="files[]" multiple>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="row">
                            <?php 
                                if ($data['images'] != null) {
                                    foreach ($data['images'] as $image) {                            ?>
                            <div class="col-3 card mb-2">
                                <img src= '<?= ROOT?>/assets/img/<?= basename($image->name)?>' class="card-img-top" alt="Hình"/>
                                
                            </div>
                            <?php }}?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
                <div id="alert"></div>
                <ul class="nav nav-tabs mb-4" role="tablist">
                    <?php
                        if ($data['colors'] != null) {
                            for ($i = 0; $i < count($data['colors']); $i++) {?>
                            <a class="nav-item" role="presentation">
                                <button class="nav-link <?php if ($i == 0) echo 'active';?>" data-mdb-toggle="tab" href="#<?= $data['colors'][$i]->color ?>" type="button" role="tab" aria-selected="<?php if ($i==0) echo 'true'; else echo 'false';?>"><?= $data['colors'][$i]->color ?></button>
                            </a>
                    <?php }} ?>
                        <a class="nav-item" role="presentation" id="nav-add">
                            <i class="nav-link" data-mdb-toggle="tab" href="#pills-add" role="tab" aria-selected="false">+</i>
                        </a>
                </ul>
                <div class="tab-content">
                    <?php 
                    if ($data['colors'] != null) {
                    for ($i = 0; $i < count($data['colors']); $i++) {?>
                        <div class="tab-pane fade <?php if ($i == 0) echo "show active" ?>" id="<?= $data['colors'][$i]->color ?>" role="tabpanel">
                            <div class="table-add mb-3 mr-2" id = "<?= $i?>">
                                <a class="text-success">
                                    <i class="fas fa-plus fa-2x" aria-hidden="true"></i>
                                </a>
                            </div>
                            <table class="table table-bordered table-responsive-md table-striped text-center table-editable">
                                <thead>
                                    <tr>
                                        <th>Size</th>
                                        <th>Giá gốc</th>
                                        <th>Giá giảm</th>
                                        <th>Số lượng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($data['products_sku'] as $product_sku):
                                            if ($product_sku->color == $data['colors'][$i]->color) {
                                                $id_sku = $product_sku->id;
                                    ?>
                                        <tr>
                                            <form method="POST" action="edit_product_sku?id=<?= $id_sku ?>&&p_id=<?= $data['product']->id ?>">
                                                <td><input type='number' value=<?= $product_sku->size?> name="size" readonly/></td>
                                                <td><input type='number' value=<?= $product_sku->price?> name="price" required/></td>
                                                <td><input type='number' value=<?= $product_sku->discount_price?> name="discount_price" required/></td>
                                                <td><input type='number' value=<?= $product_sku->in_stock?> name="in_stock" required/></td>
                                                <td>
                                                    <button name="edit" value="update" class="btn btn-success update_product_sku" style="padding: 10px">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                    <button name="edit" value="delete" class="btn btn-danger delete_product_sku" style="padding: 10px">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </form>
                                        </tr>
                                    <?php
                                        }
                                        endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php }} ?>
                        <div class="tab-pane fade" id="pills-add" role="tabpanel">
                            <span>
                                <div class="form-outline" style="width: 100px; display: inline-block;">
                                    <input type="text" class="form-control form-control-lg" id="new-color"/>
                                    <label for="new-color" class="form-label">Màu mới</label>
                                    
                                </div>
                            </span>
                            <span>
                                <button class="btn btn-primary" id="btn-new-color" style="padding: 10px">
                                        Thêm màu mới
                                </button>
                            </span>
                        </div>
                </div>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?= ROOT?>/assets/js/admin.js"></script>
    <script>
        let sub_categories = [];
        <?php
            foreach ($data['sub_categories'] as $sub_category):
        ?> 
        sub_categories.push(["<?php echo $sub_category->id?>","<?php echo $sub_category->name?>", "<?php echo $sub_category->categories_id?>"]);
        <?php endforeach;?>
        $("#category").change(function() {
            $("#sub_category").html(``);
            $.map(sub_categories, (e) => {
                if (e[2] === $('#category').val()) {
                    $("#sub_category").append(`
                        <option value=${e[0]}>${e[1]}</option>
                    `)
                }
            })
        })

        $(document).on('click', '.insert_product_sku', function() {
            insertProductSku($(this), "insert_product_sku?id=<?= $data['product']->id ?>")
        })

        $(document).on('click', 'delete_product_sku', function() {
            deleteProductSku($(this), "delete_product_sku?id=<?= $data['product']->id ?>")
        })
    </script>
</body>
</html>