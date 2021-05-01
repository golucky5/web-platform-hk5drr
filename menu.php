<?php

$stmt = false;

if( isset($_REQUEST['catid']) )
{

   if(!isset($_REQUEST['catid']) )
   {
       die("Invalid category selected !");
   }

   $catid = $_REQUEST['catid'];
   //echo "catid is " . $catid . "\n";


   $query ="select products.name as item, category.category_name as category , products.description as description from products inner join category where products.catid = category.catid  AND category.catid = " . $catid;

   $host = "localhost";
   $db ="appdb";
   $user ="appuser";
   $pass="appsecret123";
   $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    ];

    $pdo = null;

    try
    {
       $pdo = new PDO($dsn, $user, $pass, $opt);
       $stmt = $pdo->query($query);
    }
    catch(PDOException $e)
    {
       echo $e->getMessage();
    }


}

header('Content-Type: text/html; charset=UTF-8');

?>



<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<title>TWC Virtual Escape Room 2021</title>
</head>
<body>

  <nav class="navbar navbar-dark navbar-expand-sm bg-dark">
      <div>
        <ul class="navbar-nav">
          <li class="nav-item ">
            <a class="nav-link" href="welcome.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="Challenge1.html">Challenge1</a>
			
          </li>
		   <li class="nav-item">
            <a class="nav-link" href="Challenge2.html">Challenge2</a>
			
          </li> 
		  		            <li class="nav-item">
            <a class="nav-link" href="Challenge3.html">Challenge3</a>
			
          </li>
		  		            <li class="nav-item">
            <a class="nav-link" href="Challenge4.html">Challenge4</a>
			
          </li>
		  
		  <li class="nav-item">
            <a class="nav-link" href="menu.php">Big Challenge</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Final Challenge</a>
          </li>
		  		  <li class="nav-item">
            <a class="nav-link" href="about.html">Afterwards</a>
			
          </li>
		  
         </ul>
      </div>
    </nav>



  <div class="container-fluid">
        <h1>TWC's Snack Shack Menu</h1>
        <p class="h5">This is an instructional website only, you have permission to use what you have learned on this website.</p>
        <br>

  <div class="container border">
  
<p class="lead" >
<ul>
<li> <a href="menu.php?catid=1000">Drinks</a> </li>
<li> <a href="menu.php?catid=1001">Snacks</a> </li>
<li> <a href="menu.php?catid=1002">Fruits</a> </li>
<li> <a href="menu.php?catid=1003">Lunch boxes</a> </li>
</ul>
</p>
  <?php

  if($stmt!== False)
  {
  ?>

  <table class="table table-striped">
    <thead>
    <tr>
    <th>Item</th>
    <th>Category</th>
    <th>Description</th>
    </tr>
    </thead>
  <tbody>
   <?php
      while($result = $stmt->fetch())
      {
         echo "<tr>";
         echo "<td>" .$result['item']  . "</td><td>" . $result['category'] . "</td><td>" . $result['description'] . "</td>";
         echo "</tr>\n";
      }

   ?>

  </tbody>
  </table>

  <?php
     }
  ?>
 </div>
  </div>


</body>
</html>
