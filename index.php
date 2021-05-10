<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/style_index.css">
    <link  rel = "icon"  type = "image/png" size = "180x180"  href = "assets/img/icon-180x180.png">
    <title>Tribos | Conecte-se</title>
</head>
<body>
    <header id="home">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container">
                <img class="logo" src="assets/img/logoTribosSemFundo.png" alt="Logo" id="logo">
                <span class="navbar-brand" href="index.html">Tribos</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/inicio.php">Explorar</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="pages/formLogin.php">Conecte-se</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="pages/formUsuario.php">Cadastre-se</a>
                        </li>

                    </ul>
                    <ul class="social-icon ml-lg-5">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="banner d-flex flex-column justify-content-center align-items-center">
        <div class="bg-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto col-12">
                        <section class="site-title">
                            <div class="site-background" data-aos="fade-up" data-aos-delay="100">
                                <h6 data-aos="fade-up" data-aos-delay="300">Somos a Tribos, uma plataforma feita para
                                    unir pessoas</h6>
                                <h1 class="text-white title-main" data-aos="fade-up" data-aos-delay="500">Faça parte!</h1>

                                <a href="front/explorar.php" class="btn custom-btn bordered mt-3" data-aos="fade-up"
                                    data-aos-delay="700">Veja mais</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="aboutTribos" id="aboutTribos">
        <div class="container">
            <h3 data-aos="fade-up" data-aos-delay="300" class="title-section">Sobre nós</h3>
            <span class="resumo" data-aos="fade-up" data-aos-delay="400">A Tribos foi idealizada para contribuir no âmbito da socialização. Nosso principal
                objetivo é <strong>unir</strong> pessoas! </br> Desenvolvemos um ambiente virtual propício para que
                você possa conhecer pessoas e compartilhar experiências.
            </span>
            <h3 data-aos="fade-up" data-aos-delay="300" class="title-section">Nossa plataforma</h3 data-aos="fade-up" data-aos-delay="300">
            <span class="plataforma" data-aos="fade-up" data-aos-delay="400">Com a Tribos <strong>você</strong> é capaz de descobir, criar e gerenciar eventos
                de diversos tipos. Participar de grupos ou como chamamos </br> tribos, formado por pessoas com as quais
                você pode ter afinidade. Em atividades, como prática de esportes, trilhas em parques ecológicos, visitas
                a museus, ingressão em palestras, idas a shows, igrejas, restaurantes e muito mais.
            </span>
        </div>
    </section>
    <div class="content">
    </div>
    <footer id="myFooter">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-delay="300">
                <div class="col-sm-3">
                    <h2><a href="#logo"> 
                        <img class="logo-rodape" src="assets/img/logoTribosSemFundo.png" alt="Logo"> </a>
                    </h2>
                </div>
                <div class="col-sm-2">
                    <h5>Inicio</h5>
                    <ol>
                        <li><a href="#home">Home</a></li>
                    </ol>
                </div>
                <div class="col-sm-2">
                    <h5>Sobre-nós</h5>
                    <ol>
                        <li><a href="#aboutTribos">Informações da Empresa</a></li>
                    </ol>
                </div>
                <div class="col-sm-2">
                    <h5>Suporte</h5>
                    <ol>
                        <li><a href="mailto:8bitstribos@gmail.com">E-mail</a></li>
                    </ol>
                </div>
                <div class="col-sm-3">
                    <div class="social-networks">
                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                    </div>
                    <a href="#">
                        <button type="button" class="btn btn-default">Contato</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>© 2021 Copyright - Tribos </p>
        </div>
    </footer>
    <!-- SCRIPTS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>