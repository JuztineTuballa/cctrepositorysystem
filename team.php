<?php
//CODE TO PREVENT UNNECESSARY TEXT IN URL
$url = explode('/', $_SERVER['REQUEST_URI']);
$page = end($url);
if (strpos($page, '?') !== false) {
    $page = substr($page, 0, strpos($page, '?'));
}
if (strpos($page, '.') !== false) {
    $page = substr($page, 0, strpos($page, '.'));
}
if ($page != basename($_SERVER['SCRIPT_FILENAME'], '.php')) {
    header('Location: /cctrepositorysystem/team.php');
    exit();
}
//END - CODE TO PREVENT UNNECESSARY TEXT IN URL
?>



<?php
include "includes/team-header.php";
?>

<link rel="stylesheet" href="css/meetourteam.css"/>

<body>
  
<!--SPACING-->
<section class="mt-3 pt-3 pb-3">
</section>
<!--END SPACING-->
 
<!--START HEADER-->
<header class="bg-headerimage py-5" style="padding-top: 100px !important; padding-bottom: 60px; padding-left: 30px; padding-right: 30px;">
  <div class="container px-5">
    <div class="row gx-5 justify-content-center">
      <div class="col-lg-7">
        <div class="text-center my-5">
          <h1 class="display-6 fw-bolder text-white mb-5">About</h1>
        </div>
      </div>
    </div>
  </div>
</header>
<!--END HEADER-->

<!--YOUTUBE VIDEO OF OUR CAPSTONE-->
<section class="py-5" style="background-color:#f2f0f0;">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/uBlcelcg7f0?" allowfullscreen></iframe>
        </div>
      </div>
      <div class="col-md-6 pt-4 pt-md-0 d-flex align-items-center">
        <div>
          <h2 class="display-6 fw-bold mb-5" style="color: #4B4E4E;">About Our System</h2>
          <p style="font-size: 1.1rem; line-height: 1.8; color: #555555;">The system is exclusive for City College of Tagaytay only. It is designed to help the institution to easily store research output and reduce the amount of time in searching related study.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!--END - YOUTUBE VIDEO OF OUR CAPSTONE-->

