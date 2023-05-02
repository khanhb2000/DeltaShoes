<?php require APPROOT.'/views/header.php'; ?>
    <main class="container">
        <nav aria-label="breadcrumb" class="mt-4">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
            </ol>
        </nav>
        <h1 class="page-title">Kết quả tìm kiếm</h1>
        <div class = "row" id = "product-list">

        </div>

        <nav>
            <ul class="pagination justify-content-end" id="pagination">
                          
            </ul>
        </nav>
    </main>
<?php require APPROOT.'/views/footer.php'; ?>
<script>
    product_items=<?php echo json_encode($data); ?>;
    var root = "<?= ROOT?>"
</script>
<script type="text/javascript" src="<?= ROOT?>/assets/js/home_products.js"></script>
<?php 
