<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width">
<?php  $baseurlloc = base_url();?>
	<link rel="stylesheet" href="<?php  echo $baseurlloc;?>/css/bootstrap.min.css">
	<style>
	body {
	  padding-top: 60px;
	  padding-bottom: 40px;
	}
	</style>
	<link rel="stylesheet" href="<?php  echo $baseurlloc;?>/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="<?php  echo $baseurlloc;?>/css/style.css">

	<script src="<?php  echo $baseurlloc;?>/js/libs/modernizr-2.5.3-respond-1.1.0.min.js"></script>
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Digital Diary</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Enter</a></li>
              <li><a href="#about">About</a></li>
              </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">


      <!-- Example row of columns -->
      <div class="row">
        <div class="offset4 span4">
		<input type="email" placeholder="Enter your Email" />
        </div>
      </div>
	  <br/>
      <div class="row">
        <div class="offset1 span3">
		<a href="flickr#" ><img src="<?php  echo $baseurlloc;?>/img/connect-flickr.png" /></a>
		</div>
		<div class="span2.2">
		<a href="instagram#" ><img src="<?php  echo $baseurlloc;?>/img/connect-instagram.png" /></a>
		</div>
		<div class="span3">
		<a href="foursquare#" ><img src="<?php  echo $baseurlloc;?>/img/connect-foursquare.png" /></a>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; OpenHack 2012</p>
      </footer>

    </div> <!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php  echo $baseurlloc;?>/js/libs/jquery-1.7.2.min.js"><\/script>')</script>

<script src="<?php  echo $baseurlloc;?>/js/libs/bootstrap/bootstrap.min.js"></script>

<script src="<?php  echo $baseurlloc;?>/js/script.js"></script>
<script>
/*
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
	*/
</script>

</body>
</html>