<div class="container">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" integrity="sha512-W3ZfgmZ5g1rCPFiCbOb+tn7g7sQWOQCB1AkDqrBG1Yp3iDjY9KYFh/k1AWxrt85LX5BRazEAuv+5DV2YZwghag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <section class="team-section py-5">
     
    
    <BR><h2 class="text-center" style="color: #4B4E4E;">Meet Our Team</h2><BR><BR>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6">
          <div class="card border-0 shadow-lg pt-5 my-5 position-relative">
            <div class="card-body p-4">
              <div class="member-profile position-absolute w-100 text-center">
                  <img class="rounded-circle mx-auto d-inline-block shadow-sm" src="img/team-image1.jpg" alt="">
                </div>
              <div class="card-text pt-1">
                <h5 class="member-name mb-0 text-center text-primary font-weight-bold">Juztine Tuballa</h5>
                <div class="mb-3 text-center">Programmer / Member</div>
                <div class="text-center">"Life is short, always choose happiness."</div>
              </div>
            </div><!--//card-body-->
            <div class="card-footer theme-bg-primary border-0 text-center">
              <ul class="social-list list-inline mb-0 mx-auto">
                <li class="list-inline-item"><a class="text-dark" href="https://www.linkedin.com/in/ijuztine/" target="blank"><svg class="svg-inline--fa fa-linkedin-in fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="linkedin-in" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"></path></svg><!-- <i class="fab fa-linkedin-in fa-fw"></i> Font Awesome fontawesome.com --></a></li>
               
                <li class="list-inline-item"><a class="text-dark" href="https://github.com/JuztineTuballa" target="blank"><svg class="svg-inline--fa fa-github fa-w-16 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="github" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512" data-fa-i2svg=""><path fill="currentColor" d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"></path></svg><!-- <i class="fab fa-github fa-fw"></i> Font Awesome fontawesome.com --></a></li>
                
                <li class="list-inline-item"><a class="text-dark" href="https://www.instagram.com/ijuztine/" target="blank"><svg class="svg-inline--fa fa-instagram fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg><!-- <i class="fab fa-instagram fa-fw"></i> Font Awesome fontawesome.com --></a></li>
                      
                  </ul><!--//social-list-->
            </div><!--//card-footer-->
          </div><!--//card-->
        </div><!--//col-->
        
        <div class="col-12 col-md-6">
          <div class="card border-0 shadow-lg pt-5 my-5 position-relative">
            <div class="card-body p-4">
              <div class="member-profile position-absolute w-100 text-center">
                  <img class="rounded-circle mx-auto d-inline-block shadow-sm" src="img/team-image2.jpg" alt="">
                </div>
              <div class="card-text pt-1">
                <h5 class="member-name mb-0 text-center text-primary font-weight-bold">Monica Nuestro</h5>
                <div class="mb-3 text-center">Documentation / Member</div>
                <div class="text-center">“You deserve what you tolerate.”</div>
              </div>
            </div><!--//card-body-->
            <div class="card-footer theme-bg-primary border-0 text-center">
              <ul class="social-list list-inline mb-0 mx-auto">

                <li class="list-inline-item"><a class="text-dark" href="https://www.instagram.com/monxxanstr_/" target="blank"><svg class="svg-inline--fa fa-instagram fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg><!-- <i class="fab fa-instagram fa-fw"></i> Font Awesome fontawesome.com --></a></li>
                                       
                <li class="list-inline-item"><a class="text-dark" href="https://twitter.com/niirvaaaana" target="blank"><svg class="svg-inline--fa fa-twitter fa-w-16 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <i class="fab fa-twitter fa-fw"></i> Font Awesome fontawesome.com --></a></li>

        
                  </ul><!--//social-list-->
            </div><!--//card-footer-->
          </div><!--//card-->
        </div><!--//col-->
        
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-0 shadow-lg pt-5 my-5 position-relative">
            <div class="card-body p-4">
              <div class="member-profile position-absolute w-100 text-center">
                  <img class="rounded-circle mx-auto d-inline-block shadow-sm" src="img/team-image4.jpg" alt="">
                </div>
              <div class="card-text pt-1">
                <h5 class="member-name mb-0 text-center text-primary font-weight-bold">Mary Lou Viscaya</h5>
                <div class="mb-3 text-center">Documentation / Member</div>
                <div class="text-center">"No pain, no gain."</div>
              </div>
            </div><!--//card-body-->
            <div class="card-footer theme-bg-primary border-0 text-center">
              <ul class="social-list list-inline mb-0 mx-auto">
                
                 <li class="list-inline-item"><a class="text-dark" href="https://www.facebook.com/mlvscyskz" target="blank"><svg class="svg-inline--fa fa-facebook-f fa-w-10 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path></svg><!-- <i class="fab fa-facebook-f fa-fw"></i> Font Awesome fontawesome.com --></a></li>
              
                  </ul><!--//social-list-->
            </div><!--//card-footer-->
          </div><!--//card-->
        </div><!--//col-->
        
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-0 shadow-lg pt-5 my-5 position-relative">
            <div class="card-body p-4">
              <div class="member-profile position-absolute w-100 text-center">
                  <img class="rounded-circle mx-auto d-inline-block shadow-sm" src="img/team-image3.jpg" alt="">
                </div>
              <div class="card-text pt-1">
                <h5 class="member-name mb-0 text-center text-primary font-weight-bold">Babylynn Vida</h5>
                <div class="mb-3 text-center">Documentation / Member</div>
                <div class="text-center">“We will get there in time.”</div>
              </div>
            </div><!--//card-body-->
            <div class="card-footer theme-bg-primary border-0 text-center">
              <ul class="social-list list-inline mb-0 mx-auto">
                    <li class="list-inline-item"><a class="text-dark" href="https://www.instagram.com/babylynn.vida_/" target="blank"><svg class="svg-inline--fa fa-instagram fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg><!-- <i class="fab fa-instagram fa-fw"></i> Font Awesome fontawesome.com --></a></li>

                    <li class="list-inline-item"><a class="text-dark" href="https://twitter.com/babylynnvida" target="blank"><svg class="svg-inline--fa fa-twitter fa-w-16 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path></svg><!-- <i class="fab fa-twitter fa-fw"></i> Font Awesome fontawesome.com --></a></li>
                  
                  </ul><!--//social-list-->
            </div><!--//card-footer-->
          </div><!--//card-->
        </div><!--//col-->
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card border-0 shadow-lg pt-5 my-5 position-relative">
            <div class="card-body p-4">
              <div class="member-profile position-absolute w-100 text-center">
                  <img class="rounded-circle mx-auto d-inline-block shadow-sm" src="img/team-image5.png" alt="">
                </div>
              <div class="card-text pt-1">
                <h5 class="member-name mb-0 text-center text-primary font-weight-bold">Rhieno Ronquillo</h5>
                <div class="mb-3 text-center">Documentation / Member</div>
                <div class="text-center">“Time is Gold.”</div>
              </div>
            </div><!--//card-body-->
            <div class="card-footer theme-bg-primary border-0 text-center">
              <ul class="social-list list-inline mb-0 mx-auto">
                    <li class="list-inline-item"><a class="text-dark" href="https://www.instagram.com/renoamorre/" target="blank"><svg class="svg-inline--fa fa-instagram fa-w-14 fa-fw" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg><!-- <i class="fab fa-instagram fa-fw"></i> Font Awesome fontawesome.com --></a></li>
                   
                  </ul><!--//social-list-->
            </div><!--//card-footer-->
          </div><!--//card-->
        </div><!--//col-->
       

      </div><!--//row-->
      
    </div>
    
  </section>
   
  </div>
  <BR/><BR/>

<iframe style="width:100%;height:400px; border:0px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30956.719680349444!2d120.90049624443061!3d14.101366039444587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd779f718e18bd%3A0xfb8d756cd37578df!2sCity%20College%20of%20Tagaytay!5e0!3m2!1sen!2sph!4v1682071734662!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
 

<?php
  include 'includes/team-footer.php';
?>

<script>
  function myFunction() {
    var x = document.getElementById("jsmyInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>



