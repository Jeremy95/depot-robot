<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
<title>Mon robot d'indexation</title>
</head>
<body>
	<div align="center"> <br/><br/>
	
		
		<font face="Arial" size="1" color="black">Copyright Jeremy Bchiri</font>
		
	</div>
	<div id="results">
	</div>
<script type="text/javascript" src="jquery.js">
</script>
<script type="text/javascript">
function robots() { 

$.ajax({
	url: "monrobot.php",
	success: function(data) {$("#results").html(data);}
	});
	
}


setInterval(robots(), 14400);



</script>
</body>
</html>

