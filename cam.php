<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
		<meta name="description" content="Webcam Photo Booth made with ActionScript 3" />
		<meta name="keywords" content="photo, photo booth, image, flash, actionscript," />
		<title>Photo Booth</title>
		<script src="swfobject.js" language="javascript"></script>
		<script type="text/javascript">
			var flashvars = {};
			
			var parameters = {};
			parameters.scale = "noscale";
			parameters.wmode = "window";
			parameters.allowFullScreen = "true";
			parameters.allowScriptAccess = "always";
			
			var attributes = {};

			swfobject.embedSWF("take_picture.swf", "main", "700", "400", "9", 
					"expressInstall.swf", flashvars, parameters, attributes);
		</script>
	</head>

	<body>
		<center>
			<div id="main">	
				<div>
					<h1>You need FlashPlayer 9 or higher!</h1>
					<p><a href="http://www.adobe.com/go/getflashplayer"><img 
					src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" 
					alt="Get Adobe Flash player" /></a></p>
				</div>
			</div>
			<br/>
			
</html>
