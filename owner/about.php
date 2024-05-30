<?php 
session_start();
include("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>About Us - BarcaStay</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, sans-serif;
  display: flex;
  flex-direction: column;
}

header {
  background-image: url("../images/barcelona_skyline.jpg");
  height: 60vh;
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

.main-content {
  flex: 1;
  padding: 40px 20px;
  background-color: #f8f9fa;
}

.about-content {
  text-align: center;
  padding: 20px;
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.about-content img {
  width: 100%;
  max-width: 500px;
  height: auto;
  border-radius: 8px;
  margin: 20px;
}

.about-content .text {
  flex: 1;
  padding: 20px;
  text-align: left;
}

.about-content h1 {
  font-size: 2.5em;
  margin-bottom: 20px;
}

.about-content p {
  font-size: 1.2em;
  color: #666;
  line-height: 1.6;
}

.team-content {
  text-align: center;
  padding: 20px;
  max-width: 1200px;
  margin: 40px auto 0 auto;
}

.team-content h1 {
  font-size: 2.5em;
  margin-bottom: 40px;
}

.team-content .team-member {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  flex: 1;
  max-width: 300px;
  margin: 0 auto 20px auto;
}

.team-content .team-member img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  margin-right: 20px;
  object-fit: cover;
}

.team-content .team-member h3 {
  margin: 0;
  font-size: 1.5em;
}

.team-content .team-member p {
  margin: 5px 0 0 0;
  font-size: 1em;
  color: #666;
}

footer {
  background-color: #333;
  padding: 20px;
  text-align: center;
  border-top: 1px solid #e7e7e7;
  width: 100%;
  color: white;
}
</style>
</head>
<body>

<header>
  <div class="logo">BarcaStay</div>
</header>

<div class="main-content">
  <div class="about-content">
    <img src="../images/team.jpg" alt="About Us">
    <div class="text">
      <h1>About Us</h1>
      <p>Welcome to BarcaStay! We are dedicated to helping you find the perfect house or room in the beautiful city of Barcelona. Our platform provides an extensive range of properties to suit every taste and budget. Whether you are looking for a short-term rental or a long-term home, we have got you covered. Explore our listings and find your dream stay in Barcelona with BarcaStay!</p>
    </div>
  </div>
  <div class="team-content">
    <h1>Our People</h1>
<div class="team-member">
      <img src="../images/person.jpg" alt="Team Member 1">
      <div>
        <h3>John Doe</h3>
        <p>CEO & Founder</p>
      </div>
    </div>
<div class="team-member">
      <img src="../images/person.jpg" alt="Team Member 1">
      <div>
        <h3>Jane Smith</h3>
        <p>Chief Operating Officer</p>
      </div>
    </div>
    <div class="team-member">
      <img src="../images/person.jpg" alt="Team Member 1">
      <div>
        <h3>Michael Johnson</h3>
        <p>Head of Marketing</p>
      </div>
    </div>
  </div>
</div>

<footer>
  <p>© 2024 Moamen Atia | BarcaStay</p>
</footer>

</body>
</html>
