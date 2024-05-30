<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Success</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }
        .alert {
            padding: 20px;
            background-color: #4CAF50;
            color: white;
        }
        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .closebtn:hover {
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert" role="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <center><strong>Thank you for booking this property!</strong> Your booking has been successfully processed.</center>
        </div>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Go to Home</a>
        </div>
    </div>
</body>
</html>
