@include('header.header')
<style>
.panel-body{
  background: lightgrey;
}
body{
 padding-bottom:80px
}
.img-container {
    position: relative;
    opacity: 0.9;
}

.img-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 18px;
}
/*img {
    opacity: 0.7;
}*/
.hero-image {
  height: 50%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #003366;
}

.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: white;
  background-color: orange;
  text-align: center;
  cursor: pointer;
}

.hero-text button:hover {
  background-color: #555;
  color: orange;
}
.well {
    background: rgb(204,204,204);
}
.btn-default-search {
  background-color: orange ;
}
.btn-app {
  background-color: lightgray;
}
.btn-default-search:hover {
  background-color: grey;
}
.thumbnail {
    position: relative;
    padding: 0px;
    margin-bottom: 20px;
}

.thumbnail img {
    width: 100%;
}
</style>

<body>
  <div class="container">

    <section class="content-header">
      <h1>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
      </ol>
    </section>
@if(!Auth::check())
    <section class="content-body">
      <h5>ศูนย์รวมงานฟรีแลนซ์จังหวัดบุรีรัมย์</h5>
    </section>
@else

    <section class="content-body">
      <h5>ศูนย์รวมงานฟรีแลนซ์จังหวัดบุรีรัมย์ ยินดีต้อนรับคุณ <a href="{!!action('AuthController@getAccountPage',$id)!!}"><b>{!!Auth::user()->first_name!!}</b></a></h5>
    </section>
@endif

    <section class="content-body">

      <div class="img-container">
        <img src="img/bg-3.jpg" alt="bg" width="100%" height="380">
        <div class="hero-text">
          <h1 style="font-size:30px">เว็บจัดหางานฟรีแลนซ์จังหวัดบุรีรัมย์</h1>
          <p>ลงทะเบียนสมาชิกฟรี เพื่อเข้าใช้งาน</p>
          <a href="{!!route('freelanceregister')!!}"><button><font color="steelblue"><b>ฟรีแลนซ์</b></font></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{!!route('employerregister')!!}"><button><font color="steelblue"><b>ผู้ว่าจ้าง</b></font></button></a>
        </div>
    </div>

      <!-- #well start -->
      <div class="well well-lg">
        <div class="row">
          <div class="col-lg-6",style="background-color:blue">
            <div class="input-group">
              <form action="{!!action('MainController@getFreelancesBoardPage')!!}" method="get">
                {!!csrf_field()!!}
                <div class="input-group" style="width: 520px;">
                  <span class="input-group-btn">
                    <button class="btn btn-default-search" type="submit">หาฟรีแลนซ์</button>
                  </span>
                  <input type="text" class="form-control" name="search" value="{{ $oldsearch }}" placeholder="กำลังมองหาฟรีแลนซ์ เช่น ช่าง โปรแกรมเมอร์ ฯลฯ">
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="input-group">
              <form action="{!!route('search')!!}" method="get">
                {!!csrf_field()!!}
                <div class="input-group" style="width: 520px;">
                  <input type="text" class="form-control" name="search" value="{{ $oldsearch }}" placeholder="กำลังมองหางาน เช่น แม่บ้าน สถาปนิก ฯลฯ">
                  <span class="input-group-btn">
                    <button class="btn btn-default-search" type="submit">หางาน</button>
                  </span>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
    <!-- #well end -->

    <!-- start คำติชมเพจ -->
    <div class="container">
  <div class="row">
  </div>
  <div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#quote-carousel" data-slide-to="1"></li>
          <li data-target="#quote-carousel" data-slide-to="2"></li>
        </ol>

        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">

          <!-- Quote 1 -->
          <div class="item active">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="http://s3.gossipcop.com/up/gallery/robert-pattinson-fka-twigs-039lost-city-of-z039-london-premiere/635667010.jpg" style="width: 100px;height:100px;">
                  <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
                </div>
                <div class="col-sm-9">
                  <p>แค่กรอกประวัติส่วนตัว และคุณสมบัติต่างๆ ไว้ ก็มีบริษัทมากมายเข้ามาติดต่อ สะดวกมากๆครับ</p>
                  <small>Robert Pattinson</small>
                </div>
              </div>
            </blockquote>
          </div>
          <!-- Quote 2 -->
          <div class="item">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="http://ksassets.timeincuk.net/wp/uploads/sites/55/2017/06/Tom-Cruise-1-920x584.jpg" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p>หาฟรีแลนซ์ได้ง่ายมากขึ้น และตรงกับความต้องการของผม ไม่ผิดหวังเลยครับที่ใช้บริการ ฟรีแลนซ์บุรีรัมย์</p>
                  <small>Tom Cruise</small>
                </div>
              </div>
            </blockquote>
          </div>
          <!-- Quote 3 -->
          <div class="item">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="http://cdn04.cdn.justjaredjr.com/wp-content/uploads/headlines/2016/01/watson-book.jpg" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p>เข้าค้นหางาน ค้นหาฟรีแลนซ์ได้อย่างง่าย สะดวก รวดเร็วมากเลยค่ะ</p>
                  <small>Hermione Granger</small>
                </div>
              </div>
            </blockquote>
          </div>
        </div>

        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>
    </div>
  </div>
