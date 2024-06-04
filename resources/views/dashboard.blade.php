<x-app-layout>
    <!-- Main content -->
    <!DOCTYPE html>
  <html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Trámites y Solicitudes en Línea</title>
      <style>
          /* Estilos CSS */
          body {
              font-family: Arial, sans-serif;
              margin: 0;
              padding: 0;
              background-color: #f4f4f4;
          }
  
          header {
              background-color: #333;
              color: #fff;
              padding: 10px;
              text-align: center;
          }
  
          .container {
              max-width: 800px;
              margin: auto;
              padding: 20px;
          }
  
          h1 {
              text-align: center;
          }
  
          p {
              text-align: justify;
          }
  
      </style>
  </head>
  <body>
      <header>
          <h1>Trámites y Solicitudes en Línea</h1>
      </header>
      <div class="container">
          <h2>¡Bienvenido!</h2>
          <p>En esta página podrás realizar diversos trámites y solicitudes en línea de manera rápida y sencilla. Te ofrecemos una plataforma segura y confiable para facilitar tus gestiones.</p>
          <h3>Trámites Disponibles:</h3>
          <ul>
              <li>Solicitud de documentos</li>
              <li>Trámites administrativos</li>
              <li>Registro de información</li>
          </ul>
          <h3>¿Cómo Funciona?</h3>
          <ol>
              <li>Selecciona el trámite que deseas realizar.</li>
              <li>Rellena el formulario correspondiente con tus datos.</li>
              <li>Envía la solicitud.</li>
              <li>Recibirás confirmación por correo electrónico y podrás dar seguimiento al estado de tu trámite.</li>
          </ol>
          <br></br>
          <p>¡ESTAMOS AQUI PARA AYUDARTE EN TOO MOMENTO...!</p>
      </div>
  </body>
  </html>
    
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('assets/car1.png') }}" class="d-block w-100" alt="..." style="object-fit: cover; height: 300px;">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('assets/car2.png') }}" class="d-block w-100" alt="..." style="object-fit: cover; height: 300px;">
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