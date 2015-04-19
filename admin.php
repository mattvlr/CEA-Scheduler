<head>
	<script type="text/javascript" src="/resources/js/usersearch.js"></script>
	<link href="/resources/css/admincss.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<a href="?loc=new">New Location</a>
<br>
<a href="?loc=edit">Change Location</a>
<br> 
<a href="?loc=delete">Delete Location</a>
<br>
<a href="?loc=editor">Map Editor Test Page</a>
<br>
<a href="?cart=new">New Cart</a>

<div class="panel panel-primary" style="width:50%">

  <div class="panel-heading"><h3 class="panel-title">Users</h3></div>
  <div class="panel-body"> <div class="row">
     <div class="input-group input-group-lg">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"> Add </button>
        <button class="btn btn-default" type="button"> Remove </button>
      </span>
    </div>
    <div class="input-group input-group-lg">
      <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span> User Search</span>
      <input type="text" id="search" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span> List All</button>
      </span>
    </div><!-- /input-group -->
      <h4 id="results-text">Showing results for: <b id="search-string">Array</b></h4>
      <ul class="list-group" id="results"></ul>
 
</div><!-- /.row --></div>
</div>



