<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$property_id = '';
$country = '';
$province = '';
$zone = '';
$district = '';
$city = '';
$vdc_municipality = '';
$ward_no = '';
$tole = '';
$contact_no = '';
$property_type = '';
$estimated_price = '';
$total_rooms = '';
$bedroom = '';
$living_room = '';
$kitchen = '';
$bathroom = '';
$description = '';
$latitude = '';
$longitude = '';
$booked = '';
$owner_id = '';

$db = new mysqli('localhost','u649696475_mo','A7Aneek2001@','u649696475_barcastay');

if ($db->connect_error) {
    die("Error connecting to the database: " . $db->connect_error);
}

if (isset($_POST['add_property'])) {
    add_property();
}

if (isset($_POST['owner_update'])) {
    owner_update();
}

function add_property() {
    global $db;

    $country = validate($_POST['country']);
    $province = validate($_POST['province']);
    $zone = isset($_POST['zone']) ? validate($_POST['zone']) : '';
    $district = validate($_POST['district']);
    $city = validate($_POST['city']);
    $vdc_municipality = isset($_POST['vdc_municipality']) ? validate($_POST['vdc_municipality']) : '';
    $ward_no = validate($_POST['ward_no']);
    $tole = isset($_POST['tole']) ? validate($_POST['tole']) : '';
    $contact_no = validate($_POST['contact_no']);
    $property_type = validate($_POST['property_type']);
    $estimated_price = validate($_POST['estimated_price']);
    $total_rooms = validate($_POST['total_rooms']);
    $bedroom = validate($_POST['bedroom']);
    $living_room = validate($_POST['living_room']);
    $kitchen = validate($_POST['kitchen']);
    $bathroom = validate($_POST['bathroom']);
    $description = validate($_POST['description']);
    $latitude = validate($_POST['latitude']);
    $longitude = validate($_POST['longitude']);
    $booked = 'No';

    $u_email = $_SESSION['email'];
    $sql1 = "SELECT * FROM owner WHERE email = '$u_email'";
    $result1 = mysqli_query($db, $sql1);

    if (mysqli_num_rows($result1) > 0) {
        $rowss = mysqli_fetch_assoc($result1);
        $owner_id = $rowss['owner_id'];

        $sql = "INSERT INTO add_property (country, province, zone, district, city, vdc_municipality, ward_no, tole, contact_no, property_type, estimated_price, total_rooms, bedroom, living_room, kitchen, bathroom, description, latitude, longitude, booked, owner_id) 
                VALUES ('$country', '$province', '$zone', '$district', '$city', '$vdc_municipality', '$ward_no', '$tole', '$contact_no', '$property_type', '$estimated_price', '$total_rooms', '$bedroom', '$living_room', '$kitchen', '$bathroom', '$description', '$latitude', '$longitude', '$booked', '$owner_id')";

        if (mysqli_query($db, $sql)) {
            $property_id = mysqli_insert_id($db);

            $countfiles = count($_FILES['p_photo']['name']);
            for ($i = 0; $i < $countfiles; $i++) {
                $paths = $_FILES['p_photo']['tmp_name'][$i];
                if ($paths != "") {
                    $path = "product-photo/" . $_FILES['p_photo']['name'][$i];
                    if (move_uploaded_file($paths, $path)) {
                        $sql2 = "INSERT INTO property_photo (p_photo, property_id) VALUES ('$path', '$property_id')";
                        mysqli_query($db, $sql2);
                    }
                }
            }

            echo "<div class='container'><div class='alert' role='alert'>
                  <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
                  <center><strong>Your Property has been uploaded.</strong></center>
                  </div></div>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    }
}

function owner_update() {
    global $db;

    $owner_id = validate($_POST['owner_id']);
    $full_name = validate($_POST['full_name']);
    $email = validate($_POST['email']);
    $phone_no = validate($_POST['phone_no']);
    $address = validate($_POST['address']);
    $id_type = validate($_POST['id_type']);

    $sql = "UPDATE owner SET full_name='$full_name', email='$email', phone_no='$phone_no', address='$address', id_type='$id_type' WHERE owner_id='$owner_id'";
    if (mysqli_query($db, $sql)) {
        echo "<div class='container'><div class='alert' role='alert'>
              <span class='closebtn' onclick=\"this.parentElement.style.display='none';\">&times;</span> 
              <center><strong>Your Information has been updated.</strong></center>
              </div></div>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
