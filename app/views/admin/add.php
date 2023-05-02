<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/index">Trang admin</a></li>
                <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/products">Quản lý sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm</li>
            </ol>
        </nav>
        <div class="admin">
            <a href="<?= ROOT?>/admin/products"><i class="fa-solid fa-arrow-left fa-xl p-4 ps-0"></i></a>
                <h1 class="page-title">
                    Thêm sản phẩm
                </h1>
                <form method="POST" action="add_product" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-8 mb-4">
                            <label for="name" class="form-label">Sản phẩm</label>
                            <input type="text" name="name" class="form-control form-control-lg" required/>
                        </div>
                        <div class="col-4 mb-4">
                            <label for="brand" class="form-label">Thương hiệu</label>
                            <input type="text" name="brand" class="form-control form-control-lg" required/>
                        </div>

                        <div class="col-6 mb-4">
                            <label for="categories_id" class="form-label">Thể loại</label>
                            <select name="categories_id" class="form-select" id="category" required>
                                <option disabled selected value>Chọn một thể loại</option>
                                <?php
                                    foreach ($data['categories'] as $category) {
                                        echo "<option value='$category->id'>";
                                        echo $category->name;
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="col-6 mb-4">
                            <label for="sub_categories_id" class="form-label">Tiểu thể loại</label>
                            <select name="sub_categories_id" class="form-select" id="sub_category" required></select>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control form-control-lg description" required></textarea>
                        </div>

                        <div class="col-12 mb-4">  
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" name="files[]" multiple required> 
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
    </script>
    
</body>
</html>