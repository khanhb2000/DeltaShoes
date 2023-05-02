<?php require APPROOT.'/views/header.php'; ?>
  <main class="container">
    <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
          <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
        </ol>
    </nav>
    <div class="home">
      <h1 class="page-title">Đăng nhập tài khoản</h1>
        <form class="form" method="POST" action="" style="max-width: 500px; margin: auto">
            <?php  
              if (isset($data['error'])) {?>
                <div class="alert alert-danger" style="max-width: 500px; margin: auto" role="alert">
                    <?=$data['error']?>
                </div>
            <?php }?>
              <div class="mb-4">
                  <label for="email" class="mb-4">Email</label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email.." required>
              </div>
              <div class="mb-4">
                <label for="password" class="mb-4">Mật khẩu</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu.." required>
              </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mb-2" value="Đăng nhập">Đăng nhập</button>
            </div> 
            
        </form>
        <div class="container text-center">
          <br>
          Chưa có tài khoản? Hãy <a href="<?=ROOT?>/home/signup">Đăng kí</a> 
        </div>

    </div>
    
    </main>
    <?php require_once APPROOT.'/views/footer.php'; ?>
  </body>
</html>