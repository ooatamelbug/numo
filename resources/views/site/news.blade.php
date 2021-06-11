@extends('site.layouts.layout')

@section('content')
<main id="main">

   <!-- ======= Breadcrumbs ======= -->
   <div class="breadcrumbs" data-aos="fade-in">
     <div class="container">
       <h2>
اخر الأخبار


       </h2>
       <p>

       </p>
     </div>
   </div><!-- End Breadcrumbs -->

   <!-- ======= Events Section ======= -->
   <section id="events" class="events">
     <div class="container" data-aos="fade-up">

       <div class="row news-d">

       </div>

     </div>
   </section>
       <!-- End Events Section -->

 </main>
@endsection

@section('script')
<script>

  $(document).ready(function(){
    getn()
    function getn(){
      $.ajax({
      url:"http://localhost:8000/api/news/",
      method:'GET',
      data: {},
      cache:false,
      success:function(datac){
        console.log(datac.data[0]['images']);
        if(datac.success == true ){
          var z = 0;
          while ( z < datac.data.length) {
            $('.news-d').append(`

                      <div class="col-md-6 d-flex align-items-stretch text-center">
                          <div class="card">
                            <div class="card-img">
                              <img src=http://localhost:8000/${datac.data[z]['images'][0]['link']} alt="..."/>
                            </div>
                            <div class="card-body">
                              <h5 class="card-title"><a href="/news/one-news">
                              ${datac.data[z]['title']}
                              </a>
                              </h5>
                              <p class="font-italic text-center"> ${datac.data[z].created_at}</p>
                              <p class="card-text">
                                   ${datac.data[z]['body']}
                              </p>
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
