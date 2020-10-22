@include('header.header')
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
   <script type="text/javascript" src="http://johannburkard.de/resources/Johann/jquery.highlight-5.js"></script>
<style>
p{font-size: 16px}
    	.highlight { background-color: yellow }

/*review ไม่ให้แก้ไขดาวตรงหน้าหลักได้*/
.noHover{
    pointer-events: none;
}
/*review*/
.animated {
   -webkit-transition: height 0.2s;
   -moz-transition: height 0.2s;
   transition: height 0.2s;
}

.stars
{
   margin: 20px 0;
   font-size: 20px;
   color: #ffd11a;
}
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
        <li>บอร์ดฟรีแลนซ์</li>
      </ol>
    </section>
    <br>
    <hr>
    <section class="content-body">
      <h4>
        @if($data)
        <i class="fa fa-file-text" aria-hidden="true"></i> บอร์ดฟรีแลนซ์ (พบทั้งหมด <b>{{$count}}</b>  คน)
        @else
        <i class="fa fa-file-text" aria-hidden="true"></i> บอร์ดฟรีแลนซ์ (พบทั้งหมด <b>{{$c}}</b>  คน)
        @endif
        <div class="pull-right">
          <form action="{!!action('MainController@getFreelancesBoardPage')!!}" method="get">
            {!!csrf_field()!!}
            <div class="input-group" style="width: 300px;">

              <input name="search" value="{{ $oldsearch }}" type="text" class="form-control" placeholder="กำลังมองหา...">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </form>
        </div>
      </h4>
    </section>

    <section class="content-body">
      <div class="row">
        <div class="col-xs-12">
          @foreach ($errors->all() as $error)
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p><strong>พบข้อผิดพลาด!</strong><li>{{ $error }}</li></p><br>
          </div>
          @endforeach
          @if (session('status'))
          <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>สำเร็จ!</strong> {{ session('status') }}
          </div>
          @endif
        </div>
      </div>
    </section>
    <br>
    <section class="content-body">
      <div class="row">
        <div class="col-xs-12">
          <table class="table table-striped">
            <thead>
              <tr style="background-color:grey">
                <th class="text-center"><b style="color:white;">เรทติ้ง</b></th>
                <th class="text-center"><b style="color:white;">รูป</b></th>
                <th class="text-center"><b style="color:white;">ชื่อ-สกุล</b></th>
                <th class="text-center"><b style="color:white;">ทักษะงานที่มี</b></th>
                <th class="text-center"><b style="color:white;">ความสามารถพิเศษ</b></th>
                <th class="text-center"><b style="color:white;">ประเภทงานที่ถนัด</b></th>
                <th class="text-center"><b style="color:white;">สนใจ</b></th>
              </tr>
            </thead>
            <tbody>
              @if($data)
              @foreach($ces as $n)
              <tr>
                <td class="text-center">
                  @foreach($check as $ch)
                  @if(empty($check))
                    <p class="stars starrr" data-rating="0"></p>
                  @endif

                  @if($n->id == $ch->reviewed)
                    <p class="stars starrr noHover" data-rating="{{$ch->rate}}"></p>
                  @endif
                  @endforeach
                </td>
                <td class="text-center"><img src="/uploads/avatars/{{$n->avatar}} " class="img" width="130"  height="130"></td>
                <td class="text-center">
                  <b>{{$n->first_name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$n->last_name}}</b>
                </td>
                <td><p class="highlight">{{$n->f_job_skills}}</p></td>
                <td>{{$n->f_personal_skills}}</td>
                <td>
                  <?php
                  $Size = unserialize($n->f_job_categories);
                  if (sizeof($Size)>0):
                  ?>
                  <h4><span class="label label-default">
                    <?php
                      echo implode('<br>',$Size);
                    ?>
                  </span></h4><br>

                  <?php endif; ?>
                </td>
                <td class="text-center">
                  <a href="{!!action('AuthController@show',$n->id)!!}">
                    <button class="btn btn-primary btn-sm" type="button" name="button">โปรไฟล์</button>
                  </a>
                  <hr>
                  @if(Auth::check())
                  @if (Auth::user()->isEmployer())
                  <a href ="{{url('sendmail')}}">
                    <button class="btn btn-success btn-sm" type="submit" name="hire" value="{{$n->id}}"><i class="fa fa-paper-plane" aria-hidden="true"></i> จ้าง</button>
                  </a>
                  @endif
                  @endif
                </td>
                @endforeach
            </tr>
          </tbody>
          </table>
              <!-- //มีการ search -->
              @else
              <!-- //ไม่มีการ search -->



              @foreach($freelances as $fln)
              <tr>
                <td class="text-center">
                  @foreach($check as $ch)
                  @if(empty($check))
                    <p class="stars starrr" data-rating="0"></p>
                  @endif

                  @if($fln->id == $ch->reviewed)
                    <p class="stars starrr noHover" data-rating="{{$ch->rate}}"></p>
                  @endif
                  @endforeach
                </td>
                <td class="text-center"><img src="/uploads/avatars/{{$fln->avatar}} " class="img" width="130" height="130"></td>
                <td class="text-center"><b>{{$fln->first_name}}&nbsp;&nbsp;&nbsp;&nbsp;{{$fln->last_name}}</b></td>
                <td>{{$fln->f_job_skills}}</td>
                <td>{{$fln->f_personal_skills}}</td>
                <td>
                  <?php
                  $Size = unserialize($fln->f_job_categories);
                  if (sizeof($Size)>0):
                  ?>
                  <h4><span class="label label-default">
                    <?php
                      echo implode('<br>',$Size);
                    ?>
                  </span></h4><br>

                  <?php endif; ?>
                </td>
                <td class="text-center">
                  <a href="{!!action('AuthController@show',$fln->id)!!}">
                    <button class="btn btn-primary btn-sm" type="button" name="button">โปรไฟล์</button>
                  </a>
                  <hr>
                  @if(Auth::check())
                  @if (Auth::user()->isEmployer())
                  <a href ="{{url('sendmail')}}">
                    <button class="btn btn-success btn-sm" type="submit" name="hire" value="{{$fln->id}}"><i class="fa fa-paper-plane" aria-hidden="true"></i> จ้าง</button>
                  </a>
                  @endif
                  @endif

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="text-center">
            {{ $freelances->links() }}
          </div>
          @endif

        </div>

      </div>
      </div>
    </section>


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
  $(".btn").click(function(){
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
<script type="text/javascript">
(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

$(function(){

  $('#new-review').autosize({append: "\n"});

  var reviewBox = $('#post-review-box');
  var newReview = $('#new-review');
  var openReviewBtn = $('#open-review-box');
  var closeReviewBtn = $('#close-review-box');
  var ratingsField = $('#ratings-hidden');

  openReviewBtn.click(function(e)
  {
    reviewBox.slideDown(400, function()
    {
      $('#new-review').trigger('autosize.resize');
      newReview.focus();
    });
    openReviewBtn.fadeOut(100);
    closeReviewBtn.show();
  });

  closeReviewBtn.click(function(e)
  {
    e.preventDefault();
    reviewBox.slideUp(300, function()
    {
      newReview.focus();
      openReviewBtn.fadeIn(200);
    });
    closeReviewBtn.hide();

  });

  $('.starrr').on('starrr:change', function(e, value){
    ratingsField.val(value);
  });
});
</script>

<!-- //search highlight -->
<script type="text/javascript">
	$('button').click(function(){
		$('.row').removeHighlight().highlight($('.search').val());
	})
</script>

</html>
@include('footer.footer')
