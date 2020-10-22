@include('header.header')
<!DOCTYPE html>
<html>
<head>
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">

  <style>
  hr {
    border: 0;
    width: 100%;
    color: #f00;
    background-color: grey;
    height: 5px;
  }
  /* custom background header panel */
  .custom-header-panel{
    background-color: #7f7f7f !important;
    border-color:  !important;
    color: white;
  }

  .no-margin-form-group {
    margin: 0 !important;
  }
  .requerido {
    color: red;
  }
  .btn-orange-md {
    background: #FF791F !important;
    border-bottom: 3px solid #ae4d13 !important;
    color: white;
  }

  .btn-orange-md:hover {
    background: #d86016 !important;
    color: white !important;
  }
  </style>
</head>
<body>
<div class="container">
  <section class="content-header">
    <h1>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
      <li>สร้างประกาศงาน</li>
    </ol>
  </section>
  <div class="register-logo"></div>

<!-- new postjob -->
  <div class="container">
    <div class="page-header">
      <div class="panel-heading custom-header-panel">
        <h3 class="panel-title roboto"><i class="fa fa-file-text" aria-hidden="true"></i> สร้างประกาศงานใหม่</h3>
      </div>
    </div>


    <!-- check if old job is close -->
    @if($check == 5)
    <h3 class="text-center">** คุณมีประกาศงานที่ยังเปิดอยู่ 5 งานแล้ว ** <br>
      กรุณาปิดโปรเจคงานเก่าที่เสร็จสิ้นการจ้างงานแล้ว ก่อนทำการประกาศงานใหม่
      <span  class="label label-danger"><a href="{!!action('AuthController@getAccountPage_Hire',$user)!!}">คลิกที่นี่ >> รายชื่อประกาศงาน</a></span>
    </h3>
    @elseif(count($limit_user) >= 3)
    <h3 class="text-center">** คุณมีงานที่ยังดำเนินอยู่ {{count($limit_user)}} งานแล้ว ** <br>
      กรุณาทำการรีวิวผู้ร่วมงาน เพื่อยืนยันว่าเสร็จสิ้นการจ้างงานแล้ว ก่อนทำการประกาศงานใหม่
      <span  class="label label-danger"><a href="{!!action('AuthController@getAccountPage_Co',$user)!!}">คลิกที่นี่ >> รายชื่อผู้ร่วมงาน</a></span>
    </h3>
    @else
    <!-- check if old job is close -->


    <form class="repeater" action="{!! action('PostJobController@store')!!}" id="candidatedata" class="form-horizontal" method="post">
      {{ csrf_field() }}

      @foreach ($errors->all() as $error)
      <li class="col-md-offset-2 col-md-8" style="background-color:#FFE4E1">{{ $error }}</li><br>
      @endforeach
      @if (session('status'))
      <li class="col-md-offset-2 col-md-8" style="background-color:#33ffbb">คุณได้ทำการประกาศงานเรียบร้อยแล้ว หมายเลขประกาศ : {{ session('status') }} <a href="/jobsboard/{{ session('status') }}">คลิกเพื่อดู</a> </li><br>
      @endif

      <div class="col-sm-12">
        <div class="col-padding">
          <div class="form-group">
            <label for="">หัวข้อประกาศงาน (*)</label>
            <input type="text" class="form-control"
            id="" placeholder="" name="title" required="required"/>
          </div>
        </div>
        <hr>

        <!-- //start well -->
        <div class="well well-lg">
          <div data-repeater-list="pos">
            <div data-repeater-item>
              <button data-repeater-delete class="btn btn-danger pull-right" type="button">ลบตำแหน่งงานนี้</button>


              <!-- //Form input position -->
              <label for="">ตำแหน่งงาน <small style="color:red;">(กรุณากรอกข้อมูลให้ครบทุกช่อง)</small></label>
              <input type="text" class="form-control" required="required"
              id="" placeholder="" name="position" />

              <div class="col-xs-6">
                <label>ประเภทงาน</label>
                <select class="form-control" name="job_category" id="select2" single="single"  required="required" style="width: 100%;">
                  <option value="">กรุณาเลือกประเภทงาน</option>
                  @foreach($categories as $ctg)
                  <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-xs-2">
                <label for="">จำนวนที่รับ (คน)</label>
                <input id="spinner"  class="form-control" id="value" name="amount" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"     maxlength="10" pattern="[0-9]" title="จำนวนต้องเป็นตัวเลข" required>
              </div>

              <div class="col-xs-2">
                <label for="">เรทค่าจ้าง (ต่ำสุด)</label>
                <input type="text" class="form-control" id="min" placeholder="เรทต่ำสุด" name="min_pay"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"     maxlength="10" pattern="[0-9]{10,9,8,7,6,5,4,3,2,1}" title="ค่าจ้างต้องเป็นตัวเลข" required>
              </div>
              <div class="col-xs-2">
                <label for="">เรทค่าจ้าง (สูงสุด)</label>
                <input type="text" class="form-control" id="max" placeholder="เรทสูงสุด" name="max_pay"  onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"     maxlength="10" pattern="[0-9]{10,9,8,7,6,5,4,3,2,1}" title="ค่าจ้างต้องเป็นตัวเลข" required>
              </div>
              <div class="col-xs-6">
                <!-- Date range -->
                  <div class="form-group ">
                    <label>ระยะเวลาการจ้างงาน (เริ่มต้น)</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="start_date" placeholder="เช่น 2017-11-20 (ปี/เดือน/วัน)"class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required="required">
                    </div>

                  </div>
                </div>

                <div class="col-xs-6">
                  <!-- Date range -->
                  <div class="form-group ">
                    <label>(สิ้นสุด)</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="end_date" placeholder="เช่น 2017-11-20 (ปี/เดือน/วัน)"class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required="required">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>


              <div class="col-xs-12">
                <label for="">รายละเอียดงาน</label>
                <textarea class="form-control " name="job_description" rows="5" cols="15"
                id="" placeholder="" required="required"></textarea>
              </div>
              <hr>
            </div>
          </div>
        </div>
        <!-- //end well -->

      </div>
    </hr>
    <input data-repeater-create type="button"  class="btn btn-success pull-left" value="เพิ่มตำแหน่งงาน">
    <div class="form-group">
      <button class="btn btn-primary pull-right" type="submit">สร้างประกาศงาน</button>
    </div>    <br><br><br>
  </form>
  @endif
</div>
</div>

<!-- multi insert -->
<script src="../plugins/jquery.repeater-master/jquery.repeater.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script>
$(function () {
  //Initialize Select2 Elements
  $(".select2").select2();

  //Datemask dd/mm/yyyy
  $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
  //Money Euro
  $("[data-mask]").inputmask();
});
</script>

<!-- repeater -->
<script type="text/javascript">
$(document).ready(function () {
  $('.repeater').repeater({
    show: function () {
      $(this).slideDown();
    },
    hide: function (deleteElement) {
      if(confirm('คุณต้องการลบตำแหน่งงานนี้ ใช่หรือไม่')) {
        $(this).slideUp(deleteElement);
      }
    },
  })
});
</script>
<!-- repeater -->

</div>

<br><br><br>
</body>
</html>

@include('footer.footer')
