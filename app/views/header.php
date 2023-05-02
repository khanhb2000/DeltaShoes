<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delta shoes</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/styleAboutContact.css"> 
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/header.css">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/main.css">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/admin.css">
    <link rel="stylesheet" href="<?= ROOT?>/assets/css/user.css">
    
</head>
<body>
    <header>
        <div>
            <div class="header-banner d-none d-sm-none d-lg-block">
                <img src="<?= ROOT?>/assets/img/banner.jpg">
            </div>
            <div class="header-search container-lg">
              <div class="row justify-content-center align-items-center" style="height: 100%">
                <div class="col-1 d-sm-none">
                  <button
                        class="navbar-toggler"
                        type="button"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#navbarNavAltMarkup"
                        aria-controls="navbarNavAltMarkup"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                      >
                      <i class="fas fa-bars"></i>
                  </button>
                </div>
                
                  <div class="col-6 col-sm-4 d-flex justify-content-center align-items-center">
                      <img src="<?= ROOT?>/assets/img/logo.jpg" alt="This is logo images" style="height: 60px; width: auto">
                  </div>
                  <div class="col-4 d-none d-sm-block"> 
                    <div class="input-field" style="position: relative"> 
                        <input placeholder="Tìm kiếm" class="form-control form-control-search custom-search" id="search-product"/> 
                        <a href = "" id="search-link">
                          <button class="btn btn-primary btn-custom-search"><i class="fa fa-search"></i></button> 
                        </a>
                    </div>
                  </div> 
                  <div class="col-5 col-sm-4 d-flex justify-content-center"> 
                    <?php if (empty($_SESSION["user"]) && (empty($_SESSION["admin"]))) {?>
                      <a href = "<?=ROOT?>/home/login" class ="me-2">
                    <?php } else if (!empty($_SESSION["user"])) {?>
                      <a href = "<?=ROOT?>/user" class ="me-2">
                    <?php } else {?>
                      <a href = "<?=ROOT?>/admin" class ="me-2">
                    <?php } ?>
                        <div class="input-field"> 
                            <button class="btn btn-primary btn-floating">
                              <i class="fa-solid fa-user"></i>
                            </button> 
                        </div>
                      </a>
                      <?php if (empty($_SESSION["admin"])) {?>
                        <a href = "<?=ROOT?>/home/cart">
                          <div class="input-field"> 
                              <button class="btn btn-primary btn-floating"><i class="fa fa-shopping-cart"></i></button>
                          </div> 
                        </a>
                      <?php }?>
                        
                  </div>
              </div>

            </div>
                
            <div class="header-menu bg-primary">
              <nav class="navbar navbar-expand-sm" style="box-shadow: none; display: contents">
                <div class="container-fluid">
                  
                  <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup" style="min-height: 60px">
                    <div class="navbar-nav">
                      <a class="nav-link" aria-current="page" href="<?=ROOT?>/home/index">Trang chủ</a>
                      <a class="nav-link" href="<?=ROOT?>/home/products" type="button">Sản phẩm</a>
                      <a class="nav-link" href="<?=ROOT?>/home/contact">Liên hệ</a>
                      <a class="nav-link" href="<?=ROOT?>/home/about">Giới thiệu</a>
                      <a class="nav-link" href="<?=ROOT?>/home/news">Tin tức</a>
                    </div>
                  </div>
                </div>
              </nav>  
            </div>
        </div>
    </header>
    