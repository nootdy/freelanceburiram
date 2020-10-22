@include('header.header')
<!DOCTYPE html>
<html>
<head>

<style>
a.list-group-item {
    height:auto;
    min-height:220px;
}
a.list-group-item.active small {
    color:#fff;
}
.stars {
    margin:20px auto 1px;
}

body{
 padding-bottom:80px
}
.well {
    background: rgb(204,204,204);
}

.btn-select {
    position: relative;
    padding: 0;
    min-width: 236px;
    width: 100%;
    border-radius: 0;
    margin-bottom: 20px;
}

.btn-select .btn-select-value {
    padding: 6px 12px;
    display: block;
    position: absolute;
    left: 0;
    right: 34px;
    text-align: left;
    text-overflow: ellipsis;
    overflow: hidden;
    border-top: none !important;
    border-bottom: none !important;
    border-left: none !important;
}

.btn-select .btn-select-arrow {
    float: right;
    line-height: 20px;
    padding: 6px 10px;
    top: 0;
}

.btn-select ul {
    display: none;
    background-color: white;
    color: black;
    clear: both;
    list-style: none;
    padding: 0;
    margin: 0;
    border-top: none !important;
    position: absolute;
    left: -1px;
    right: -1px;
    top: 33px;
    z-index: 999;
}

.btn-select ul li {
    padding: 3px 6px;
    text-align: left;
}

.btn-select ul li:hover {
    background-color: #f4f4f4;
}

.btn-select ul li.selected {
    color: white;
}

/* Default Start */
.btn-select.btn-default:hover, .btn-select.btn-default:active, .btn-select.btn-default.active {
    border-color: #ccc;
}

.btn-select.btn-default ul li.selected {
    background-color: #ccc;
}

.btn-select.btn-default ul, .btn-select.btn-default .btn-select-value {
    background-color: white;
    border: #ccc 1px solid;
}

.btn-select.btn-default:hover, .btn-select.btn-default.active {
    background-color: #e6e6e6;
}
/* Default End */

/* Primary Start */
.btn-select.btn-primary:hover, .btn-select.btn-primary:active, .btn-select.btn-primary.active {
    border-color: #286090;
}

.btn-select.btn-primary ul li.selected {
    background-color: #2e6da4;
    color: white;
}

.btn-select.btn-primary ul {
    border: #2e6da4 1px solid;
}

.btn-select.btn-primary .btn-select-value {
    background-color: #428bca;
    border: #2e6da4 1px solid;
}

.btn-select.btn-primary:hover, .btn-select.btn-primary.active {
    background-color: #286090;
}
/* Primary End */

/* Success Start */
.btn-select.btn-success:hover, .btn-select.btn-success:active, .btn-select.btn-success.active {
    border-color: #4cae4c;
}

.btn-select.btn-success ul li.selected {
    background-color: #4cae4c;
    color: white;
}

.btn-select.btn-success ul {
    border: #4cae4c 1px solid;
}

.btn-select.btn-success .btn-select-value {
    background-color: #5cb85c;
    border: #4cae4c 1px solid;
}

.btn-select.btn-success:hover, .btn-select.btn-success.active {
    background-color: #449d44;
}
/* Success End */

/* info Start */
.btn-select.btn-info:hover, .btn-select.btn-info:active, .btn-select.btn-info.active {
    border-color: #46b8da;
}

.btn-select.btn-info ul li.selected {
    background-color: #46b8da;
    color: white;
}

.btn-select.btn-info ul {
    border: #46b8da 1px solid;
}

.btn-select.btn-info .btn-select-value {
    background-color: #5bc0de;
    border: #46b8da 1px solid;
}

.btn-select.btn-info:hover, .btn-select.btn-info.active {
    background-color: #269abc;
}
/* info End */

/* warning Start */
.btn-select.btn-warning:hover, .btn-select.btn-warning:active, .btn-select.btn-warning.active {
    border-color: #eea236;
}

.btn-select.btn-warning ul li.selected {
    background-color: #eea236;
    color: white;
}

.btn-select.btn-warning ul {
    border: #eea236 1px solid;
}

.btn-select.btn-warning .btn-select-value {
    background-color: #f0ad4e;
    border: #eea236 1px solid;
}

.btn-select.btn-warning:hover, .btn-select.btn-warning.active {
    background-color: #d58512;
}
/* warning End */

/* danger Start */
.btn-select.btn-danger:hover, .btn-select.btn-danger:active, .btn-select.btn-danger.active {
    border-color: #d43f3a;
}

.btn-select.btn-danger ul li.selected {
    background-color: #d43f3a;
    color: white;
}

.btn-select.btn-danger ul {
    border: #d43f3a 1px solid;
}

.btn-select.btn-danger .btn-select-value {
    background-color: #d9534f;
    border: #d43f3a 1px solid;
}

