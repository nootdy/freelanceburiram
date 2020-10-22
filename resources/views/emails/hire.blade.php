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
          @foreach($title as $tt)
          @endforeach
          <h3>ผู้ว่าจ้าง : <a href="{!!action('AuthController@show',$tt->user_id)!!}">{{$company}}</a> สนใจจ้างคุณ</h3>
          <p>เข้าดูประกาศงานต่าง ๆ ของผู้ว่าจ้าง เพื่อทำการสมัครงานได้</p>
          @foreach($title as $tt)
          <li><a href="{!!action('PostJobController@show',$tt->slug)!!}">{{$tt->title}}</a></li>
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
