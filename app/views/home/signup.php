<?php require APPROOT.'/views/header.php'; ?>
  <main class="container">
      <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Đăng kí</li>
        </ol>
      </nav>
      <div class="home">
        <h1 class="page-title">Tạo tài khoản mới</h1>
        <form class="form" action="" method="POST" style="max-width: 800px; margin: auto">
          <div class="row">
              <div class="col-6 mb-4">
                  <label for="name" class="mb-4">Tên</label>
                  <input type="name" id="fullname" name="fullname" class="form-control" placeholder="Nhập tên của bạn.." />
              </div>
              <div class="col-6 mb-4">
                <label for="email" class="mb-4">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email.." required>
              </div>                  
                  <?php  
                    if (isset($data['email_exist'])) {?>
                      <div class="alert alert-danger" role="alert">
                          <?=$data['email_exist']?>
                      </div>
                  <?php } ?>
              <div class="col-6 mb-4">
                  <label for="password" class="mb-4">Mật khẩu</label>
                  <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu.."  minlength="6" required>
              </div>
              <div class="col-6 mb-4">
                  <label for="phone" class="mb-4">Điện thoại</label>
                  <input type="tel" pattern="[0-9]{10}" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại.." required>
              </div>
              <div class="col-12 mb-4">
                  <label for="address">Địa chỉ</label>
                  <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ.." required>
              </div>    
              <div class="text-center">
                <button type="submit" class="btn btn-primary mb-2" value="Đăng kí">Đăng kí</button>
              </div> 
          </div>
        </form>
      </div>
      
        
        <div class="container text-center">
          <span><br>Đã có tài khoản? Hãy <a href="<?=ROOT?>/home/login">Đăng nhập</a></span>
          <h6>hoặc Đăng nhập bằng</h6>
        </div>
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
  </body>
</html>