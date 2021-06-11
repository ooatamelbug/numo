<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-right"><a href="/">Numo  </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="/" class="logo mr-auto">
      <img src="assets/img/logo.png" alt="" class="img-fluid">  </a>-->

      <nav class="nav-menu d-none d-lg-block mr-auto">
        <ul>
          <li class="active"><a href="/">الرئيسية</a></li>
          <li><a href="/about"> من نحن  </a></li>
          <li class="drop-down"><a href="/category"> الاقسام التدربية   </a>
      <ul class="text-right category" id="" >
            </ul>
      </li>
          <li><a href="/courses">الدورات  </a></li>
          <li><a href="/structure">الهيكل  </a></li>
          <li><a href="/news">المركز الإعلامي   </a></li>

          <li><a href="/contact">
      تواصل معنا



      </a></li>

        </ul>
      </nav>

      <a id="login" href="http://university.arkanorg.com/front/login/login_html.php" class="get-started-btn log" >


      </a>
      <script src="{{ asset('/vendor/jquery/jquery.min.js')}}"></script>
      <script>
        $(document).ready(function(){
          var d = localStorage.getItem('token');
          console.log(d)
          if(!d){
            $('.log').text('الصفحه الشخصيه ')
          }else {
            $('.log').text('تسجيل دخول')
          }

          get();

          function get(){
            $.ajax({
            url:"http://localhost:8000/api/categories/",
            method:'GET',
            data: {},
            cache:false,
            success:function(data){
              console.log(data.data);
              if(data.success == true ){
                var i = 0;
                while ( i < data.data.length) {
                  $('.category').append(`<li><a href="/courses/${data.data[i]['id']}">${data.data[i]['title']}</a></li>`)
                  i++;
                }
                window.setTimeout(function() {
                },4000)

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
    </div>
  </header>
