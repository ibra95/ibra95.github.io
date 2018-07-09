<?php
require('connect.php');
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>

    <script src="bootstrab/js/jquery-3.3.1.min.js"></script>
    <script src="bootstrab/js/typeahead.js"></script>
    <link rel="stylesheet" href="bootstrab\css\bootstrap.min.css" >
    <script src="bootstrab/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>Cardoor - Car Rental HTML Template</title>
    <script src="bootstrab/js/jquery-3.3.1.min.js"></script>
    <!--=== Bootstrap CSS ===-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!--=== Vegas Min CSS ===-->
    <link href="assets/css/plugins/vegas.min.css" rel="stylesheet">
    <!--=== Slicknav CSS ===-->
    <link href="assets/css/plugins/slicknav.min.css" rel="stylesheet">
    <!--=== Magnific Popup CSS ===-->
    <link href="assets/css/plugins/magnific-popup.css" rel="stylesheet">
    <!--=== Owl Carousel CSS ===-->
    <link href="assets/css/plugins/owl.carousel.min.css" rel="stylesheet">
    <!--=== Gijgo CSS ===-->
    <link href="assets/css/plugins/gijgo.css" rel="stylesheet">
    <!--=== FontAwesome CSS ===-->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!--=== Theme Reset CSS ===-->
    <link href="assets/css/reset.css" rel="stylesheet">
    <!--=== Main Style CSS ===-->
        <link href="assets/css/responsive.css" rel="stylesheet">

    <!--=== Responsive CSS ===-->
    <link href="style.css" rel="stylesheet">
    <link href="stylesheet.css" rel="stylesheet">
    <script src="bootstrab/js/typeahead.js"></script>
    <link rel="stylesheet" href="bootstrab\css\bootstrap.min.css" >
    <script src="bootstrab/js/bootstrap.min.js"></script>

    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="loader-active">
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=1986774964918820&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
    <!--== Preloader Area Start ==-->
    <div class="preloader">
        <div class="preloader-spinner">
            <div class="loader-content">
                <img src="assets/img/preloader.gif" alt="JSOFT">
            </div>
        </div>
    </div>
    <!--== Preloader Area End ==-->

    <!--== Header Area Start ==-->
    <header id="header-area" class="fixed-top">



        <!--== Header Bottom Start ==-->
        <div id="header-bottom">
            <div class="container">
                <div class="row">
                    <!--== Logo Start ==-->
                    <div class="col-lg-4">
                        <a href="index.php" class="logo">
                                <img src='assets/img/car-logo.png'>
                        </a>
                    </div>
                    <!--== Logo End ==-->

                    <!--== Main Menu Start ==-->
                    <div class="col-lg-8 d-none d-xl-block">
                        <nav class="mainmenu alignright">
                            <ul>
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="services.html">services</a></li>
]                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!--== Main Menu End ==-->
                </div>
            </div>
        </div>
        <!--== Header Bottom End ==-->
    </header>
    <!--== Header Area End ==-->

    <!--== SlideshowBg Area Start ==-->
    <section id="slideslow-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="slideshowcontent">
                        <div class="display-table">
                            <div class="display-table-cell">
                              <img src='assets/img/car-logo.png'>
                                <p style="font-size: 33px;">The Easiest way to Reach your Distinations!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="book-ur-car">
         <form action="index.php" method="POST" >
                   <select id ='options' name='options' class='form-fields' onchange="myFunction();">
                    <option value='0' >Pick Type</option>
                    <option value="1" selected >train</option>
                    <option value="2">bus</option>
                    <option value="3">superjet</option>
                  </select>
                  <input  autocomplete='off' class='typeahead form-fields'  type="text"  placeholder="From" name="currentloc" >
                  <input autocomplete='off' class='typeahead form-fields' type="text"  placeholder="To" name="requiredloc" >
                  <button class="button" name='search'>Search</button>
                 <?php echo $CurrentLocationError; ?>

                                    </form>
                                 </div>
  <script>
     function myFunction() { //return diffrent values with different select options
     var option = document.getElementById("options").value;
     if (option==1){
         typeahead ='typeahead-train.php';
       }
       else if (option ==2){
        typeahead ='typeahead-publiccairo.php';
       }
       else if (option ==3){
        typeahead ='typeahead-superjet.php';
       }
       window.typeahead=typeahead;
      return typeahead;
    }
        $('input.typeahead').typeahead({
    source:  function (query, process) {
    return $.get(myFunction(), { query: query }, function (data) {
            console.log(data);
            data = $.parseJSON(data);
            return process(data);
        });
       }
    });
</script>

    <!--== SlideshowBg Area End ==-->
