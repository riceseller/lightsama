<?php
    require_once 'users/init.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js" integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD" crossorigin="anonymous"></script>

<style>
    .navbar{
        border-radius: 0;
    }
    .pull-xs-left{
        margin-left:5%;
    }
</style>

<nav class="navbar navbar-fixed-top navbar-dark bg-inverse">
    
  <a class="navbar-brand" href="#">HAILOINN</a>
  
  <ul class="nav navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#">Mapview<span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Explore</a>
    </li>
  </ul>
  
  <ul class="nav navbar-nav pull-xs-right">
      <li class="nav-item active">
      <a class="nav-link" href="#">Login<span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">Register<span class="sr-only">(current)</span></a>
    </li>
  </ul>
  
  <form class="form-inline pull-xs-left">
    <input class="form-control" type="text" placeholder="Search Pic Keywords">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  
</nav>