<?php 
session_start();
include("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Contact Us - BarcaStay</title>
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

.contact-content {
  text-align: center;
  padding: 20px;
  max-width: 600px;
  margin: 0 auto;
  background: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.contact-content h1 {
  font-size: 2.5em;
  margin-bottom: 20px;
}

.contact-content p {
  font-size: 1.2em;
  color: #666;
  line-height: 1.6;
  margin-bottom: 30px;
}

.contact-content form .form-group {
  text-align: left;
}

.contact-content form .form-group label {
  font-size: 1.1em;
}

.contact-content form .form-control {
  font-size: 1.1em;
  padding: 10px;
  margin-bottom: 15px;
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
  <div class="contact-content">
    <h1>Contact Us</h1>
    <p>If you have any questions or need further information, please fill out the form below to contact us.</p>
    <form method="POST" action="send_email.php">
      <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Your Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="message">Your Message</label>
        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
  </div>
</div>

<footer>
  <p>© 2024 Moamen Atia | BarcaStay</p>
</footer>

</body>
</html>
