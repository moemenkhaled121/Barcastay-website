<?php 
session_start();

include("navbar.php");
?>
<!DOCTYPE html>
<html>
<head>
<style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, sans-serif;
  display: flex;
  flex-direction: column;
}

header {
  background-image: url("images/back.jpg");
  height: 120vh;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: white;
  text-shadow: 2px 2px 4px #000000;
}

header .logo {
  font-size: 4em;
  margin: 0;
}

header .search-bar {
  margin-top: 20px;
  width: 50%;
}

header .search-bar input[type=text] {
  width: 100%;
  padding: 15px;
  font-size: 18px;
  border: 1px solid #4dd0e1;
  border-radius: 25px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.main-content {
  flex: 1;
  padding: 20px;
}

.property-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.property-item {
  width: 300px;
  margin: 15px;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  text-align: center;
}

.property-item img {
  width: 100%;
  height: auto;
}

.property-item h3 {
  font-size: 1.5em;
  margin: 10px 0;
}

.property-item p {
  padding: 0 10px;
  font-size: 1em;
  color: #666;
}

footer {
  background-color: #f1f1f1;
  padding: 20px;
  text-align: center;
  border-top: 1px solid #e7e7e7;
  width: 100%;
  position: relative;
}
</style>
</head>
<body>

<header>
  <div class="logo">BarcaStay</div>
  <div class="search-bar">
    <form method="POST" action="search-property.php">
      <input class="form-control" type="text" placeholder="Enter location to search house." name="search_property" aria-label="Search">
    </form>
  </div>
</header>

<div class="main-content">
  <div class="property-list">
    <?php 
    include("property-list.php");
    ?>
  </div>
</div>

<footer>
  <p>© 2024 Moamen Atia | BarcaStay</p>
</footer>

</body>
</html>
