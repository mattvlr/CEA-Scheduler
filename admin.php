<head>
	<script type="text/javascript" src="/resources/js/usersearch.js"></script>
	<link href="/resources/css/admincss.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<!--
<a href="?loc=Add">Add Location</a>
<br>
<a href="?loc=edit">Change Location</a>
<br> 
<a href="?loc=delete">Delete Location</a>
<br>
<a href="?loc=editor">Map Editor Test Page</a>
<br>
<a href="?cart=Add">Add Cart</a>
-->
<div id="panelwrapper" style="position:relative">
<div id="leftwrapper" style="float:left; width:60%">
<div class="panel panel-primary">

  <div class="panel-heading"><h3 class="panel-title">Users Panel</h3></div>
  <div class="panel-body"> <div class="row"  style="padding:5px 5px 5px 5px;">
    <div class="media">
      <div class="media-body">   <center><div class="well" style="float:left;">Clicking on a user that shows up in the search will take you to their profile where you can edit their information. The two other buttons
       let you add and remove users.</div>
  <div class="btn-group btn-group-lg" role="group" aria-label="Large button group"  style="padding:5px 5px 5px 5px">
        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"></span> Add </button>
        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-minus"></span> Remove </button>
    </div></center></div></div>
    <div class="input-group input-group-lg"  style="padding:5px 5px 5px 5px">
      <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span> User Search</span>
      <input type="text" id="search" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span> List All</button>
      </span>
    </div><!-- /input-group -->
     <center> <h4 id="results-text">Showing results for: <b id="search-string">Array</b></h4>
      <ul class="list-group" id="results"></ul></center>
 
</div><!-- /.row --></div>
</div> <!-- users panel -->
</div>
<div id="rightwrapper" style="float:right; width:35%; margin-right:3%">
<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">Stops Panel</h3></div>
  <div class="panel-body"> 
    <div class="media">
      <div class="well">
      <div class="media-left">
        <a href="?loc=editor">
          <img class="media-object" src="/resources/img/mapsc.png" alt="Visual Stop Editor">
        </a>
      </div>
      
      <div class="media-body">
        <a href="?loc-editor"><h4 class="media-heading">Visual Stop Editor</h4></a>
        Edit stop locations inside a google map. Optionally you can add, edit, and remove stops by clicking the buttons below.
      </div></div>
  </div>
   <center><div class="btn-group btn-group-lg" role="group" aria-label="Large button group"  style="padding:15px 5px 5px 5px">
        <a href="?loc=add" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Add </a>
        <a href="?loc=edit" class="btn btn-default" role="button"><span class="glyphicon glyphicon-pencil"></span> Edit </a>
        <a href="?loc=delete" class="btn btn-default" role="button"><span class="glyphicon glyphicon-minus"></span> Remove </a></div></center>
</div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">Golf Cart Panel</h3></div>
  <div class="panel-body">
   <center><div class="btn-group btn-group-lg" role="group" aria-label="Large button group"  style="padding:15px 5px 5px 5px">
        <a href="?cart=new" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Add </a>
        <a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-pencil"></span> Edit </a>
        <a href="#" class="btn btn-default" role="button"><span class="glyphicon glyphicon-minus"></span> Remove </a></div></center></div>

</div>
<div class="panel panel-primary">
  <div class="panel-heading"><h3 class="panel-title">Statistics</h3></div>
  <div class="panel-body">
   </div>
</div>
</div>
</div>



