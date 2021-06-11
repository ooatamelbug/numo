@extends('site.layouts.layout')

@section('content')


  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
      <div class="container">
        <h2>تفاصيل الدورة
 </h2>
        <p class="c-d">

        </p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Cource Details Section ======= -->
    <section id="course-details" class="course-details">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8 text-right">
            <img src="/course-details.jpg" class="img-fluid c-img" alt=""/>
            <h3 class="c-t" >
    دورة مهارات تجاوز المقابلة الشخصية بنجاح
        </h3>
            <p class="c-d">
دورة تدريبية ستساهم بشكل مؤكد على تزويدك بالمهارات اللازمة لاجتياز مقابلة التوظيف بنجاح، واقناع الطرف المقابل بأحقيتك وكفاءتك لاستلام الوظيفة المعروضة. في نهاية هذه الدورة ستتمكن من التغلب على العقبات التي تواجهك في كل مقابلة توظيف تمر بها؛ ستعرف كيف تستعد جيدا لكل مقابلة توظيف، وستتعرف على الأنواع المختلفة لمقابلات التوظيف، وستتمكن من معرفة الخطوات المهمة كي تسوق لنفسك في بيئة العمل وقبل حضورك المقابلة. كما ستكسب مهارة الإجابة على الأسئلة الأكثر شيوعاً في مقابلات التوظيف، وستخرج في النهاية ببعض النصائح الذهبية التي ستحسن من أدائك بكل تأكيد في أي مقابلة توظيف بعد ذلك.


        </p>
          </div>
          <div class="col-lg-4">

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>المدرب</h5>
              <p class="c-tc"><a href="#" >Walter White</a></p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>
رسوم الدورة
        </h5>
              <p class="c-p">$165</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>
عدد الواحدات ​

        </h5>
              <p class="c-u">30</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <h5>مدة الدورة

</h5>
              <p class="c-th">5.00 pm - 7.00 pm</p>
            </div>

            <div class="course-info d-flex justify-content-between align-items-center">
              <a href="/cart" class="get-started-btn" passHref>
                <RedLink class="get-started-btn btn form-control">
إضافة إلى سلة الدورات
                </RedLink>
                  </a>

        </div>

          </div>
        </div>

      </div>
    </section><!-- End Cource Details Section -->

    <!-- ======= Cource Details Tabs Section ======= -->
    <section id="cource-details-tabs" class="cource-details-tabs">
      <div class="container" data-aos="fade-up">

        <div class="row ">
            <div class="col-lg-12 course-details text-right">
            <h3>
الدورة تحتوي
        </h3>
              </div>

        <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column text-center details">

            </ul>
        </div>
        <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content text-right c-details">


            </div>
      </div>
    </section><!-- End Cource Details Tabs Section -->

  </main>
  @endsection

  @section('script')
  <script>
    $(document).ready(function(){
      getc()
      function getc(){
        $.ajax({
        url:"http://localhost:8000/api/courses/"+{{$courses}},
        method:'GET',
        data: {},
        cache:false,
        success:function(datac){
          console.log(datac.data);
          if(datac.success == true ){
            var z = 0;
            var d = datac.data
              $('.c-d').text(d['desc'])
              $('.c-p').text(d['price'])
              $('.c-t').text(d['title'])
              $('.c-tc').text(d['teacher'])
              $('.c-th').text(d.details['total_time'])
              $('.c-u').text(d.details['units'])
              $('.c-img').attr('src',`
              http://localhost:8000/`+d['image'])

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
      getdt();
      function getdt(){
        $.ajax({
        url:"http://localhost:8000/api/courses/unites/"+ {{$courses}},
        method:'GET',
        data: {},
        cache:false,
        success:function(datac){
          console.log(datac.data);
          if(datac.success == true ){
            var c = 0;
            while ( c < datac.data.length) {
              var classd = '';
              if(c == 0){ classd = 'active show' }
              $('.details').append(`
                <li class="nav-item ">
                  <a class="nav-link ${classd}" data-toggle="tab" href="#tab-${c + 1}">
                  ${datac.data[c]['title']}
                    </a>
                </li>
                `)
                $('.c-details').append(`

              <div class="tab-pane ${classd}" id="tab-${c + 1}">
        <div class="row">
          <div class="col-lg-8 details order-2 order-lg-1">
            <h3>
              ${datac.data[c]['title']}
            </h3>
            <p class="font-italic">
            ${datac.data[c]['desc']}

            </p>

          </div>
          <div class="col-lg-4 text-center order-1 order-lg-2">
            <img src="/course-details-tab-1.png" alt="" class="img-fluid"/>
          </div>
        </div>
      </div>
      `)
    c++;
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
