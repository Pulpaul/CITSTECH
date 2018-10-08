<?php
include('php/login.php'); 
?>   
  <html>
    <title> CITS </title> 
    <head> 

      <link rel="icon" href="img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="css/font-awesome.css"> 
      <link type="text/css" rel="stylesheet" href="css/material-kit.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/styles.css"> 
       
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style type="text/css">
        body{
          color: white;
        }
        .title{
          color: white;
        } 
      </style>
      </head>
    <body class="index-page sidebar-collapse">
      
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg bg-white" color-on-scroll="100"  id="sectionsNav">
    <div class="container-fluid">
      <div class="navbar-translate">
        <div class="navbar-brand" href="index.php">
         <img src="img/logocits.png" class="navbar-icon"></img> </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" data-scroll href="#home">
              <i class="fa fa-home"></i> Home 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" data-scroll href="#about">
             <i class="fa fa-info-circle"></i> About 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" data-scroll href="#services">
             <i class="fa fa-wrench"></i> Services
            </a>
          </li>
          <li class="nav-item"> 
              <button class="btn btn-danger btn-round btn-regular" data-toggle="modal" data-target="#loginModal"> <i class="fa fa-sign-in"></i> Log In  </button> 
          </li> 
        </ul>
      </div>
    </div>
  </nav>

  <div class="page-header header-filter" data-parallax="true">
    <img src="img/citsbg.jpg">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">
           
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" style="margin-top: -5%">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="card card-login">
            <form class="form" method="post" action="index.php"  id="landing" onsubmit="return required()">
              <div class="card-header card-header-danger text-center"> 
                <div class="social-line">
                  <img src="img/logocits.png"> 
                </div>
              </div>
              <h3 class="text-center"> <i class="fa fa-user"></i> LOG IN</h3>
              <div class="card-body"> 
                  <div class="text-center"> 
                  <?php echo $user_email_status; ?><?php echo $user_email; ?><span id="errorEmail"></span>
                  </div> 
                <div class="input-group"> 
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-google-plus"></i>
                    </span>
                  </div>
                  <input type="email" id="email" class="form-control" placeholder="Input G-mail Address" name="user_email" >  
                </div>
                <div class="text-center">  
                  <?php echo $user_password; ?><span id="errorPassword"></span>
                  </div> 
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fa fa-lock"></i>
                    </span>
                  </div>
                  <input type="password" id="password" class="form-control" placeholder="Input Password" name="user_password" id="password" >
                </div>
                <div class="footer">
                  <div class="form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" value="" onclick="myFunction()"> Show Password
                  <span class="form-check-sign">
                    <span class="check"></span>
                  </span>
                </label>
                <button type="submit" name="login" class="btn btn-danger btn-round" style="left: 190px;"> <i class=" fa fa-sign-in"></i> LOG IN</button> 
              </div> 
                </div>  
                </div>
                
            </form>     
        </div> 
      <div class="card-footer" style="background-color: #EEE;">
        <div class="float-right">
          <a href="forgotPassword.php" class="btn btn-danger btn-link text-dark">Forgot Password?</a>
        </div>
        <div class="float-left"> 
          <a href="signup.php" class="btn btn-danger btn-link text-dark"> Sign Up!</a>
        </div>
      </div>
      </div>
    </div>
    </div>

    <div class="main main-raised" style="background: linear-gradient(darkred, lightcoral,firebrick);">
      <div class="container-fluid">
        <div id="home">
          <br />
          <h2 class="title text-center"> <i class="fa fa-home"></i> HOME </h2>
            <div class="progress progress-line-white col-md-5 mr-auto ml-auto">
            <div class="progress-bar progress-bar-danger bg-white" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> 
            </div>
            </div>
            The Competitive I.T Solutions Inc newest Online Technical Support System is now available online. The Technical Support System is focused on providing solutions that can give help to the users technology problems. These technical problems includes Technical Support, Network Infrustructure, and Comprehensive Cabling.
            <div class="row">
              <div class="col-md-5">
                <br>
                <br>
                <br>  
                <div class="form-group"> 
                    <i class="fa fa-wrench" style="font-size: 30px; color: "></i> Technical Support   
                    <p>
                      Provides Service to Support and Maintain Desktop and Peripherals, Server Farm,  Network Communication Equipment, Network Sercurity Devices, Multiple Platform Systems
                    </p>
                </div>
                <div class="form-group">
                  <i class="fa fa-sitemap" style="font-size: 30px; color: "></i> Network Infrastructure
                  <p>
                      Evaluates and Analyzes Business Requirements and comes up with several Network Solutions
                    </p>
                </div>
                <div class="form-group">
                  <i class="fa fa-server" style="font-size: 30px;"></i> Comprehensive Cabling
                  <p>
                      Provides Cabling Solutions,  PABX, Security Systems, Audio, Video Systems
                    </p>
                </div>
              </div>
              <div class="col-md-7 mr-auto ml-auto"> 
                <div class="section" id="carousel">
                  <div class="card card-raised card-carousel">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="img/technical.jpg" alt="First slide" style="height: 60vh;">
                          <div class="carousel-caption d-none d-md-block">
                            <h4>
                              <i class="fa fa-wrench"> </i> Technical Support 
                            </h4>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/network.png" alt="Second slide" style="height: 60vh;">
                          <div class="carousel-caption d-none d-md-block">
                            <h4>
                              <i class="fa fa-sitemap"> </i> Network Infrastructure
                            </h4>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="img/cables2.jpg" alt="Third slide" style="height: 60vh;">
                          <div class="carousel-caption d-none d-md-block">
                            <h4>
                              <i class="fa fa-server"> </i> Comprehensive Cabling
                            </h4>
                          </div>
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <i class="fa fa-arrow-circle-left" style="font-size: 50px;"></i>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <i class="fa fa-arrow-circle-right" style="font-size: 50px;"></i>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>  
                </div> 
              </div> 
        </div>
        <div id="about">
            <h2 class="title text-center"> <i class="fa fa-info-circle"></i> ABOUT</h2>
            <div class="progress progress-line-white col-md-5 mr-auto ml-auto">
            <div class="progress-bar progress-bar-danger bg-white" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> 
            </div>
            </div>  
            The Competitive I.T Solutions Inc newest Technical Support System is was developed to provide technical solutions to the concerns of the users. I't produces different solutions, ways, procedures  and techniques that will fill the user's needs.
            <div class="row"> 
                  <div class="col-md-4 text-center">
                    <br />
                    <div class="form-group">
                      <h1> <i class="fa fa-info-circle"></i> </h1>
                      <p>To give best solutions about the specific concern.
                      .</p> 
                    </div>
                  </div> 
                  <div class="col-md-4 text-center">
                    <br />
                    <div class="form-group">
                      <h1> <i class="fa fa-info-circle"></i> </h1>  
                      <p> To help other user's that are not quite familiar in the fields of technology.</p> 
                    </div>
                  </div> 
                  <div class="col-md-4 text-center">
                    <br />
                    <div class="form-group">
                      <h1> <i class="fa fa-info-circle"></i> </h1>  
                      <p> To widen the informations, preventions, and solutions so that dealing with technology problems will not be hard to fix.</p> 
                    </div>
                  </div> 
            </div> 
            
            </div>
            
        <div id="services">
          <h2 class="title text-center"> <i class="fa fa-wrench"></i> SERVICES </h2>
          <div class="progress progress-line-white col-md-5 mr-auto ml-auto">
          <div class="progress-bar progress-bar-danger bg-white" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> 
          </div>
          </div> 
            <div class="row">  
              <div class="col-md-6">
              <img src="img/concern.png" class="img-raised rounded img-fluid"> 
              </div> 
              <div class="col-md-6">
                <br /><br />
                <h3 class="title text-center"> <i class="fa fa-telegram"></i>  CONCERNS</h3>  
                <p class="text-center">
                  What's your concern? Send your technical concerns. The best way to ask techinical questions.
                </p>
              </div>   
              <div class="col-md-6">
                <br /><br /><br /> <br /><br />
                <h3 class="title text-center"> <i class="fa fa-android"></i>  CITS BOT</h3> 
                <p class="text-center">
                  CITS BOT is the easiest way to find solutions. CITS BOT can answer frequently ask questions or basic technical concerns.
                </p>
              </div>
              <div class="col-md-6">
                <br /><br /><br /><br />
                <img src="img/citsbot.png" class="img-raised rounded img-fluid">
              </div>
              <div class="col-md-6">
                <br /><br /><br /><br />
              <img src="img/forum.png" class="img-raised rounded img-fluid"> 
              </div> 
              <div class="col-md-6">
                <br /><br /><br /><br /><br />
                <h3 class="title text-center"> <i class="fa fa-stack-exchange"></i>  FORUMS </h3>  
                <p class="text-center">
                  Aims at adopting a broad dialogue with the support and the uers.
                </p>
              </div>   
            </div>
          </div>
        </div>
      </div>
      <br />
      <br /> 
    </div> 
    <div class="text-center">
      <a class="nav-link js-scroll-trigger" data-scroll href="#landing">
        <h1><button class="btn btn-danger btn-fab btn-round"><i class="fa fa-arrow-up" data-toggle="tooltip" title="Up"></i></button></h1>
      </a> 
    </div>

  <footer class="footer footer-default">
    <div class="container-fluid"> 
        <div class="text-center">
          <div class="copyright"> 
            <a href="https://cits.com.ph/" class="text-white">Competitive I.T. Solutions Inc.</a> 
          </div>
        </div>
      </div>
    </div>
  </footer>

      <script src="js/main/jquery.min.js" type="text/javascript"></script>
      <script src="js/main/popper.min.js" type="text/javascript"></script>
      <script src="js/main/bootstrap-material-design.min.js" type="text/javascript"></script>
      <script src="js/item/moment.min.js" type="text/javascript"></script>
      <script src="js/item/bootstrap-datetimepicker.js" type="text/javascript"></script>
      <script src="js/item/nouislider.min.js" type="text/javascript"></script>
      <script src="js/item/easing.min.js" type="text/javascript"></script>
      <script src="js/item/smoothscroll.js" type="text/javascript"></script>
      <script src="js/item/jquery.sharrre.js" type="text/javascript"></script>
      <script src="js/material-kit.js?v=2.0.4" type="text/javascript"></script>  
      <script src="js/function.js" type="text/javascript"></script>
      <script src="js/script.js" type="text/javascript"></script>
    </body>
  </html>