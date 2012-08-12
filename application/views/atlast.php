<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>InstaDiary</title>
		<meta name="description" content="Insta Diary">

		<style>
			html, body {
				height:100%;
				padding: 0px;
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
		<script type="text/javascript" src="http://dgtldiary.phpfogapp.com/lib/jquery.js">	</script>
		<script type="text/javascript" src="http://dgtldiary.phpfogapp.com/js/timeline.js">	</script>
		
	</head>

	<body>
		<div id="timeline-embed"></div>

		<script type="text/javascript">
		var timeline_config;
			$(document).ready(function(){
var timelineobject={"timeline":{"headline":"Welcome to your Personal Diary","type":"default","text":"<p>Your history is very important, Atlast what else are you living for ?</p>","asset":{"media":"<?php echo "http://www.gravatar.com/avatar/".$emailmd5."?s=200&r=pg&d=mm";?>","credit":"YOH 2012","caption":"Digital Diary"},"date":[ <?php echo $pagejson;?> ]}};
			timeline_config = {
						width: 	"100%",
						height: "100%",
						source: timelineobject,
						//start_at_end:	true,					//OPTIONAL
						//hash_bookmark: true,					//OPTIONAL
						css: 	'http://dgtldiary.phpfogapp.com/css/timeline.css',	//OPTIONAL
						js: 	'http://dgtldiary.phpfogapp.com/js/timeline.js'	//OPTIONAL
					};
					
					var loadembed = document.createElement('script');
					loadembed.setAttribute("type","text/javascript");
					loadembed.setAttribute("src","http://dgtldiary.phpfogapp.com/js/timeline-embed.js");
						
					if (typeof loadembed!="undefined")
					{
						 document.getElementsByTagName("head")[0].appendChild(loadembed);
					}
 				
				});	
			
		</script>

	</body>
</html>