<?php
if(isset($_POST['search'])){
if($SelectedOption=='1'){
    include('search-train.php');
}elseif($SelectedOption=='2')
{
  include('search-publiccairo.php');
}
elseif($SelectedOption=='3')
{
  include('search-Superjet.php');
}
}
?>




    <!--== Footer Area Start ==-->
    <section id="footer-area">
            <!-- Footer Widget Start -->
            <div class="footer-widget-area">
                <div class="container">
                    <div class="row">
                        <!-- Single Footer Widget Start -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-footer-widget">
                                <h2>About Us</h2>
                                <div class="widget-body">
                                        <img src='assets/img/car-logo.png'>                                <p>Muslate,is website created with ateam from faculty of electronic enginneering , to help
                                        egyptians find the easiest and fast routes to there distinations ,way you can find our android app in
                                    google play store right <A href='#'>here</A></p>

                                    <div class="newsletter-area">
                                        <form action="index.html">
                                            <input type="email" placeholder="Subscribe Our Newsletter">
                                            <button type="submit" class="newsletter-btn"><i class="fa fa-send"></i></button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Single Footer Widget End -->




                        <!-- Single Footer Widget Start -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-footer-widget">
                                <h2>Project Team Members</h2>
                                <div class="widget-body">
                                    <ul class="recent-post">
                                        <li>
                                            <a href="#">
                                               Ibrahim Abdullah
                                               <i class="fa fa-long-arrow-right"></i>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                              Ahmed Gaber
                                               <i class="fa fa-long-arrow-right"></i>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                               Ahmed eljindi
                                               <i class="fa fa-long-arrow-right"></i>
                                           </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                abdelhakeem qassem
                                               <i class="fa fa-long-arrow-right"></i>
                                           </a>
                                        </li>
                                        <li>
                                                <a href="#">
                                                  Abdelrahman Qabel
                                                   <i class="fa fa-long-arrow-right"></i>
                                               </a>
                                            </li>
                                            <li>
                                                    <a href="#">
                                                Abdelrahman Ma42l
                                                       <i class="fa fa-long-arrow-right"></i>
                                                   </a>
                                             </li>

                                             <li>
                                                    <a href="#">
                                                        abdelwarith shadouf
                                                       <i class="fa fa-long-arrow-right"></i>
                                                   </a>
                                                </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Single Footer Widget End -->

                        <!-- Single Footer Widget Start -->
                        <div class="col-lg-4 col-md-6">
                            <div class="single-footer-widget">
                                <h2>get touch</h2>
                                <div class="widget-body">
                                    <p>Please Don't feel shy to get intouch with us for any problems or suggestions </p>

                                    <ul class="get-touch">
                                        <li><i class="fa fa-map-marker"></i> Menouf, Elmenofiya, Egypt</li>
                                        <li><i class="fa fa-mobile"></i> +20 01096499623</li>
                                        <li><i class="fa fa-envelope"></i> Muslate@gmail.com</li>
                                    </ul>
                                    <a href="https://goo.gl/maps/b5mt45MCaPB2" class="map-show" target="_blank">Show Location</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Footer Widget End -->
                    </div>
                </div>
            </div>
            <!-- Footer Widget End -->
    </section>
    <!--== Footer Area End ==-->

    <!--== Scroll Top Area Start ==-->
    <div class="scroll-top">
        <img src="assets/img/scroll-top.png" alt="JSOFT">
    </div>
    <!--== Scroll Top Area End ==-->

    <!--=======================Javascript============================-->
    <!--=== Jquery Min Js ===-->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!--=== Jquery Migrate Min Js ===-->
    <script src="assets/js/jquery-migrate.min.js"></script>
    <!--=== Popper Min Js ===-->
    <script src="assets/js/popper.min.js"></script>
    <!--=== Bootstrap Min Js ===-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--=== Gijgo Min Js ===-->
    <script src="assets/js/plugins/gijgo.js"></script>
    <!--=== Vegas Min Js ===-->
    <script src="assets/js/plugins/vegas.min.js"></script>
    <!--=== Isotope Min Js ===-->
    <script src="assets/js/plugins/isotope.min.js"></script>
    <!--=== Owl Caousel Min Js ===-->
    <script src="assets/js/plugins/owl.carousel.min.js"></script>
    <!--=== Waypoint Min Js ===-->
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <!--=== CounTotop Min Js ===-->
    <script src="assets/js/plugins/counterup.min.js"></script>
    <!--=== YtPlayer Min Js ===-->
    <script src="assets/js/plugins/mb.YTPlayer.js"></script>
    <!--=== Magnific Popup Min Js ===-->
    <script src="assets/js/plugins/magnific-popup.min.js"></script>
    <!--=== Slicknav Min Js ===-->
    <script src="assets/js/plugins/slicknav.min.js"></script>

    <!--=== Mian Js ===-->
    <script src="assets/js/main.js"></script>


</body>

</html>
