
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">

  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">


  <script type="text/javascript" src="//code.jquery.com/jquery-compat-git.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/css/result-light.css">
      <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

      <script>
      function preview_images()
      {
       var total_file=document.getElementById("images").files.length;
       for(var i=0;i<total_file;i++)
       {
        $('#image_preview').append("<div class='col-md-12'><img class='img' width='300' height='300' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
       }
      }
      </script>

  <style type="text/css">

 body {
    margin-top:30px;
}
.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
.center {
    margin: auto;
    width: 40%;
    padding: 10px;
}
/*profile image input*/
.image-preview-input {
    position: relative;
	overflow: hidden;
	margin: 0px;
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.image-preview-input input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
  </style>

  <title>FreelanceBuriram</title>







<script type='text/javascript'>//<![CDATA[
$(window).on('load', function() {
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='email'],input[type='password']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-success').trigger('click');
});
});//]]>

</script>


</head>

<body>
  <div class="register-logo">
    <a href="/"><b>Freelance</b>Buriram</a>
  </div>

  <div class="box-header with-border center" style="background-color:#898E8C">
    <center><h3 class="box-title"><p style="color:white;">ลงทะเบียนผู้ว่าจ้าง</p></h3></center>
  </div>
<br>
<div class="center container">
  @foreach ($errors->all() as $error)
  <li class=" col-xs-12" style="background-color:#FFE4E1">{{ $error }}</li><br>
  @endforeach

  <div class="stepwizard">
      <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step col-xs-3">
              <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
              <p><small>สร้างบัญชี</small></p>
          </div>
          <div class="stepwizard-step col-xs-3">
              <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
              <p><small>ข้อมูลส่วนตัว</small></p>
          </div>
          <div class="stepwizard-step col-xs-3">
              <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
              <p><small>ข้อมูลบริษัท/สปก.</small></p>
          </div>
          <div class="stepwizard-step col-xs-3">
              <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
              <p><small>รูปโลโก้บริษัท</small></p>
          </div>
      </div>
  </div>

  <form role="form" action="{{ route('employerregister') }}" method="post" enctype="multipart/form-data">
      <div class="panel panel-primary setup-content" id="step-1">
          <div class="panel-heading">
               <h3 class="panel-title">สร้างบัญชี</h3>
          </div>
          <div class="panel-body">
              <div class="form-group">
                  <label class="control-label">อีเมล</label>
                  <input  type="email" name="email"  required="required" class="form-control" id="email" placeholder="อีเมลที่ใช้เข้าสู่ระบบ (ตัวอย่าง : example@mail.com)"  />
              </div>
              <div class="form-group">
                  <label class="control-label">รหัสผ่าน</label>
                  <input  type="password"  name="password" required="required" class="form-control" id="password" placeholder="รหัสผ่าน"  />
              </div>
              <div class="form-group">
                  <label class="control-label">รหัสผ่านอีกครั้ง</label>
                  <input type="password" required="required" name="password_confirmation" class="form-control" placeholder="รหัสผ่านอีกคร้้ง" />
              </div>

              <button class="btn btn-primary nextBtn pull-right" type="button">ต่อไป</button>
          </div>
      </div>

      <div class="panel panel-primary setup-content" id="step-2">
          <div class="panel-heading">
               <h3 class="panel-title">ข้อมูลส่วนตัว</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
                <label class="control-label">ชื่อ</label>
                <input maxlength="100" type="text" required="required" name="first_name" class="form-control" placeholder="ชื่อ" />
            </div>
            <div class="form-group">
                <label class="control-label">นามสกุล</label>
                <input maxlength="100" type="text" required="required" name="last_name" class="form-control" placeholder="นามสกุล" />
            </div>
            <div class="form-group">
                <label class="control-label">เลขประจำตัวประชาชน</label>
                <input  type="text" required="required" name="e_pid" class="form-control" placeholder="เลขประจำตัวประชาชน" />
            </div>
            <div class="form-group">
                <label class="control-label">เพศ</label>
                <select class="form-control" id="e_gender" name="e_gender" required>
                    <option value="M" checked="checked">ชาย</option>
                    <option value="F">หญิง</option>
                  </select>
                <!-- <input maxlength="200" type="text" required="required" name="gender" class="form-control" placeholder="เพศ" /> -->
            </div>
              <div class="form-group">
                  <label class="control-label">เบอร์โทร</label>
                  <input type="text" required="required" name="e_tel" class="form-control" placeholder="เบอร์โทร" />
              </div>
              <button class="btn btn-primary nextBtn pull-right" type="button">ต่อไป</button>
          </div>
      </div>

      <div class="panel panel-primary setup-content" id="step-3">
          <div class="panel-heading">
               <h3 class="panel-title">ข้อมูลบริษัท/สถานประกอบการ</h3>
          </div>
          <div class="panel-body">
              <div class="form-group">
                  <label class="control-label">ชื่อบริษัท/สถานประกอบการ</label>
                  <input type="text" required="required" name="e_comp_name" class="form-control" placeholder="" />
              </div>
              <div class="form-group">
                  <label class="control-label">ที่อยู่</label>
                  <textarea type="text" required="required" name="e_comp_address" class="form-control" placeholder="่" ></textarea>
              </div>
              <div class="form-group">
                  <label class="control-label">เบอร์โทรบริษัท/สถานประกอบการ</label>
                  <input type="text" required="required" name="e_comp_tel" class="form-control" placeholder="เบอร์โทรบริษัท/สถานประกอบการ" />
              </div>

              <button class="btn btn-primary nextBtn pull-right" type="button">ต่อไป</button>
          </div>
      </div>

      <div class="panel panel-primary setup-content" id="step-4">
          <div class="panel-heading">
               <h3 class="panel-title">รูปโลโก้บริษัท</h3>
          </div>
          <div class="panel-body">
              <div class="form-group">
                  <label class="control-label">เลือกรูปโปรไฟล์</label>

                  <!-- <input maxlength="200" type="text" required="required" name="ref_pic_path" class="form-control" placeholder="รูป" /> -->
                  <div class="input-group image-preview">
                    <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                    <span class="input-group-btn">
                      <!-- image-preview-clear button -->
                      <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                      </button>
                      <!-- image-preview-input -->
                      <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">เลือก</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar"/> <!-- rename it -->
                      </div>
                    </span>
                  </div><!-- /input-group image-preview [TO HERE]-->
              </div>


              <div class="form-group">
                <label class="control-label">ยืนยันตัวตน</label>
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
                <div class="col-md-8">
                  <input type="file" class="form-control" id="images" name="images[]" onchange="preview_images();" multiple/>
                </div>
                <div class="col-md-4">
                  <input class="btn btn-danger" type="reset" value="ยกเลิก"/>
                </div>
                <br>
                <div class="row" id="image_preview"></div>
                <br>
              </div>

              {{ csrf_field() }}
              <button class="btn btn-success pull-right" type="submit">ลงทะเบียน</button>
          </div>
      </div>
  </form>
</div>

  <script>
  // tell the embed parent frame the height of the content
  if (window.parent && window.parent.parent){
    window.parent.parent.postMessage(["resultsFrame", {
      height: document.body.getBoundingClientRect().height,
      slug: "59e5e1ya"
    }], "*")
  }
</script>
<script>
function myFunction() {
    var x = document.getElementById("email").required;
    var y = document.getElementById("password").required;

}
</script>

<script>
  //profile image input
  $(document).on('click', '#close-preview', function(){
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        },
         function () {
           $('.image-preview').popover('hide');
        }
    );
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>รูป</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').text("ลบ").click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("เลือก");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function (){
        var img = $('<img/>', {
            id: 'dynamic',
            width:150,
            height:150
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("เปลี่ยน");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
});
</script>



</body>

</html>
