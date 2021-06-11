@extends('site.layouts.layout')

@section('content')

@include('site.layouts.slide')

  <main  id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title text-center">
          <h2> عنا</h2>
          <p>نبذه عنا
          </p>
        </div>

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="{{ asset('/about.jpg')}}" class="img-fluid" alt="" />
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content text-right">
            <h3>
                بأحدث المعاير الدولية , نقدم دورات تدريبية وتعليمية  .

            </h3>
            <p class="font-italic">
                إيمانا منا بأهمية التدريب والتأهيل العلمي لشباب المملكة لتدعيم نهضتها وتقدمها ولأن تقدم اي امة تحتاح الي كوادر وشباب مؤهل كانت فكرة انشاء معهد ليست مادة تدربية فقط او محاضر او مدرب لشرح تلك المادة بل كانت الفكرة الاساسية هي عملية تطوير التدريب بشكل مختلف داخل المملكة العربية السعودية فالمتدرب لدينا لا يتوقع منا فقط شرح تلك المادة التدرببية ولكن يجد لدنيا نقل للخبرات العلمية والعملية في نفس الوقت .

            </p>
            <ul>
              <li><i class="icofont-check-circled"></i>
                    دوراتنا تدعم حياتك المهنية من خلال دورات الشركات لدينا


              </li>
              <li><i class="icofont-check-circled"></i>

                  الحصول على شهادات معتمدة من التعليم والمؤسسة العامة للتدريب التقني والمهني

              </li>
            </ul>
            <a href="/about" class="learn-more-btn">اعرف اكتر</a>
          </div>
        </div>

      </div>
    </section>
    <!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">1232</span>
            <p>المتدربين</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">64</span>
            <p>دورات</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">42</span>
            <p> ندوات </p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-toggle="counter-up">15</span>
            <p>  محاضرين </p>
          </div>

        </div>

      </div>
    </section>
      <!-- End Counts Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch text-right">
            <div class="content">
              <h3>لماذا نحن ؟ </h3>
              <p>

              إعداد وتأهيل كوادر وطنية قادرة على تلبية احتياجات سوق العمل المحلي والعالمي من خلال تقديم برامج تعليمية وتدريبية متميزة في بيئة احترافية محفزة للتعلم والابداع وذلك بالاستغلال الامثل للوسائل التقنية الحديثة ووفق أعلى معايير الجودة وأفضل الممارسات المحلية والعالمية .
</p>
              <div class="text-center">
                <a href="about.html" class="more-btn"> اعرف اكتر
 <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>
الترقية المهنية

                        </h4>
                    <p>
دوراتنا تدعم حياتك المهنية من خلال دورات الشركات لدينا


                        </p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>بيئة تعليمية اجتماعية

                            </h4>
                    <p>بيئة تعليمية ممتعة مع طرق ترفيهية و تعليمية مختلفة


                                </p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>شهادة معتمدة

</h4>
                    <p>
