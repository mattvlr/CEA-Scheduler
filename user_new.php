

<html>
<head>
<title>Add a User</title>

	<!--<script src="/resources/js/jquery.min.js" type="text/javascript"></script> -->

    	<!-- Bootstrap core CSS -->
    	<link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="/resources/css/dashboard.css" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

		
</head>
<body>

<form name="form1" method="post" action="checkuser.php">
<center><strong>Enter New User</strong>

<br><br>
<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">First Name</span>
<input name="firstname" type="text" id="firstname" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Last Name</span>
<input name="lastname" type="text" id="lastname" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Identification Number</span>
<input name="idnum" type="text" id="idnum" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Username</span>
<input name="username" type="text" id="username" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Date of Birth</span>
<input name="birth" type="text" id="birth" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Email</span>
<input name="email" type="text" id="email" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Email</span>
<input name="email" type="text" id="email" value="" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<select class="form-control">
  <option>Student</option>
  <option>Driver</option>
  <option>Administrator</option>
</select>
<br><br>

<button type="submit" class="btn btn-default">Submit</button>


</center>

</body>
</html>

