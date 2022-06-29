<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Asaan Estate/Lead</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.png')}}">

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/lead-style.css')}}">
    <style>
        .intro1 {
	        background-image: url("{{ asset('../assets/images/lead-bg.jpg') }}");
        }
    </style>
</head>

<body id="page-top">

    <div class="body">
        <!-- HEADER -->
        <header>
            <nav class="navbar-inverse navbar-lg navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{route('welcome')}}" class="navbar-brand brand"><img class="main-logo" src="{{asset('assets/images/lead-logo.png')}}"></a>
                    </div>
                </div>
            </nav>
        </header>

        <!-- INTRO -->
        <div id="home" class="intro intro1">
            <div class="overlay"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6 col-lg-7 order-2 order-md-1">
                        <h2>Manage all your customers, properties, and deals in one app.</h2>
                        <p>A combination of cloud-based technologies and artificial intelligence is implemented, to get auto-match suggestions to help you close more deals.</p>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-10">
                                <ul class="features-list">
                                    <li>
                                        <i class="fa fa-user"></i>
                                        <h5>Online</h5>
                                    </li>

                                    <li>
                                        <i class="fas fa-brain"></i>
                                        <h5>Intelligent</h5>
                                    </li>

                                    <li>
                                        <i class="fas fa-expand-alt"></i>
                                        <h5>Scalable</h5>
                                    </li>

                                    <li>
                                        <i class="fa fa-cloud"></i>
                                        <h5>Cloud-based</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-5 order-1 order-md-2">
                        <div class="intro-form" id="join-us-form contact-form">
                            <h4>Request a Call</h4>
                            <!-- Form -->
                		    <div class="form-group">
                              <input type="text" name="name" id="name" class="form-control f-input input-field" placeholder="Name" />
                            </div>
                            <div class="form-group">
                              <input type="text" name="city" id="city" class="form-control f-input input-field" placeholder="City" />
                            </div>
                            <div class="form-group">
                              <input type="tel" name="phone" maxlength="15"  class="form-control f-input input-field" placeholder="Phone" />
                            </div>
                            <div class="form-group">
                              <textarea class="form-control f-input input-field" id="request_detail" placeholder="Request detail" rows="3"></textarea>
                            </div>
                			<button type="submit" class="btn btn-block btn-lg btn-light" id="submit_btn">Request a Call</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JAVASCRIPT =============================-->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/92840116b8.js" crossorigin="anonymous"></script>
</body>

</html>
