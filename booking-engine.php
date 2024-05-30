<?php
include("config/config.php");
session_start();

if (isset($_POST['book_property'])) {
    if (isset($_SESSION["email"])) {
        global $db;
        $u_email = $_SESSION["email"];
        $property_id = $_POST['property_id']; // Changed from $_GET to $_POST to match the form method

        // Check if the property is already booked
        $check_sql = "SELECT * FROM add_property WHERE property_id = '$property_id'";
        $check_query = mysqli_query($db, $check_sql);
        $property = mysqli_fetch_assoc($check_query);

        if ($property['booked'] === 'yes') {
            header("Location: booking-failure.php"); // Redirect to a failure page or display an error
            exit();
        }

        // Get tenant ID
        $sql = "SELECT * FROM tenant WHERE email = '$u_email'";
        $query = mysqli_query($db, $sql);

        if (mysqli_num_rows($query) > 0) {
            while ($rows = mysqli_fetch_assoc($query)) {
                $tenant_id = $rows['tenant_id'];
                $owner_id = $property['owner_id']; // Retrieve the owner_id from the property

                // Mark the property as booked
                $sql1 = "UPDATE add_property SET booked = 'yes' WHERE property_id = '$property_id'";
                $query1 = mysqli_query($db, $sql1);

                // Insert the booking record
                $sql2 = "INSERT INTO booking (property_id, tenant_id, owner_id) VALUES ('$property_id', '$tenant_id', '$owner_id')";
                $query2 = mysqli_query($db, $sql2);

                if ($query2 && $query1) {
                    header("Location: booking-success.php"); // Redirect to success page
                    exit();
                } else {
                    header("Location: booking-failure.php"); // Redirect to a failure page if booking fails
                    exit();
                }
            }
        } else {
            header("Location: booking-failure.php"); // Redirect to a failure page if tenant not found
            exit();
        }
    } else {
        header("Location: login.php"); // Redirect to login page if not logged in
        exit();
    }
}
?>
