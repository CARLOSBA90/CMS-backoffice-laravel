@include('resources.frontend.header')

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        @foreach($seccions as $seccion)
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/{{$seccion->id}}">{{$seccion->nombre}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/banner.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <span class="subheading" id="sub_head"></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        <!-- Main Content ***-->
        <div class="container-fluid px-12 px-lg-12">
         <div class="row">
           <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    @foreach($recetas as $receta)
                        <div class="col-md-10 col-lg-10 col-xl-10">
                                                    <!-- Post preview-->
                                                   <div class="post-preview mhover">
                                                                <h3 class="post-title">{{$receta->nombre}} </h3> <sub>{{$receta->seccion}}</sub>
                                                                <br>
                                                                <span class="post-meta">
                                                                    {{$receta->resumen}}
                                                                    <br>
                                                                    Imagen?
                                                                    <br>
                                                                    {{substr($receta->fecha,0,10)}}
                                                                </span>
                                                            </div>
                                                    <!-- Divider-->
                                                <hr class="my-4" />
                                        <!-- Pager-->

                          </div>
                        @endforeach




                        <div class="d-flex justify-content-end mb-4">{{$recetas->links()}}</div>
                </div>
            </div>

           

           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="background-color:gainsboro"> 
               publicidad
            </div>

          </div>
        </div>


        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="https://www.instagram.com/ondadulcito/">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-instagram fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.instagram.com/ondadulcito/">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.instagram.com/ondadulcito/">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Onda Dulcito 2023</div>
                    </div>
                </div>
            </div>
        </footer>
    
@include('resources.frontend.footer_script')