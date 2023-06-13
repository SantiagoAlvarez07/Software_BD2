<!doctype html>
<html lang="en">

    <!-- HEAD - (DATOS COMO PESTAÑA, DE S_O) -->
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Manos Amor y Semilla</title>
      <link rel="shorcut icon" href="img/Logo_favicon.png">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
      rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
      crossorigin="anonymous">
          
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
      crossorigin="anonymous"></script>

      <script>
		// Guarda la posición actual de la página en localStorage
		window.onbeforeunload = function() {
			localStorage.setItem('scrollPosition', window.pageYOffset);
		};

		// Restaura la posición actual de la página desde localStorage
		window.onload = function() {
			var scrollPosition = localStorage.getItem('scrollPosition');
			if (scrollPosition !== null) {
				window.scrollTo(0, scrollPosition);
				localStorage.removeItem('scrollPosition');
			}
		};
	</script>

      
      <link href="assets/CSS/carousel.css" rel="stylesheet">

        <!-- ESTILOS - (ESTÁN LOS ESTILOS GEN., DE S_O) -->
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            margin: 20px;
            }
        }

        #menu{
            height: 75px;
        }
        </style>
        <!-- ESTILOS DEL CARRUSEL (DONDE CORREN LAS IMÁGENES) -->
        <link href="assets/CSS/carousel.css" rel="stylesheet">

    </head>

    <!-- ==================================================================================================== -->

    <!-- BODY - (EL CUERPO, DE S_O) -->
    <body>
        <!-- HEADER - (ENCABEZADO, DE S_O) -->
        <header>
            <header class="py-3 mb-3 border-bottom">
                <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
                    
                  <!-- LOGO_PRINCIPAL -->
                  <a href="" id="icon_logo_prin"> <img src="img/Icon_logo_prin_3.png" width="500px"></a>
                    
                    <!-- BARRA DE BUSQUEDA -->
                    <div class="d-flex align-items-center">
                      
                        <form class="w-100 me-3">
                          <input type="Buscar" class="form-control_buscador" placeholder="Buscar..." aria-label="Buscar" >
                        </form>
                        
                         <!-- INICIO DE SESIÓN -->
                            <div class="flex-shrink-0 dropdown">
                              <center>
                                <a href="index.php" class="nav-link">
                                    <img src="img/Icon_login_prin.png" width="60" height="60" >
                                </a>
                              </center>
                              <a href="index.php" class="nav-link text-dark"><center><h3 class="tituloMiCuenta">Mi cuenta</h3></center></a>
                            </div>
                      
                    </div>
                </div>
            </header>

            <div id="menu_principal" class="px-3 py-2 bg-secondary text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                        <svg class="bi me-2" width="30" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                        </a>
                        
                        <ul  class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li>
                                <a href="principal.php"class="nav-link text-white"><center><img src="img/img_prin/Icon_inicio.png" width="32px"></center>Inicio</a>
                            </li>

                            <li>
                                <a href=""  class="nav-link text-white"><center><img src="img/img_prin/Icon_matriculas.png" width="27px"></center>Matrículas</a>
                            </li>

                            <li>
                                <a href="" class="nav-link text-white"><center><img src="img/img_prin/Icon_contactanos_sii.png" width="26px"></center>Contáctanos</a>
                            </li>
                        </ul>

                  </div>
                </div>
              </div>
              
        </header>
        <br>

        <!-- ==================================================================================================== -->

        <!-- MAIN - (CONTENIDO PRINCIPAL, DE LyTA) -->
        <main>
            <!-- CARRUSEL - (ACÁ ESTÁ DONDE PASAN LAS IMÁGENES) -->
            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  </div>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a class="bd-placeholder-img" href=""></a><center><img src="img//carusel_1.jpeg" height="700px" width="1200px"></a></center>
                        <!-- 
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>SOMOS CALIDAD</h1>
                                <p>Todos nuestras ayudas estás calficadas con altos índices de educación</p>
                                <p><a class="btn btn-lg btn-primary" href="#">Experimenta ya...</a></p>
                            </div>
                        </div>
                        -->
                    </div>
                    
                    <div class="carousel-item">
                        <a class="bd-placeholder-img" href=""></a><center><img src="img//carusel_2.jpg"  height="700px" width="1200px"></a></center>
                        <!-- 
                        <div class="container">
                            <div class="carousel-caption">
                                <h1>SOMOS ECONOMÍA</h1>
                                <p>Todos nuestros precios son adecuados para tu bolsillo</p>
                                <p><a class="btn btn-lg btn-primary" href="#">Cotiza ya...</a></p>
                            </div>
                        </div>
                        -->
                    </div>

                    <div class="carousel-item">
                      <a class="bd-placeholder-img" href=""><center></a><img src="img//carusel_3.jpeg"  height="700px" width="1200px"></a></center>
                      <!-- 
                      <div class="container">
                          <div class="carousel-caption">
                              <h1>SOMOS ECONOMÍA</h1>
                              <p>Todos nuestros precios son adecuados para tu bolsillo</p>
                              <p><a class="btn btn-lg btn-primary" href="#">Cotiza ya...</a></p>
                          </div>
                      </div>
                      -->
                  </div>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- ================================================================================================ -->

                <!-- OPCIONES DE INFORMACIÓN  -->

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">MISIÓN <span class="text-muted"></span></h2>
                        <p class="lead">La educación sexual es un proceso educativo enfocado a los niños y adolescentes. La misma está diseñada con el fin de otorgarle al joven conocimientos e información sexual, con el fin de ayudar a tomar decisiones saludables en la sexualidad y el sexo. Además, en cada edad se debe abordar temas de manera distinta, por eso es necesario establecer una buena comunicación con los niños y usar el vocabulario adecuado. Asimismo, hoy en día podemos encontrar material de todo tipo, el cual nos puede ayudar como apoyo en los aspectos de sexualidad.</p>
                    </div>
                    <div class="col-md-5">
                        <a class="bd-placeholder-img" href="1_categorias.html"></a><img src="img/Icon_mision.png" height="350px" width="400px"></a>

                    </div>
                </div>

                <hr class="featurette-divider">
                <div class="row featurette">
                  <div class="col-md-5">
                    <a class="bd-placeholder-img" href="1_categorias.html"></a><center><img src="img/Icon_vision.jpg" height="350px" width="400x"></center></a>
                  </div> 
                
                  <div class="col-md-7">
                      <h2 class="featurette-heading">VISIÓN <span class="text-muted"></span></h2>
                      <p class="lead">La educación sexual es un proceso educativo enfocado a los niños y adolescentes. La misma está diseñada con el fin de otorgarle al joven conocimientos e información sexual, con el fin de ayudar a tomar decisiones saludables en la sexualidad y el sexo. Además, en cada edad se debe abordar temas de manera distinta, por eso es necesario establecer una buena comunicación con los niños y usar el vocabulario adecuado. Asimismo, hoy en día podemos encontrar material de todo tipo, el cual nos puede ayudar como apoyo en los aspectos de sexualidad.</p>
                  </div>    
                </div>
            

            <hr class="featurette-divider">
             
            <!-- VIDEO - YOUTUBE -->
            <center>
            <div class="wpb_single_image wpb_content_element vc_align_center  wpb_animate_when_almost_visible wpb_bounceInLeft bounceInLeft">
              <figure class="wpb_wrapper vc_figure">
                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="505" height="64" 
                  src="https://colegiodelapresentacion.edu.co/wp-content/uploads/2019/08/open-house-2019-exalumnos-6.png" class="vc_single_image-img attachment-full" 
                  alt srcset="https://colegiodelapresentacion.edu.co/wp-content/uploads/2019/08/open-house-2019-exalumnos-6.png 505w, https://colegiodelapresentacion.edu.co/wp-content/uploads/2019/08/open-house-2019-exalumnos-6-300x38.png 300w" 
                  sizes="(max-width: 505px) 100vw, 505px" /></div>
              </figure>
            </div>
          </center>
              
            <center>
            <div class="vc_row wpb_row vc_row-fluid vc_custom_1579814731018 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
              <div class="wpb_raw_code wpb_content_element wpb_raw_html">
                <div class="wpb_wrapper">
                  <iframe width="580" height="314" src="https://www.youtube.com/embed/AOC2pR4g7gU?rel=0&amp;showinfo=0" 
                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                  </iframe>
                  <iframe width="580" height="314" src="https://www.youtube.com/embed/jLiVYXSfmOo?rel=0&amp;showinfo=0" 
                    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                  </iframe>
                </div>
              </div>
            </div>
          </center>

          <hr class="featurette-divider">

            <!-- SUSCRIPCIÓN -->
            <header class="p-3 bg-secondary text-white">
                <div class="container">
                  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <center>
                      <h4>"Formando líderes competitivos para el futuro"</h4>
                    </center>
                  </div>
                </div>
            </header>

            <!-- ================================================================================================ -->
              
            <!-- FOOTER - (PIÉ DE PÁGINA, DE LyTA) -->
            <div class="container">
              <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" class="py-5">
                  <div class="row">
                    <div class="col-2">
                      <h5>Institución</h5>
                      <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Inicios</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Mision</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Visión</a></li>
                      </ul>
                    </div>
              
                    <div class="col-3">
                      <h5>Políticas de privacidad</h5>
                      <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Estudiantes</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Sdministrativos</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Docentes</a></li>
                      </ul>
                    </div>
              
                    <div class="col-2">
                      <h5>Otros</h5>
                      <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Campus</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Pagos</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Garantías</a></li>
                      </ul>  
                    </div>
                    
              
                    <div class="col-4 offset-1">
                      <form>
                        <h5>Introduce, si ya leíste</h5>
                        <p>Nos aseguramos que leas y estés al tanto de nuestras políticas</p>
                        <div class="d-flex w-100 gap-2">
                          <label for="newsletter1" class="visually-hidden">Correo...</label>
                          <input id="newsletter1" type="text" class="form-control" placeholder="Correo...">
                          <button class="btn btn-primary" type="button">Enviar</button>
                        </div>
                      </form>
                    </div>
                  </div>

                  <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li>
                      <a href="https://web.facebook.com/MANOSAMORYSEMILLA" class="nav-link text-white"><img src="img/Icon_face.png" width="35px"></a>
                    </li>
  
                    <li>
                      <a href="https://www.instagram.com/luzytecnoaccess/?hl=es-la"class="nav-link text-white"><img src="img/Icon_insta.png" width="40px"></a>
                    </li> 
                  </ul>           
            
                <div class="d-flex justify-content-between py-4 my-4 border-top">
                  <p> Colombia, para Cristo</p>
                </div>

                <div class="d-flex justify-content-between py-4 my-4 border-top">
                  <p> "Formando líderes competitivos para el futuro"</p>
                </div>

                <!-- CHAT FLOTANTE -->
                <script type="text/javascript">
                  (function () {
                      var options = {
                          facebook: "100063690034538", // Facebook page ID
                          whatsapp: "+57 3126901519", // WhatsApp number
                          call_to_action: "Hablemos...!", // Call to action
                          button_color: "#FF6550", // Color of button
                          position: "right", // Position may be 'right' or 'left'
                          order: "whatsapp,facebook", // Order of buttons
                      };
                      var proto = 'https:', host = "getbutton.io", url = proto + '//static.' + host;
                      var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
                      s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
                      var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
                  })();
              </script>

              
              </footer>
            </div>
              
        </main>

        <!-- ==================================================================================================== -->

        <!-- JS - (ANIMACIONES...., DE LyTA) -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            
    </body>

</html>