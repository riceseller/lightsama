<?php require_once 'users/init.php'; ?>

<header>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css" integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js" integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD" crossorigin="anonymous"></script>

<style>
    .navbar{
        height: 50px;
    }
    body{
        background: #f3f5f6;
    }
    .nav{
        padding-left: 20px;
    }
    .form-control{
        max-width:50%;
        display: inline;
        margin-right: 5px;
    }
    form{
        display: inline;
    }
    .form-inline{
        display:flex;
        padding-left: 20px;
    }
    .navbar{
        padding: 6px 1rem;
        border-radius: 0;
    }
</style>
</header>

<body>
<nav class="navbar navbar-dark bg-inverse">
    
  <a class="navbar-brand" href="#">PicShell</a>
  
  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation">
    &#9776;
  </button>
  <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
    <div class="bg-inverse"> 
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Explore</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">MapView</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Login/Register</a>
        </li>
    </ul>
    <form class="form-inline">
        <input class="form-control" type="text" placeholder="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    </div>
  </div>

</nav>

