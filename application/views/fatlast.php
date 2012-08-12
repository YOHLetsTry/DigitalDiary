<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Flickr</title>
	<link rel="stylesheet"  href="http://dgtldiary.phpfogapp.com/css/jquery.mobile-1.1.1.css" />
	
	<script src="http://dgtldiary.phpfogapp.com/lib/jquery.js"></script>

	<script src="http://dgtldiary.phpfogapp.com/js/jquery.mobile-1.1.1.js"></script>
	
</head>
<body>

	
	<script type="text/javascript">
	var data = {"singam":[ <?php echo $pagejson;?>]};
			console.log(data);
	var pagehtml ="";		
	data.singam.forEach(function(pageday,index)
	{
		pagehtml += '<div data-role="page" id="in'+index+'">';
		pagehtml += '<div data-role="header"><h1>'+pageday.headline+'</h1></div>';
		pagehtml += '<div data-role="content">';
		pagehtml += '<img src="'+pageday.asset.media+'"/>'+pageday.text+'</div>';
		pagehtml += '<div data-role="footer" data-theme="d">'+pageday.asset.caption+'</div>';
		pagehtml += '<p><a href="#in'+(index+1)+'" data-role="button">Next</a></p>';
		if(index!=0)
		{
		pagehtml += '<p><a href="#in'+(index-1)+'" data-role="button">Back</a></div></p>';
		}
		else
		{
		pagehtml += '</div>';
		}
		$('body').append(pagehtml);
		
	});
	
	
	</script>
			
			

	

</div>
</body>
</html>
