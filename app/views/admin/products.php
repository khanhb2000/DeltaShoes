<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <div class="row">
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="<?=ROOT?>/admin/products">Trang admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</a></li>
                </ol>
            </nav>
        </div>
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
                            <li class="list-group-item px-3 border-0 active">
                                <a href="<?php echo ROOT; ?>/admin/products">Quản lý sản phẩm</a>                            
                            </li>
                            <li class="list-group-item px-3 border-0">
                                <a href="<?= ROOT; ?>/admin/users">Quản lý khách hàng</a>
                            </li>
                            <li class="list-group-item px-3 border-0">
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
                    <h1 class="page-title">Danh sách sản phẩm</h1>
                    <div class="row justify-content-end mb-2">
                        <div class="col-6">
                            <a href="" style="margin-right: 5px" data-mdb-toggle="modal" data-mdb-target="#categories"><button class="btn btn-primary">Thêm thể loại mới</button></a>
                            <a href="<?= ROOT; ?>/admin/add"><button class="btn btn-primary">Thêm sản phẩm</button></a>
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="search" id="search" class="form-control" />
                                    <label class="form-label" for="search">Search</label>
                                </div>
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="modal fade" id="categories" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Các thể loại</h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-4">
                                        <div id="alert"></div>
                                        <label for="categories_id" class="form-label">Thể loại</label>
                                        <select name="category_name" class="form-select" id="category">
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
                                    
                                    
                                    <div class="mb-4 row">
                                        <div class="col-8">
                                            <div class="form-outline">
                                                <input type="text" id="new_category" class="form-control" placeholder="Thêm thể loại mới"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-primary" id="btn_new_category"><i class="fa-solid fa-plus"></i></button>
                                            <button type="button" class="btn btn-dark" id="btn_remove_category"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="sub_categories_id" class="form-label">Tiểu thể loại</label>
                                        <select name="sub_categories_id" class="form-select" id="sub_category">
                                        </select>
                                    </div>

                                    <div class="mb-4 row">
                                        <div class="col-8">
                                            <div class="form-outline">
                                                <input type="text" id="new_sub_category" class="form-control" placeholder="Thêm thể loại mới"/>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-primary" id="btn_new_sub_category"><i class="fa-solid fa-plus"></i></button>
                                            <button type="button" class="btn btn-dark" id="btn_remove_sub_category"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered">
                       <thead>
                          <tr class="table-dark">
                            <th>Tên</th>
                            <th>Loại giày</th>
                            <th>Nam/Nữ</th>
                            <th>Thương hiệu</th>
                            <th>Số lượng</th>
                            <th></th>
                          </tr>
                       </thead>
                       <tbody id="products-list">
                        
                       </tbody>
                    </table>
                    <nav>
                        <ul class="pagination" id="pagination">
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?= ROOT?>/assets/js/admin.js"></script>
    <script>
        let products = [];
        let obj = {}
        <?php 
           
            foreach ($data['products'] as $product) {
                
        ?>
        obj = {}
        <?php
                foreach ($product as $key => $value) {
        ?>
            obj["<?= $key?>"] = "<?= $value?>"
        <?php
                }
        ?>
            products.push(obj)
        <?php
            }
        ?>
        console.log(products)
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
    <script type="text/javascript" src="<?= ROOT?>/assets/js/admin_products.js"></script>
</body>