الحصول على شهادات معتمدة من التعليم والمؤسسة العامة للتدريب التقني والمهني

                                </p>
                  </div>
                </div>
              </div>
            </div>
      <!-- End .content-->
          </div>
        </div>

      </div>
    </section>
    <!-- End Why Us Section -->

    <!-- ======= Features Section ======= -->
 <!--   <section id="features" class="features">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box">
              <i class="ri-store-line" style="color: #ffbb2c"></i>
              <h3><a href="">Lorem Ipsum</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-bar-chart-box-line" style="color: #5578ff" ></i>
              <h3><a href="">Dolor Sitema</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-calendar-todo-line" style="color: #e80368"></i>
              <h3><a href="">Sed perspiciatis</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="ri-paint-brush-line" style="color: #e361ff"></i>
              <h3><a href="">Magni Dolores</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-database-2-line" style="color: #47aeff"></i>
              <h3><a href="">Nemo Enim</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-gradienter-line" style="color: #ffa76e"></i>
              <h3><a href="">Eiusmod Tempor</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-file-list-3-line" style="color: #11dbcf "></i>
              <h3><a href="">Midela Teren</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-price-tag-2-line" style="color:#4233ff"></i>
              <h3><a href="">Pira Neve</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-anchor-line" style="color:#b2904f"></i>
              <h3><a href="">Dirada Pack</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-disc-line" style="color: #b20969"></i>
              <h3><a href="">Moton Ideal</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-base-station-line" style="color:#ff5828"></i>
              <h3><a href="">Verdo Park</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-fingerprint-line" style="color:#29cc61"></i>
              <h3><a href="">Flavor Nivelanda</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section>
     End Features Section -->

    <!-- ======= Popular Courses Section ======= -->
    <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="section-title text-center">
          <h2>الدورات </h2>
          <p>  الدورات الشائعه </p>
        </div>

        <div class="row courses-d">


        </div>

      </div>
    </section> <!-- End Popular Courses Section -->

    <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">

        <div class="section-title text-center">
          <h2>شركاؤنا</h2>
          <p>
             شركاؤنا في مسيرة النجاح والازدهار
   </p>
        </div>

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

            <div class="col-lg-3 col-md-3 d-flex align-items-stretch">
            <div class="member">
              <img src="{{ asset('https://numo.sa/wp-content/uploads/2020/04/rrr2.jpg')}}" class="img-fluid" alt="" />

            </div>
          </div>
          <div class="col-lg-3 col-md-3 d-flex align-items-stretch">
            <div class="member">
              <img src="{{ asset('https://numo.sa/wp-content/uploads/2020/04/rrr2.jpg')}}" class="img-fluid" alt="" />

            </div>
          </div>
          <div class="col-lg-3 col-md-3 d-flex align-items-stretch">
            <div class="member">
              <img src="{{ asset('https://numo.sa/wp-content/uploads/2020/04/rrr2.jpg')}}" class="img-fluid" alt="" />

            </div>
          </div>
          <div class="col-lg-3 col-md-3 d-flex align-items-stretch">
            <div class="member">
              <img src="{{ asset('https://numo.sa/wp-content/uploads/2020/04/rrr2.jpg')}}" class="img-fluid" alt="" />

            </div>
          </div>




        </div>

      </div>
    </section>
    <!-- End Trainers Section -->

      </main>
@endsection

@section('script')
<script>
  $(document).ready(function(){
    getc()
    function getc(){
      $.ajax({
      url:"http://localhost:8000/api/courses/",
      method:'GET',
      data: {},
      cache:false,
      success:function(datac){
        console.log(datac.data);
        if(datac.success == true ){
          var z = 0;
          while ( z < datac.data.length) {
            $('.courses-d').append(`
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch text-right">
                <div class="course-item">
                  <img src="http://localhost:8000/${datac.data[z]['image']}" class="img-fluid" alt="..."/>
                  <div class="course-content">
                    <div class="d-flex justify-content-between align-items-center mb-3 ">
                      <h4 class="float-left" >
                      ${datac.data[z]['categories']}
                              </h4>
                      <p class="price float-right">
                      ${datac.data[z]['price']}
                      </p>
                    </div>

                    <h3><a href="course-details.html">
                    ${datac.data[z]['title']}
                             </a></h3>
                    <p>
                    ${datac.data[z]['desc']}
                    </p>
                    <div class="trainer d-flex justify-content-between align-items-center">
                      <div class="trainer-profile d-flex align-items-center">
                        <img src="
                        http://localhost:8000/${datac.data[z]['teacher_image']}
                        " class="img-fluid" alt="" />
                        &nbsp;&nbsp;

                        <span>
                        ${datac.data[z]['teachers']}
                        </span>
                      </div>
                      <div class="trainer-rank d-flex align-items-center">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              `)
            z++;
          }

        }else{
          var dataarray = data.data;
          var i = 0;
          while ( i < dataarray.length) {
            $('#error').append(`<div class="alert alert-danger">${dataarray[i]}</div>`)
            i++;
          }
        }
      }
    })
    }

  })
</script>
@endsection
