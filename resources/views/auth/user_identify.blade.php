@include('header.header')

<title>Freelance Buriram | Acccount )</title>
<head>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://www.expertphp.in/js/jquery.form.js"></script>
  <script>
  function preview_images()
  {
   var total_file=document.getElementById("images").files.length;
   for(var i=0;i<total_file;i++)
   {
    $('#image_preview').append("<div class='col-md-3'><img class='img' width='300' height='300' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
   }
  }
  </script>
</head>


<style>

</style>
<body>
  <div class="container">
    <section class="content-header">
      <h1>
        อัพโหลดไฟล์ <small>(เพื่อยืนยันตัวตน)</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active"><a href="{!!action('AuthController@getAccountPage',Auth::user()->id)!!}">โปรไฟล์</a></li>
      </ol>
    </section>



    <!--เก่า แสดงรูปไม่ได้ -->
    <!-- <section class="content">
          <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{!!action('AuthController@user_identify')!!}">
            <div class="well well">
              <div class="row">
                <input required type="file" class="form-control" name="images[]" placeholder="identify" multiple>
              </div>
            </div>
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <button type="submit" class="btn btn-success pull-right" name="save">บันทึก</button>
          </form>
    </section> -->
    <!-- เก่า แสดงรูปไม่ได้ -->
    <br>
    @if(Auth::check())
    @if (Auth::user()->isFreelance())
    <div class="callout callout">
      <h4>สิ่งที่ต้องอัพโหลด</h4>
      <ul class="list-unstyled">
        <li><b>สำเนาบัตรประจำตัวประชาชน</b></li>
          <ul>
            <li>รับรองสำเนาบัตร พร้อมลงวันที่และลายเซ็นให้เรียบร้อย</li>
          </ul>
        </li>
      </ul>
    </div>
    @endif
    @endif

    @if(Auth::check())
    @if (Auth::user()->isEmployer())
    <div class="callout callout">
      <h4>สิ่งที่ต้องอัพโหลด</h4>
      <ul class="list-unstyled">
        <li><b>สำเนาบัตรประจำตัวประชาชน</b></li>
          <ul>
            <li>รับรองสำเนาบัตร พร้อมลงวันที่และลายเซ็นให้เรียบร้อย</li>
          </ul>
        </li>
        <li><b>ใบรับรองการประกอบกิจการ (ถ้ามี)</b></li>
          <ul>
            <li>ที่มีหมายเลขผู้เสียภาษี หรือ เลขทะเบียนพาณิชย์</li>
      </ul>
    </div>
    @endif
    @endif


    <section class="content text-center">
      <div class="row">
        <form class="form-horizontal" action="{!!action('AuthController@user_identify')!!}" method="post" enctype="multipart/form-data">
          <div class="col-md-8">
            <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple/>
          </div>
          <div class="col-md-4">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <input type="submit" class="btn btn-primary" name="save" value="อัพโหลด"/>
            <input type="reset" class="btn btn-danger"  onclick="myFunction()" value="ยกเลิก"/>
            <script>
            function myFunction() {
              location.reload();
            }
          </script>
          </div>
        </form>
      </div>
      <br>
      <div class="row" id="image_preview"></div>
      <br>
    </section>
  </div>


  <script type="text/javascript">

  </script>

</body>
    @include('footer.footer')
