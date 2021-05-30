<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>
<?php
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<?php include 'header.php' ?>
<link rel="stylesheet" href="assets/styles/login.css">
<body class="hold-transition login-page bg-black">
<div class="login-logo custom-login-logo mb-4 pb-3">
    <a href="#" class="text-white text-uppercase"><b><?php echo $_SESSION['system']['name'] ?></b></a>
 </div>
<div class="login-box custom-login-box">
  <!-- /.login-logo -->
  <div class="card ">
    <div class="card-body login-card-body">
      <center class="text-white h4 login-text mb-3"> Login </center>
      <form action="" id="login-form">
        <div class="form-group mb-3">
          <input type="email" class="form-control custom-input" name="email" required placeholder="Email">
        </div>
        <div class="form-group mb-3">
          <input type="password" class="form-control custom-input" name="password" required placeholder="Password">
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn login-btn btn-block">Sign In</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
          end_load();
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>

</body>
</html>