</div>
    <!-- End คำติชมเพจ -->

    <!-- #site static start -->
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="/freelancesboard"><div class="info-box">
          <span class="info-box-icon bg-orange"><i class="ion ion-ios-people-outline"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">ฟรีแลนซ์ทั้งหมด</span>
            <span class="info-box-number"><?php echo "$c" ?><small>   คน</small></span>
          </div>
        </div></a>
      </div>
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-grey"><i class="ion ion-ios-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ผู้ว่าจ้างทั้งหมด</span>
            <span class="info-box-number"><?php echo "$b" ?><small>   คน</small></span>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-sm-6 col-xs-12">
        <a href="/jobsboard"><div class="info-box">
          <span class="info-box-icon bg-blue"><i class="ion ion-android-clipboard"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">ประกาศงานทั้งหมด</span>
            <span class="info-box-number"><?php echo "$a" ?><small>   งาน</small></span>
          </div>
        </div></a>
      </div>
    </div>
    <!-- #site static end -->

    <!-- #category start -->

<div class="row">
  <div class="col-md-8 col-sm-6 col-xs-12">
			<div class="panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title">แสดงความคิดเห็น</h1>
				</div>
				<div class="panel-body">
					<div class="form-group col-md-12 col-sm-6 col-xs-12">
            <div class=" col-md-6 col-sm-6 col-xs-12">
              <label>ชื่อ-นามสกุล</label>
  						<input class ="form-control" type="text" id="username">
            </div>
            <div class=" col-md-6 col-xs-12">
              <label>อีเมล</label>
  						<input class ="form-control" type="email" name="email" id="email" required="required">
            </div>
            <div class=" col-md-12 col-xs-12">
              <label>ความคิดเห็นหรือข้อเสนอแนะ</label>
  						<textarea class="form-control" rows="2" id="comment" required="required"></textarea>
            </div>
					</div>
					<div class="clearfix"></div>
					<div class="form-group col-md-12 col-sm-6 col-xs-12">
						<button class="btn btn-primary pull-right" type="button" onclick="loadAjax()">ตกลง</button>
					</div>
				</div>
			</div>
  </div>


  <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title">
            <i class="fa fa-list" aria-hidden="true"><class="box-title">&nbsp; หมวดหมู่งาน</i>
          </h1>
				</div>

            <div class="box-footer no-padding">
              <form action="{!!action('MainController@search')!!}" method="post">
                {!!csrf_field()!!}
              @foreach ($ctgr as $cate)
              <ul class="nav nav-stacked">
                @if ( $cate->id  % 2 == 0)
                <li style="background-color:#F5F5F5;">
                  <button type="submit" class="btn btn-warning glyphicon glyphicon-search" name="b1" value="{{$cate->id}}"></button>
                    {{$cate->name}}
                      <span class="pull-right badge bg-yellow" style="height: 20px;">{{$cate->count_ct}} </span>
                </li>
                @else
                <li style="background-color:#DCDCDC;">
                  <button type="submit" class="btn btn-primary glyphicon glyphicon-search" name="b1" value="{{$cate->id}}"></button>
                    {{$cate->name}}
                      <span class="pull-right badge bg-grey" style="height: 20px;">{{$cate->count_ct}} </span>
                </li>
                @endif
              </ul>
              @endforeach
            </form>
            </div>
            <br><hr>
    </div>
</div>
</div>
    <!-- #category end -->


    </section>
  </div>

</body>

@include('footer.footer')