.btn-select.btn-danger:hover, .btn-select.btn-danger.active {
    background-color: #c9302c;
}
/* danger End */

.btn-select.btn-select-light .btn-select-value {
    background-color: white;
    color: black;
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
        <li>บอร์ดประกาศงาน</li>
      </ol>
    </section>
    <br>
    <hr>
    <section class="content-body">
      <h4>
        <i class="fa fa-file-text" aria-hidden="true"></i> บอร์ดประกาศงาน (พบทั้งหมด <b><?php echo $a ?></b>  ประกาศ)
        <div class="pull-right">
          <form action="{!!route('search')!!}" method="get">
            {!!csrf_field()!!}
            <div class="input-group" style="width: 300px;">
              <input name="search" value="{{ $oldsearch }}" type="text" class="form-control" placeholder="กำลังมองหา...">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
              <!-- <span class="input-group-btn">
                <button class="btn btn-default" type="submit">ค้นหา</button>
              </span> -->
            </div><!-- /input-group -->
          </form>
        </div>
      </h4>
    </section>

    <br>
    <section class="content-body">
      <div class="row">
        <div class="col-xs-12">
        <table class="table table-hover table-striped">
                           <tbody>
                             <tr style="background-color:orange">
                               <th class="text-center">รูป</th>
                               <th>หัวข้อประกาศ</th>
                               <th class="text-center">ประกาศโดย</th>
                               <th class="text-center">ประกาศเมื่อ</th>
                             </tr>

                            <tr>
                              @if($a != 0)

                              @php
                              $title = '';
                              @endphp

                              @foreach ($group as $jb)

                              @php
                                $title = array_get($jb, '0.job.title');
                                $link = array_get($jb, '0.job.slug');
                                $created_at= array_get($jb, '0.job.created_at');
                                $first_name= array_get($jb, '0.job.users.first_name');
                                $last_name= array_get($jb, '0.job.users.last_name');
                                $user_id = array_get($jb, '0.job.users.id');
                                $avatar= array_get($jb, '0.job.users.avatar');
                                $user = array_get($jb, '0.job.users.id');
                                $comp_name = array_get($jb, '0.job.users.e_comp_name');
                              @endphp


                                  <td class="text-center">
                                       <img src="/uploads/avatars/{{ $avatar }} " class="img" width="60">
                                   </td>
                                   <td>
                                       <h4>
                                           <a href="{!!action('PostJobController@show',$link)!!}"><b>{{ $title }}</b></a>
                                       </h4>

                                         @foreach ($jb as $index=>$jbs)
                                         <li>{{ array_get($jbs, 'position')}}
                                           <span class="pull-right badge">จำนวน {{ array_get($jbs, 'amount')}} คน</span>
                                         </li>
                                         @endforeach
                                   </td>
                                   <td class="text-center">
                                          <a href="{!!action('AuthController@show',$user_id)!!}"><b>{{ $comp_name }}</b></a><br>
                                           คุณ : <a href="{!!action('AuthController@show',$user_id)!!}"><i>{{ $first_name }} {{ $last_name }}</i></a>
                                   </td>
                                   <td class="text-center">{{ $created_at }}</td>
                               </tr>
                               @endforeach
                               <!-- endif ของ group -->
                               @endif
                           </tbody>
                       </table>
                       <div class="text-center">
                         {{ $jobs->links() }}
                       </div>

      </div>
      @if(empty($jobs))
      <div class="row">
        <div class="text-center">
          <h4><i class="fa fa-exclamation-triangle" aria-hidden="true"> ไม่พบประกาศงานในระบบ</i></h4>
        </div>
      </div>
      @endif

      @if(Session::has('search'))
      <p>iii</p>
      @endif




      </section>
    </div>
    </div>

  <!-- //next --------------------------------------------------------------------------------------------------->

<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>

<script>
$(document).ready(function(){
  $(".btn-warning").click(function(){
    $(".collapse").collapse('toggle');
  });
});
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
});
</script>
<script>
$(document).ready(function () {
    $(".btn-select").each(function (e) {
        var value = $(this).find("ul li.selected").html();
        if (value != undefined) {
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
    });
});

$(document).on('click', '.btn-select', function (e) {
    e.preventDefault();
    var ul = $(this).find("ul");
    if ($(this).hasClass("active")) {
        if (ul.find("li").is(e.target)) {
            var target = $(e.target);
            target.addClass("selected").siblings().removeClass("selected");
            var value = target.html();
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
        ul.hide();
        $(this).removeClass("active");
    }
    else {
        $('.btn-select').not(this).each(function () {
            $(this).removeClass("active").find("ul").hide();
        });
        ul.slideDown(300);
        $(this).addClass("active");
    }
});

$(document).on('click', function (e) {
    var target = $(e.target).closest(".btn-select");
    if (!target.length) {
        $(".btn-select").removeClass("active").find("ul").hide();
    }
});

</script>

</html>
@include('footer.footer')
