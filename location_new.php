

<html>
<head>
<title>Add a New Location</title>

	<!--<script src="/resources/js/jquery.min.js" type="text/javascript"></script> -->

    	<!-- Bootstrap core CSS -->
    	<link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="/resources/css/dashboard.css" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

		
</head>
<body>

<form name="form1" method="post" action="checklocation.php">
<center><strong>Enter New Location</strong>

<br><br>

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Building Code</span>
<input name="nickname" type="text" id="nickname" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Building Name</span>
<input name="fullname" type="text" id="fullname" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Street Address</span>
<input name="address" type="text" id="address" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">City</span>
<input name="city" type="text" id="city" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">State</span>
<input name="state" type="text" id="state" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Zipcode</span>
<input name="zipcode" type="text" id="zipcode" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<button type="submit" class="btn btn-default">Submit</button>

<br><br>
<p>
This site uses the <a href="http://geocoder.opencagedata.com/">OpenCage Geocoder</a>. 
</p>
</center>

</body>
</html>

