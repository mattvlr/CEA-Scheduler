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
<div class="row">
  <div class="col-lg-6">
    <div class="input-group input-group-lg">
      <span class="input-group-addon" id="sizing-addon1">User Search</span>
      <input type="text" id="search" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
        <button class="btn btn-default" type="button">List All</button>
      </span>
    </div><!-- /input-group -->
          <h4 id="results-text">Showing results for: <b id="search-string">Array</b></h4>
      <ul id="results"></ul>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->