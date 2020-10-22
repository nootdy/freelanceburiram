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
          @foreach($info as $inf)
          <div class="alert alert-warning">
            <strong>พบข้อผิดพลาด!</strong> ข้อมูลที่คุณ <b>{{$inf->first_name}} {{$inf->last_name}}</b> อัพโหลดไม่ถูกต้องหรือไม่ครบถ้วน
            กรุณาอัพโหลดอีกครั้ง <a href="{!!action('MainController@getEditAccountPage',$inf->id)!!}">คลิกที่นี่</a>
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
