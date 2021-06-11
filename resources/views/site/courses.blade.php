@extends('site.layouts.layout')


@section('content')


    <main id="main" data-aos="fade-in">


        <div class="breadcrumbs">
      <div class="container">
        <h2>الدورات</h2>
        <p>
نقدم دورات تدريبية وتعليمية للمؤسسات والأفراد معتمدة من وزارة التعليم والمؤسسة العامة للتدريب التقني والمهني

        </p>

      </div>
    </div>
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row courses-d" data-aos="zoom-in" data-aos-delay="100">


        </div>

      </div>
    </section>

  </main>

@endsection

@section('script')
<script>
$(document).ready(function(){
  getc()
  function getc(){
    $.ajax({
    url:"http://localhost:8000/api/courses/page/1",
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

                  <h3><a href="/one-course/${datac.data[z]['id']}">
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
