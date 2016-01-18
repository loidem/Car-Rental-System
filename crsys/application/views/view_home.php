<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Car Rental Management System | Home</title>

    <!-- Bootstrap core CSS -->
	<link href="http://localhost/crsys/public/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://localhost/crsys/public/css/home_custom.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-fixed-top navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">

                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url();?>"><i class="fa fa-home fa-lg"></i> Home</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                	<a href='<?php echo base_url(); ?>login' class='btn btn-primary btn-success navbar-btn navbar-right'>Sign in</a>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="business-header">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <h1 class="tagline">Car Rental Management System</h1>
                        <p>Description</p>
                    </center>
                    
                </div>
            </div>
             <hr>
            <div class="row">
                <div class="col-lg-8" id="home-signup">
                    <h2>What We Do</h2>
                    <p>Description</p>
                    <p><a class="btn btn-default btn-large" href="<?php echo base_url(); ?>register">Register an account &raquo;</a>
                    </p>
                </div>
                <div class="col-lg-4">
                    <h2>Contact Us</h2>
                    <address>
                        <strong>P&S, Inc.</strong>
                        <br>805, South Center Street, Suite 600
                        <br>Arlington , TX 76010
                        <br>
                    </address>
                    <address>
                        <abbr><i class="fa fa-phone"></i> </abbr>(469) 500-1777
                        <br>
                        <abbr><i class="fa fa-envelope"></i> </abbr> <a href="mailto:#">pands@psrental.com</a>
                    </address>
                </div>
            </div>

        <hr>
        </div>

    </div>

    <div class="container">

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>&copy; Company 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /container -->


    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

</body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://localhost/crsys/public/js/bootstrap.min.js"></script>
</html>
