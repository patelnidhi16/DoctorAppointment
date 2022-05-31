<!DOCTYPE html>
<html lang="en">

<head>

    <title>Health - Medical Website Template</title>
    <!--

Template 2098 Health

http://www.tooplate.com/view/2098-health

-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Tooplate">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/owl.theme.default.min.css')}}">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('front/css/tooplate-style.css')}}">

</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

<section id="appointment" data-stellar-background-ratio="3">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <img src="{{asset('front/images/appointment-image.jpg')}}" class="img-responsive" alt="">
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- CONTACT FORM HERE -->
              
                <form method="POST" action="{{ route('register') }}">
                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                        <h2>Registration</h2>
                    </div>

                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <div class="col-md-12 col-sm-12">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Your Email">
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="select">Select Shift</label>
                            <select class="form-control">
                                <option>Morning</option>
                                <option>Evening</option>
                             
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="mobile">Mobile No.</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Your Mobile No">
                        </div>
                        
                        <div class="col-md-12 col-sm-12">
                            <label for="start_time"></label>
                            <input type="time" class="form-control" id="start_time" name="start_time" placeholder="Your start time">
                        </div>
                       
                        <div class="col-md-12 col-sm-12">
                            <label for="end_time"></label>
                            <input type="time" class="form-control" id="end_time" name="end_time" placeholder="Your end time">
                        </div>
                       
                        
                        <button type="submit" class="form-control" id="cf-submit" name="submit">Register</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>


    <!-- SCRIPTS -->
    <script src="{{asset('front/js/jquery.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/jquery.sticky.js')}}"></script>
    <script src="{{asset('front/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('front/js/wow.min.js')}}"></script>
    <script src="{{asset('front/js/smoothscroll.js')}}"></script>
    <script src="{{asset('front/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('front/js/custom.js')}}"></script>

</body>

</html>

