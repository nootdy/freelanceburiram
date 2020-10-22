@include('header.header')
<!DOCTYPE html>
<html>
<head>

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
      <li>แก้ไขประกาศงาน</li>
    </ol>
  </section>
</div>
  <div class="register-logo"></div>

<!-- new postjob -->
<div class="container">
  <div class="page-header">
    <div class="panel-heading custom-header-panel">
      <h3 class="panel-title roboto"><i class="fa fa-file-text" aria-hidden="true"></i> แก้ไขประกาศงาน</h3>
    </div>
  </div>

    @foreach ($errors->all() as $error)
    <li class="col-md-offset-2 col-md-8" style="background-color:#FFE4E1">{{ $error }}</li><br>
    @endforeach

    @if (session('status'))
    <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>สำเร็จ!</strong> {{ session('status') }}
    </div>
    @endif

    @if (session('status2'))
    <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>พบข้อผิดพลาด!</strong> {{ session('status2') }}
    </div>
    @endif


    <div class="col-sm-12">
      <div class="col-padding">
        @foreach($title as $edit_tt)
        <form action="{!! action('PostJobController@update',$slug)!!}" id="candidatedata" class="form-horizontal" method="post">
          {{ csrf_field() }}
        <div class="form-group">
          <label for="">หัวข้อประกาศงาน (*)</label>
          <input type="text" class="form-control"
          id="" placeholder="" name="title" value="{{$edit_tt->title}}" /><br>
          <button name="title_edit" type="submit" class="btn btn-success pull-right">แก้ไขเฉพาะหัวข้อประกาศ</button>
        </div>

        @endforeach
        </form>
      </div>
      <br><hr>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>เลือก</th>
              <th>ตำแหน่ง</th>
              <!-- <th>ประเภทงาน</th> -->
              <th class="text-center">เริ่มงาน</th>
              <th class="text-center">สิ้นสุดงาน</th>
              <th class="text-center">จำนวนที่รับ</th>
              <th class="text-center">ค่าจ้างต่ำสุด</th>
              <th class="text-center">ค่าจ้างสูงสุด</th>
              <th class="text-center">รายละเอียดงาน</th>
              <!-- <th>จัดการ</th> -->
            </tr>
          </thead>
          <tbody>
            @foreach ($jobs as $edit_j)
            <form class="repeater" action="{!! action('PostJobController@update',$slug)!!}" id="candidatedata" class="form-horizontal" method="post">
              {{ csrf_field() }}
            <tr>
              <?php
              // $expire = strtotime($edit_j->end_date. ' + 2 days'); //บวกวันเพิ่มได้

              $expire = strtotime($edit_j->end_date);
              $today = strtotime("today midnight");
              ?>
              <!-- //ถ้างานมีคนสมัครหรือเลยวันนี้แล้ว จะไม่ให้แก้ไข -->
              @if($check == true)
              <td><input type="radio" disabled name="details_id[]" value="{!!$edit_j->id!!}" class="checkthis" />  <p style="color:red;">มีคนทำงานนี้อยู่</p></td>
              @elseif($today >= $expire)
              <td><input type="radio" disabled name="details_id[]" value="{!!$edit_j->id!!}" class="checkthis" />  <p style="color:red;">จบงานแล้ว</p></td>
              @else
              <td><input type="radio" name="details_id[]" value="{!!$edit_j->id!!}" class="checkthis" /></td>
              @endif
              <td class="text-center"><input type="text" class="form-control"  disabled id="" placeholder="" name="position" value="{{$edit_j->position}}" /></td>
              <!-- <td class="text-center"  width="5%">
                <select disabled class="form-control" name="job_category" id="select2" single="single"  style="width: 100%;">
                  @foreach($categories as $cate)
                  @if ($edit_j->job_category == $cate->id)
                  <option value="{{ $cate->name}}" echo 'selected="selected"'; ?>>{{ $cate->name }}</option>
                  @else
                  <option value="{{ $cate->name}}">{{ $cate->name }}</option>
                  @endif
                  @endforeach
                </select>
              </td> -->
              <td class="text-center">{{ $edit_j->start_date}}</td>
              <td class="text-center">{{ $edit_j->end_date}}</td>
              <td class="text-center">{{ $edit_j->amount}}</td>
              <td class="text-center">{{ $edit_j->min_pay}}</td>
              <td class="text-center">{{ $edit_j->max_pay}}</td>
              <td style="width:30%">{{ $edit_j->job_description}}</td>
              <!-- <td><button class="btn btn-primary" type="submit">แก้ไข</button></td> -->
            </tr>
          </tbody>
          @endforeach
        </table>

        <hr>
        <div class="col-md-12">
          <h4><i class="fa fa-exclamation-circle" aria-hidden="true"></i> กรุณาเลือกตำแหน่งงานที่ต้องการแก้ไข จากด้านบน ก่อนทำการบันทึก <small>(กรุณากรอกข้อมูลให้ครบทุกช่อง)</small> </h4>

          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">เริ่มงาน</label>
            <label for="inputName" class="col-sm-2 control-label">สิ้นสุดงาน</label>
            <label for="inputName" class="col-sm-1 control-label">รับ(กี่คน)</label>
            <label for="inputName" class="col-sm-2 control-label">ค่าจ้างต่ำสุด</label>
            <label for="inputName" class="col-sm-2 control-label">ค่าจ้างสูงสุด</label>
            <label for="inputName" class="col-sm-3 control-label">รายละเอียดงาน</label>
          </div>
          <div class="form-group">
            <input type="text"  required="required" class="col-sm-2"  name="start_date" placeholder="เช่น {{ $edit_j->start_date}} (ป/ด/ว)" >
            <input type="text"  required="required" class="col-sm-2"  name="end_date" placeholder="เช่น {{ $edit_j->end_date}} (ป/ด/ว)" >
            <input type="text"  class="col-sm-1"  name="amount" value="" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"     maxlength="10" pattern="[0-9]" title="จำนวนต้องเป็นตัวเลข" required>
            <input type="text"  class="col-sm-2"  name="min_pay" value="" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"     maxlength="10" pattern="[0-9]{10,9,8,7,6,5,4,3,2,1}" title="ค่าจ้างต้องเป็นตัวเลข" required>
            <input type="text"  class="col-sm-2"  name="max_pay" value="" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"     maxlength="10" pattern="[0-9]{10,9,8,7,6,5,4,3,2,1}" title="ค่าจ้างต้องเป็นตัวเลข" required>
            <textarea class="col-sm-3" required="required" name="job_description" rows="3" cols="4" id="" placeholder="" ></textarea>
          </div>
          <br>
          <p class="pull-right">** ถ้าตำแหน่งใดมีคนเริ่มทำงานแล้ว หรือ วันสิ้นสุดจ้างงานได้จบลงแล้ว จะทำการแก้ไขไม่ได้</p>

        </div>


        <div class="col-md-12">
          <br>
          <div class="pull-left">
               <a href="{!!action('PostJobController@show',$slug)!!}"><input type="button" class="btn btn-warning" name="" value=" < ย้อนกลับ"></a>
          </div>
          <?php
          $expire = strtotime($edit_j->end_date. ' + 2 days');
          $today = strtotime("today midnight");
          ?>
          <!-- //ถ้างานมีคนสมัครหรือเลยวันนี้แล้ว จะไม่ให้แก้ไข -->
          @if($check == true)
          <button type="submit"  disabled name="details_edit" class="btn btn-success pull-right">แก้ไขข้อมูลตำแหน่งงาน</button>
          @elseif($today >= $expire)
          <button type="submit"   disabled  name="details_edit" class="btn btn-success pull-right">แก้ไขข้อมูลตำแหน่งงาน</button>
          @else
          <button type="submit"  name="details_edit" class="btn btn-success pull-right">แก้ไขข้อมูลตำแหน่งงาน</button>
          @endif
        </div>
      </div>
    </form>
  </div>
</div>


<!-- multi insert -->
  <script src="../plugins/jquery.repeater-master/jquery.repeater.min.js"></script>


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

  <script type="text/javascript">
  $(document).ready(function(){
    $("#mytable #checkall").click(function () {
      if ($("#mytable #checkall").is(':checked')) {
        $("#mytable input[type=checkbox]").each(function () {
          $(this).prop("checked", true);
        });

      } else {
        $("#mytable input[type=checkbox]").each(function () {
          $(this).prop("checked", false);
        });
      }
    });

    $("[data-toggle=tooltip]").tooltip();
  });

  </script>





</div>

<br><br><br>
</body>
</html>

@include('footer.footer')
