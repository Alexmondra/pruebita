<x-app-layout>
  <!-- Main content -->
  <div class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-12">
                  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                          <div class="carousel-item active">
                              <img src="{{asset('assets/car1.png') }}" class="d-block w-100" alt="..." style="object-fit: cover; height: 300px;">
                          </div>
                          <div class="carousel-item">
                              <img src="{{asset('assets/car2.png') }}" class="d-block w-100" alt="..." style="object-fit: cover; height: 300px;">
                          </div>
                          <div class="carousel-item">
                              <img src="{{ asset('assets/car3.png') }}" class="d-block w-100" alt="..." style="object-fit: cover; height: 300px;">
                          </div>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                      </button>
                  </div>
              </div>
          </div>
      </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
  @push('scripts')
  <script>
      $('#carouselExampleIndicators').carousel({ interval: 2000 }); // Cambia el intervalo a 2000 milisegundos (2 segundos) para que cambie automáticamente
      
      $('#liDashboard').addClass("menu-open");
      $('#aDashboard').addClass("active");
  </script>
  @endpush
</x-app-layout>
