<section id="hero" class="d-flex justify-content-center align-items-center">
      <Search />
      <div id="carouselExampleIndicators" class="carousel slide " style="width: 100%; height:100%;padding-top:7px" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{ asset('/course-1.jpg')}}" alt="First slide" />
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('/course-2.jpg')}}" alt="Second slide" />
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{ asset('/course-3.jpg')}}" alt="Third slide" />
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

  </section>
