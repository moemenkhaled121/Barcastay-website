<?php
session_start();
isset($_SESSION["email"]);
include "config/config.php";

if (isset($_SESSION["email"])) {
    $u_email = $_SESSION["email"];
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    $owner_id = isset($_POST['owner_id']) ? $_POST['owner_id'] : '';
    $property_id = isset($_POST['property_id']) ? $_POST['property_id'] : '';

    // Get tenant ID from session email
    $sql = "SELECT tenant_id FROM tenant WHERE email='$u_email'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $tenant_id = $row['tenant_id'];

        // Insert message into chat table
        $sql = "INSERT INTO chat (message, owner_id, tenant_id, property_id) VALUES ('$message', '$owner_id', '$tenant_id', '$property_id')";
        $query = mysqli_query($db, $sql);
        if ($query) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Something went wrong";
        }
    } else {
        echo "Tenant not found";
    }
} else {
    echo "User not logged in";
}
?>
