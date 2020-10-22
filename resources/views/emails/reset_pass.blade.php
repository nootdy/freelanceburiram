<html>
<head>
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
   <script type="text/javascript" src="http://johannburkard.de/resources/Johann/jquery.highlight-5.js"></script>
</head>
<body>
  <!-- route sendmail -->
  <div class="container">
    <section class="content-header">
        <div class="row">
          @foreach($data as $dt)
          <div class="alert alert-warning">
            สวัสดีคุณ <strong> {{$dt->first_name}} {{$dt->last_name}}</strong>  มีการร้องขอให้รีเซ็ตรหัสผ่าน
            หากคุณไม่ได้เป็นผู้แจ้ง คุณสามารถลบอีเมลล์ฉบับนี้ได้ โดยรหัสผ่านจะไม่ถูกเปลี่ยนแปลง
            หากคุณเป็นผู้แจ้งผ่านหน้าเว็บไซต์ คุณสามารถทำการรีเซตรหัสผ่านใหม่ได้ ตามด้านล่าง

            <!-- <form action="{!!action('AuthController@getReset_PasswordPage')!!}" method="get">
              <div class="form-group has-feedback">
                <input type="hidden" name="id" value="{{$dt->id}}">
                <div class="text-center">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-success btn-block btn-flat">คลิกที่นี่</button>
                </div>
            </form> -->

            <!-- /.login-logo -->
            <div class="login-box-body">
              <p class="login-box-msg">รีเซ็ตรหัสผ่านใหม่</p>

              <form action="{!!action('AuthController@postReset_PasswordPage')!!}" method="post">
                <input type="hidden" name="id" value="{{$dt->id}}">

                <div class="form-group has-feedback">รหัสผ่านใหม่ :
                  <input type="password" name="password" class="form-control" >
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">รหัสผ่านใหม่อีกครั้ง :
                  <input type="password" name="password_confirmation" class="form-control">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                  <!-- /.col -->
                  <div class="text-center">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success btn-block btn-flat">บันทึกรหัสผ่านใหม่</button>
                  </div>
                  <!-- /.col -->
              </form>

              <br>
              หากบันทึกรหัสผ่านใหม่เรียบร้อยแล้ว ให้ลบอีเมลล์ฉบับนี้เพื่อความปลอดภัยของข้อมูล<br>
              ยังไม่ได้เป็นสมาชิก กรุณาลงทะเบียน <a href="{{route('freelanceregister')}}" class="text-center">ฟรีแลนซ์ <a/> |
              <a href="{{route('employerregister')}}" class="text-center">ผู้ว่าจ้าง <a/>

            </div>

          </div>
          @endforeach
        </div>
        <hr>
        <div class="row">
          ขอบคุณที่ใช้งาน เว็บจัดหางาน <b>ฟรีแลนซ์บุรีรัมย์</b> เรายินดีให้บริการคุณ
        </div>

    </section>
    </div>
  </body>
</html>
