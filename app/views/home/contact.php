<?php require APPROOT.'/views/header.php'; ?>
  <main class="container-md">
  <nav aria-label="breadcrumb" class="mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=ROOT?>/home">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trang liên hệ</li>
        </ol>
    </nav>
    <?php
    // $email= $_POST['email'];
    // $name= $_POST['user'];  
    // $content= $_POST['content'];  
    if(isset($_POST['submit'])) {
      // Check if name has been entered
      if(empty($_POST['user'])) {
        echo "Nhập họ tên";
      }
      // Check if email has been entered and is valid
      else if(empty($_POST['email'])) {
        echo "Nhập Email";
      }
      else if(empty($_POST['content'])) {
        echo "Nhập nội dung";
      }
      else {
        echo "Thông tin đã được gửi";
      }
    }
  ?>
    <h2 class="page-title">Liên hệ</h2>
    <div class="container">
        <div class="col-12 p-0">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6997359.999667005!2d-104.57154466142867!3d31.09083573536726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864070360b823249%3A0x16eb1c8f1808de3c!2sTexas%2C+USA!5e0!3m2!1sen!2sin!4v1561013294283!5m2!1sen!2sin" frameborder="0" style="border:1" allowfullscreen></iframe>
        </div>
        <div class="col-12 p-0">
          <h4 style="color:red;">Thông tin liên hệ</h4>
          <p>Để liên hệ và nhận các thông tin khuyến mại sớm nhất, xin vui lòng điền đầy đủ thông tin của bạn vào form dưới đây. Chúng tôi sẽ liên lạc lại với bạn trong thời gian sớm nhất</p>
        <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="form-group row">
        <label for="inputUser" class="col-sm-2 col-form-label">Họ tên:</label>
        <div class="col-sm-10">
          <input type="User" class="form-control" id="inputUser" name="user" placeholder="Họ tên">
          <!-- <?php echo $errUser; ?> -->
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email: </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email">
          <!-- <?php echo $errEmail; ?> -->
        </div>
      </div>
      <div class="form-group row">
        <label for="inputcontent" class="col-sm-2 col-form-label">Nội dung:</label>
        <div class="col-sm-10">
          <input type="Content" class="form-control" id="inputContent" name="content" placeholder="Nội dung">
          <!-- <?php echo $errContent; ?> -->
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="Gửi thông tin" name="submit" class="btn btn-danger"/>
        </div>
      </div>
    </form>
        </div>
    </div>
  </main>
    
  </body>
</html>

