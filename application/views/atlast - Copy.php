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
<?php  $baseurlloc = 'http://dgtldiary.phpfogapp.com';?>
	<link rel="stylesheet" href="<?php  echo $baseurlloc;?>/css/bootstrap.min.css">
	<style>
	body {
	  padding-top: 60px;
	  padding-bottom: 40px;
	}
			html, body {
				height:90%;
				margin: 0px;
			}
			#timeline-embed{
				margin:0px !important;
				border:0px solid #CCC !important;
				padding:0px !important;
				-webkit-border-radius:0px !important;
				-moz-border-radius:0px !important;
				border-radius:0px !important;
				-moz-box-shadow:0 0px 0px rgba(0, 0, 0, 0.25) !important;
				-webkit-box-shadow:0 0px 0px rgba(0, 0, 0, 0.25) !important;
				box-shadow:0px 0px 0px rgba(0, 0, 0, 0.25) !important;
			}


	</style>
	<link rel="stylesheet" href="<?php  echo $baseurlloc;?>/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="<?php  echo $baseurlloc;?>/css/style.css">
	<link rel="stylesheet" href="<?php  echo $baseurlloc;?>/css/timeline.css">

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
<div id="timeline-embed"></div>
		


      <footer>
        <p>&copy; OpenHack 2012</p>
      </footer>

    </div> <!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php  echo $baseurlloc;?>/js/libs/jquery-1.7.2.min.js"><\/script>')</script>

<script src="<?php  echo $baseurlloc;?>/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="<?php  echo $baseurlloc;?>/js/timeline.js"></script>
<script src="<?php  echo $baseurlloc;?>/js/script.js"></script>

<script>
/*
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
	*/
	var timelineobject={"timeline":{"headline":"Welcome to your Personal Diary","type":"default","text":"<p>Your history is very important, Atlast what else are you living for ?</p>","asset":{"media":"<?php echo "http://www.gravatar.com/avatar/".$emailmd5."?s=200&r=pg&d=mm";?>","credit":"YOH 2012","caption":"Digital Diary"},"date":[ <?php echo $pagejson;?> ]}};
	console.log(timelineobject);
	//var timelineobject = JSON.parse(timelinepages);
			var timeline_config = {
				width: 	"100%",
				height: "100%",
				source: timelineobject,
				//start_at_end:	true,					//OPTIONAL
				//hash_bookmark: true,					//OPTIONAL
			}
</script>
<script type="text/javascript" src="<?php  echo $baseurlloc;?>/js/timeline-embed.js"></script>
</body>
</html>
