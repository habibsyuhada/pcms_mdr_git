<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
   Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="initial-scale=1.0, target-densitydpi=device-dpi" /><!-- this is for mobile (Android) Chrome -->
<meta name="viewport" content="initial-scale=1.0, width=device-height"><!--  mobile Safari, FireFox, Opera Mobile  -->
<script src="../libs/modernizr.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="../libs/flashcanvas.js"></script>
<![endif]-->
<style type="text/css">

	div {
		margin-top:1em;
		margin-bottom:1em;
	}
	input {
		padding: .5em;
		margin: .5em;
	}
	select {
		padding: .5em;
		margin: .5em;
	}
	
	#signatureparent {
		color:darkblue;
		background-color:darkgrey;
		/*max-width:600px;*/
		padding:20px;
	}
	
	/*This is the div within which the signature canvas is fitted*/
	#signature {
		border: 2px dotted black;
		background-color:lightgrey;
	}

	/* Drawing the 'gripper' for touch-enabled devices */ 
	html.touch #content {
		float:left;
		width:92%;
	}
	html.touch #scrollgrabber {
		float:right;
		width:4%;
		margin-right:2%;
		background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAFCAAAAACh79lDAAAAAXNSR0IArs4c6QAAABJJREFUCB1jmMmQxjCT4T/DfwAPLgOXlrt3IwAAAABJRU5ErkJggg==)
	}
	html.borderradius #scrollgrabber {
		border-radius: 1em;
	}
	 
</style>
</head>
<body>
<div>
<div id="content">
	<form action="save-sign.php" method="post">
	 Sign here
	 <div id="signature" style="width: 700px"></div>
	 <input type="hidden" name="hdnSignature" id="hdnSignature" />
	 <input type="button" id="btn_submit" value="Submit Form" />
	</form>
	<!-- <div id="signatureparent">
		<div>jSignature inherits colors from parent element. Text = Pen color. Background = Background. (This works even when Flash-based Canvas emulation is used.)</div>
		<div id="signature"></div></div>
	<div id="tools"></div>
	<div><p>Display Area:</p><div id="displayarea"></div></div> -->
</div>
<div id="scrollgrabber"></div>
</div>
<script src="../libs/jquery.js"></script>
<script type="text/javascript">
jQuery.noConflict()
</script>
<script src="../libs/jSignature.min.noconflict.js"></script>
<script>
(function($){
	
	$(document).ready(function(){
		
 		'use strict';
 		var $sigdiv = $("#signature");
 		$sigdiv.jSignature({'UndoButton':true, 'width': 700, 'height': 250});// inits the jSignature widget.
 
		//save data to hidden field before submiting the form
		$('#btn_submit').click(function () {
			
  		var datapair = $sigdiv.jSignature("getData", "image");
		$('#hdnSignature').val(datapair[1]);
 			//now submit form 
			document.forms[0].submit();
		
		});
		
 	});
	
})(jQuery)
</script>
</body>
</html>
