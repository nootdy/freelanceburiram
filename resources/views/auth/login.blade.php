<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>FreelanceBuriram | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Freelance</b>Buriram</a>
  </div>
  <!-- /.login-logo -->

  @if (session('status'))
  <div class="alert alert-success alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <strong>สำเร็จ!</strong> {{ session('status') }}
  </div>
  @endif

  @if (session('status1'))
  <div class="alert alert-warning alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <strong>พบข้อผิดพลาด!</strong> {{ session('status1') }}
  </div>
  @endif
  
  <div class="login-box-body">
    <p class="login-box-msg">ลงชื่อเพื่อเข้าสู่ระบบ</p>
    @foreach ($errors->all() as $error)
      <li class=" col-xs-12" style="background-color:#FFE4E1">{{ $error }}</li><br>
    @endforeach
    <form action="{{ route('login') }}" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="อีเมล">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="{{ route('forgot-password') }}">ลืมรหัสผ่าน ?</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าสู่ระบบ</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


    <br>
    ยังไม่ได้เป็นสมาชิก กรุณาลงทะเบียน <a href="{{route('freelanceregister')}}" class="text-center">ฟรีแลนซ์ <a/> |
    <a href="{{route('employerregister')}}" class="text-center">ผู้ว่าจ้าง <a/>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>

</body>
</html>
