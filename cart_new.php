

<html>
<head>
<title>Add a Cart</title>

	<!--<script src="/resources/js/jquery.min.js" type="text/javascript"></script> -->

    	<!-- Bootstrap core CSS -->
    	<link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="/resources/css/dashboard.css" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

		
</head>
<body>

<form name="form1" method="post" action="checkcart.php">
<center><strong>Enter New Cart</strong>

<br><br>
<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Name</span>
<input name="nickname" type="text" id="nickname" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;"># of Seats</span>
<input name="seats" type="text" id="seats" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Notes</span>
<input name="notes" type="text" id="notes" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 
<br><br>

<button type="submit" class="btn btn-default">Submit</button>


</center>

</body>
</html>

