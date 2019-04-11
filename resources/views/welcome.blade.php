@extends('layouts.app')

@section('header')
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,400i,500" rel="stylesheet">
    <link href="assets/css/socicon.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/entypo.css" rel="stylesheet" type="text/css" media="all" />
    <link href="assets/css/theme.css" rel="stylesheet" type="text/css" media="all" />
    @endsection

    @section('content')
        <div class="main-container">
         <section class="space-lg bg-white">
             <div class="container">
                 <div class="row align-items-center justify-content-around">
                     <div class="col-12 col-md-6 col-lg-5 text-center text-md-left section-intro">
                         <h1 class="display-3">We Have Build The Best Solution</h1>
                         <span class="lead">

              </span>
                         @guest
                             <a href="{{route('organizer.create')}}" class="btn btn-success btn-lg">Get Started</a>
                         @else
                             @if(Auth::user()->is_operator)
                                 <a class="btn btn-success btn-lg" href="{{route('organizer.dashboard')}}">My Dashboard</a>
                             @elseif(Auth::user()->is_agent)
                                 <a class="btn btn-success btn-lg" href="{{route('agent.dashboard')}}">My Dashboard</a>
                             @else
                                 <a class="btn btn-success btn-lg" href="{{route('organizer.create')}}">Get Started</a>
                             @endif
                         @endif
                     </div>
                     <!--end of col-->
                     <div class="col-12 col-md-6 col-lg-6">
                         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                             <ol class="carousel-indicators">
                                 <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                 <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                             </ol>
                             <div class="carousel-inner">
                                 <div class="carousel-item active">
                                     <img class="d-block w-100" src="https://i.ibb.co/Vq2TY2N/Digilotto-02.png" alt="First slide">
                                 </div>
                                 <div class="carousel-item">
                                     <img class="d-block w-100" src="https://i.ibb.co/f2V5fJq/image.png" alt="Second slide">
                                 </div>
                             </div>
                             <a class="carousel-control-prev text-success" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                 <span class="sr-only">Previous</span>
                             </a>
                             <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                 <span class="sr-only">Next</span>
                             </a>
                         </div>
                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
             </div>
             <!--end of container-->
         </section>
         <!--end of section-->
         <section class="flush-with-above bg-white">
             <div class="container">
                 <div class="row">
                     <div class="col-12 text-center">
                         <h4>Used by designers from these great companies</h4>
                         <ul class="list-inline list-inline-large">
                             <li class="list-inline-item">
                                 <img alt="Image" class="logo" src="assets/img/logo-paypal.png">
                             </li>
                             <li class="list-inline-item">
                                 <img alt="Image" class="logo" src="assets/img/logo-slack.png">
                             </li>
                             <li class="list-inline-item">
                                 <img alt="Image" class="logo" src="assets/img/logo-invision.png">
                             </li>
                             <li class="list-inline-item">
                                 <img alt="Image" class="logo" src="assets/img/logo-intercom.png">
                             </li>
                         </ul>
                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
             </div>
             <!--end of container-->
         </section>
         <!--end of section-->
         <section>
             <div class="container">
                 <div class="row justify-content-center text-center section-intro">
                     <div class="col-12 col-md-9 col-lg-8">
                         <span class="title-decorative">Welcome Home</span>
                         <h2 class="display-4">Greatly simplified workflow</h2>
                         <span class="lead">An opportunity to introduce the major benefits of your product and set the scene for what's to come</span>

                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
                 <div class="row justify-content-around">

                     <div class="col-12 col-lg-6 mb-4">
                         <div class="tab-content">
                             <div class="tab-pane fade show active" id="content-1" role="tabpanel">
                                 <img alt="Image" class="img-fluid w-100" src="assets/img/graphic-bike.svg">
                             </div>
                             <div class="tab-pane fade" id="content-2" role="tabpanel">
                                 <img alt="Image" class="img-fluid w-100" src="assets/img/graphic-phone-actions.svg">
                             </div>
                             <div class="tab-pane fade" id="content-3" role="tabpanel">
                                 <img alt="Image" class="img-fluid w-100" src="assets/img/graphic-imac-interface.svg">
                             </div>
                         </div>
                     </div>
                     <!--end of col-->
                     <div class="col-lg-5 col-md-8">
                         <ul class="nav nav-cards" role="tablist">
                             <li>
                                 <a class="card active" data-toggle="tab" href="#content-1" role="tab" aria-controls="content-1" aria-selected="true">
                                     <div class="card-body">
                                         <h5>Armed and Fabulous</h5>
                                         <p>
                                             A self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences.
                                         </p>
                                     </div>
                                 </a>
                             </li>
                             <li>
                                 <a class="card" data-toggle="tab" href="#content-2" role="tab" aria-controls="content-2" aria-selected="false">
                                     <div class="card-body">
                                         <h5>Content First</h5>
                                         <p>
                                             A paragraph, from the Greek paragraphos is a self-contained unit of a discourse in writing dealing with a particular point or idea.
                                         </p>
                                     </div>
                                 </a>
                             </li>
                             <li>
                                 <a class="card" data-toggle="tab" href="#content-3" role="tab" aria-controls="content-3" aria-selected="false">
                                     <div class="card-body">
                                         <h5>All in one place</h5>
                                         <p>
                                             A self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences.
                                         </p>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
             </div>
             <!--end of container-->
         </section>
         <!--end of section-->
         <section>
             <div class="container">
                 <div class="row justify-content-center text-center section-intro">
                     <div class="col-12 col-md-9 col-lg-8">
                         <span class="title-decorative">Light On Fuss</span>
                         <h2 class="display-4">Heavy on swish looks</h2>
                         <span class="lead">An opportunity to introduce the major benefits of your product and set the scene for what's to come</span>

                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
                 <div class="row justify-content-around">
                     <div class="col-12 col-md-6 col-lg-5">
                         <i class="text-teal h1 icon-fingerprint"></i>
                         <h5>Take it widescreen</h5>
                         <p>
                             A self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences.
                         </p>
                         <div class="card">
                             <ul class="list-group list-group-flush">
                                 <li class="list-group-item">
                                     <div class="media">
                                         <i class="icon-hand mr-2"></i>
                                         <div class="media-body">
                                             <h6>Media</h6>
                                             <p>
                                                 A short description of the aforementioned facet to easily digest. No need to divulge too much information in this text area.
                                             </p>
                                         </div>
                                     </div>
                                 </li>
                                 <li class="list-group-item">
                                     <div class="media">
                                         <i class="icon-layers mr-2"></i>
                                         <div class="media-body">
                                             <h6>Cards</h6>
                                             <p>
                                                 Another brief description of a facet that, as before, doesn't need to go into great detail.
                                             </p>
                                         </div>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                     </div>
                     <!--end of col-->
                     <div class="col-12 col-md-6 col-lg-5">
                         <i class="text-purple h1 icon-tablet-mobile-combo"></i>
                         <h5>Forget compromise</h5>
                         <p>
                             A self-contained unit of a discourse in writing dealing with a particular point or idea. A paragraph consists of one or more sentences.
                         </p>
                         <div class="card">
                             <ul class="list-group list-group-flush">
                                 <li class="list-group-item">
                                     <div class="media">
                                         <i class="icon-credit-card mr-2"></i>
                                         <div class="media-body">
                                             <h6>Payment</h6>
                                             <p>
                                                 A short description of the aforementioned facet to easily digest. No need to divulge too much information in this text area.
                                             </p>
                                         </div>
                                     </div>
                                 </li>
                                 <li class="list-group-item">
                                     <div class="media">
                                         <i class="icon-game-controller mr-2"></i>
                                         <div class="media-body">
                                             <h6>Collaboration</h6>
                                             <p>
                                                 Another brief description of a facet that, as before, doesn't need to go into great detail.
                                             </p>
                                         </div>
                                     </div>
                                 </li>
                             </ul>
                         </div>
                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
                 <div class="row justify-content-center text-center section-outro">
                     <div class="col-lg-4 col-md-5">
                         <h6>Introducing a new way</h6>
                         <p>An opportunity to introduce the major benefits of your product and set the scene for what's to come</p>
                         <a href="#">View more features ›</a>
                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
             </div>
             <!--end of container-->
         </section>
         <!--end of section-->

         <section class="bg-dark">
             <div class="container">
                 <div class="row section-intro">
                     <div class="col-12 text-center">
                         <h3 class="h1">Don’t even wait, sign up now for a 30 day trial.</h3>
                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
                 <div class="row justify-content-center">

                     <div class="col-12 col-md-6 col-lg-5">
                         <div class="media">
                             <img alt="Image" src="assets/img/avatar-male-1.jpg" class="avatar">
                             <div class="media-body">
                                 <p class="mb-1">
                                     “Let’s get one thing straight, this theme’s a straight-up winner. No posers here, just beautiful design and code.”
                                 </p>
                                 <small>Daniel Cameron</small>
                             </div>
                         </div>
                     </div>
                     <!--end of col-->

                     <div class="col-12 col-md-6 col-lg-5">
                         <div class="media">
                             <img alt="Image" src="assets/img/avatar-female-1.jpg" class="avatar">
                             <div class="media-body">
                                 <p class="mb-1">
                                     “With Wingman, we were able to turn out a stunning landing page and compelling MVP for our SaaS web app in no time.”
                                 </p>
                                 <small>Caitlyn Halsy, Bench</small>
                             </div>
                         </div>
                     </div>
                     <!--end of col-->

                 </div>
                 <!--end of row-->
             </div>
             <!--end of container-->
         </section>
         <!--end of section-->
         <footer class="bg-gray text-light footer-long">
             <div class="container">
                 <div class="row">
                     <div class="col-12 col-md-3">

                         <p class="text-muted">
                             © 2019 DigiLotto
                         </p>
                     </div>
                     <!--end of col-->
                     <div class="col-12 col-md-9">

                         <div class="row no-gutters">
                             <div class="col-6 col-lg-3">
                                 <h6>Navigate</h6>
                                 <ul class="list-unstyled">
                                     <li>
                                         <a href="index.html">Overview</a>
                                     </li>
                                     <li>
                                         <a href="pages-landing.html">Landing Pages</a>
                                     </li>
                                     <li>
                                         <a href="pages-app.html">App Pages</a>
                                     </li>
                                     <li>
                                         <a href="pages-inner.html">Inner Pages</a>
                                     </li>
                                 </ul>
                             </div>
                             <!--end of col-->
                             <div class="col-6 col-lg-3">
                                 <h6>Platform</h6>
                                 <ul class="list-unstyled">
                                     <li>
                                         <a href="#">Mac OS &amp; iOS</a>
                                     </li>
                                     <li>
                                         <a href="#">Android &amp; Chrome OS</a>
                                     </li>
                                     <li>
                                         <a href="#">Windows</a>
                                     </li>
                                     <li>
                                         <a href="#">Linux</a>
                                     </li>
                                 </ul>
                             </div>
                             <!--end of col-->
                             <div class="col-6 col-lg-3">
                                 <h6>Community</h6>
                                 <ul class="list-unstyled">
                                     <li>
                                         <a href="#">Forum</a>
                                     </li>
                                     <li>
                                         <a href="#">Knowledgebase</a>
                                     </li>
                                     <li>
                                         <a href="#">Hire an expert</a>
                                     </li>
                                     <li>
                                         <a href="#">FAQ</a>
                                     </li>
                                     <li>
                                         <a href="#">Contact</a>
                                     </li>
                                 </ul>
                             </div>
                             <!--end of col-->
                             <div class="col-6 col-lg-3">
                                 <h6>Company</h6>
                                 <ul class="list-unstyled">
                                     <li>
                                         <a href="#">About company</a>
                                     </li>
                                     <li>
                                         <a href="#">History</a>
                                     </li>
                                     <li>
                                         <a href="#">Team</a>
                                     </li>
                                     <li>
                                         <a href="#">Investment</a>
                                     </li>
                                 </ul>
                             </div>
                             <!--end of col-->
                         </div>
                         <!--end of row-->
                     </div>
                     <!--end of col-->
                 </div>
                 <!--end of row-->
             </div>
             <!--end of container-->
         </footer>
     </div>

@endsection

@section('footer')
    <script type="text/javascript" src="../code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script type="text/javascript" src="../unpkg.com/smartwizard%404.3.1/dist/js/jquery.smartWizard.js"></script>
    <script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/flickity/2.1.2/flickity.pkgd.min.js"></script>
    <script type="text/javascript" src="../unpkg.com/scrollmonitor%401.2.4/scrollMonitor.js"></script>
    <script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/smooth-scroll/12.1.5/js/smooth-scroll.polyfills.min.js"></script>
    <script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/prism/1.15.0/prism.min.js"></script>
    <script type="text/javascript" src="../unpkg.com/zoom-vanilla.js%402.0.6/dist/zoom-vanilla.min.js"></script>
    <script type="text/javascript" src="../cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/theme.js"></script>
@endsection
