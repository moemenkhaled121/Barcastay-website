<?php 
session_start();
if (!isset($_SESSION["email"])) {
    header("location:../index.php");
    exit();
}

include("navbar.php");
include("engine.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .container-fluid { padding-top: 20px; }
    .tab-content { margin-top: 20px; }
    .tab-pane { padding: 20px; }
    .card { margin-bottom: 20px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
    .card img { width: 100%; height: auto; }
    .tablinks { width: 100%; text-align: left; }
    .tabcontent { display: none; }
    .clearfix { clear: both; }
    .tab button { background-color: inherit; border: none; cursor: pointer; padding: 14px 16px; transition: 0.3s; }
    .tab button:hover { background-color: #ddd; }
    .tab button.active { background-color: #ccc; }
    .message { margin: 10px 0; }
  </style>
</head>
<body>

<div class="container-fluid">
  <ul class="nav nav-pills nav-justified">
    <li class="active"><a data-toggle="pill" href="#home">Profile</a></li>
    <li><a data-toggle="pill" href="#messages">Messages</a></li>
    <li><a data-toggle="pill" href="#add-property">Add Property</a></li>
    <li><a data-toggle="pill" href="#view-property">View Property</a></li>
    <li><a data-toggle="pill" href="#update-property">Update Property</a></li>
    <li><a data-toggle="pill" href="#booked-property">Booked Property</a></li>
  </ul>

  <div class="tab-content">
    <!-- Profile Tab -->
    <div id="home" class="tab-pane fade in active">
      <center><h3>Owner Profile</h3></center>
      <div class="container">
        <?php 
        include("../config/config.php");
        $u_email = $_SESSION["email"];
        $sql = "SELECT * FROM owner WHERE email='$u_email'";
        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($rows = mysqli_fetch_assoc($result)) {
        ?>
        <div class="card">
          <img src="../images/avatar.png" alt="Owner" style="height:200px;">
          <h1><?php echo $rows['full_name']; ?></h1>
          <p class="title"><?php echo $rows['email']; ?></p>
          <p><b>Phone No.: </b><?php echo $rows['phone_no']; ?></p>
          <p><b>Address: </b><?php echo $rows['address']; ?></p>
          <p><b>Id Type: </b><?php echo $rows['id_type']; ?></p>
          <p><img src="../<?php echo $rows['id_photo']; ?>" height="100px"></p>
          <p><button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button></p>

          <!-- Update Profile Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Update Profile</h4>
                </div>
                <div class="modal-body">
                  <form method="POST">
                    <div class="form-group">
                      <label for="full_name">Full Name:</label>
                      <input type="hidden" value="<?php echo $rows['owner_id']; ?>" name="owner_id">
                      <input type="text" class="form-control" id="full_name" value="<?php echo $rows['full_name']; ?>" name="full_name">
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" id="email" value="<?php echo $rows['email']; ?>" name="email" readonly>
                    </div>
                    <div class="form-group">
                      <label for="phone_no">Phone No.:</label>
                      <input type="text" class="form-control" id="phone_no" value="<?php echo $rows['phone_no']; ?>" name="phone_no">
                    </div>
                    <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" id="address" value="<?php echo $rows['address']; ?>" name="address">
                    </div>
                    <div class="form-group">
                      <label for="id_type">Type of ID:</label>
                      <input type="text" class="form-control" value="<?php echo $rows['id_type']; ?>" name="id_type" readonly>
                    </div>
                    <div class="form-group">
                      <label>Your Id:</label><br>
                      <img src="../<?php echo $rows['id_photo']; ?>" height="100px" readonly>
                    </div>
                    <hr>
                    <center><button id="submit" name="owner_update" class="btn btn-primary btn-block">Update</button></center><br>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php 
          }
        } 
        ?>
      </div>
    </div>

    <!-- Messages Tab -->
    <div id="messages" class="tab-pane fade">
      <div class="container">
        <center><h3>See Messages</h3></center>
        <?php 
        $owner_id = $_SESSION['owner_id'];
        $sql1 = "SELECT DISTINCT tenant_id FROM chat WHERE owner_id='$owner_id'";
        $query1 = mysqli_query($db, $sql1);

        if (mysqli_num_rows($query1) > 0) {
          while ($row = mysqli_fetch_assoc($query1)) {
            $tenant_id = $row['tenant_id'];
            $sql2 = "SELECT * FROM tenant WHERE tenant_id='$tenant_id'";
            $query2 = mysqli_query($db, $sql2);

            if (mysqli_num_rows($query2) > 0) {
              while ($tenant = mysqli_fetch_assoc($query2)) {
                $tenant_name = $tenant['full_name'];
        ?>
        <div class="tab">   
          <button class="tablinks" onclick="openTab(event, '<?php echo $tenant_name; ?>')">
            <?php echo $tenant_name; ?> - <?php echo $tenant['email']; ?>
          </button>
        </div>
        <div id="<?php echo $tenant_name; ?>" class="tabcontent">
          <h4><?php echo $tenant_name; ?></h4>
          <p>Email: <?php echo $tenant['email']; ?></p>
          <p>Address: <?php echo $tenant['address']; ?></p>
          <?php
            $sql3 = "SELECT * FROM chat WHERE tenant_id='$tenant_id' AND owner_id='$owner_id' ORDER BY created_at ASC";
            $query3 = mysqli_query($db, $sql3);

            if (mysqli_num_rows($query3) > 0) {
              while ($message = mysqli_fetch_assoc($query3)) {
                echo "<div class='message'><strong>Message:</strong> " . htmlspecialchars($message['message']) . "<br><small>" . $message['created_at'] . "</small></div>";
              }
            } else {
              echo "<p>No messages found.</p>";
            }
          ?>
          <form method="POST" action="reply.php">
            <input type="hidden" name="owner_id" value="<?php echo $owner_id; ?>">
            <input type="hidden" name="tenant_id" value="<?php echo $tenant_id; ?>">
            <textarea name="reply_message" rows="4" style="width: 100%;" placeholder="Type your reply here..."></textarea>
            <input type="submit" class="btn btn-lg btn-primary" name="send_reply" style="width: 100%" value="Send Reply">
          </form>
        </div>
        <div class="clearfix"></div>
        <?php
              }
            }
          }
        } else {
          echo "<p>No messages found.</p>";
        }
        ?>
      </div>
    </div>

    <!-- Add Property Tab -->
    <div id="add-property" class="tab-pane fade">
      <center><h3>Add Property</h3></center>
      <div class="container">
        <form method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" class="form-control" id="country" name="country" value="Spain" readonly>
              </div>
              <div class="form-group">
                <label for="province">Province:</label>
                <input type="text" class="form-control" id="province" name="province" value="Catalonia" readonly>
              </div>
              <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="Barcelona" readonly>
              </div>
              <div class="form-group">
                <label for="district">District:</label>
                <input type="text" class="form-control" id="district" name="district" required>
              </div>
              <div class="form-group">
                <label for="zone">Zone:</label>
                <input type="text" class="form-control" id="zone" name="zone" required>
              </div>
              <div class="form-group">
                <label for="vdc_municipality">VDC/Municipality:</label>
                <input type="text" class="form-control" id="vdc_municipality" name="vdc_municipality" required>
              </div>
              <div class="form-group">
                <label for="ward_no">Ward No.:</label>
                <input type="text" class="form-control" id="ward_no" name="ward_no" required>
              </div>
              <div class="form-group">
                <label for="tole">Tole:</label>
                <input type="text" class="form-control" id="tole" name="tole" required>
              </div>
              <div class="form-group">
                <label for="contact_no">Contact No.:</label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" required>
              </div>
              <div class="form-group">
                <label for="property_type">Property Type:</label>
                <select class="form-control" name="property_type" required>
                  <option value="Full House Rent">Full House Rent</option>
                  <option value="Flat Rent">Flat Rent</option>
                  <option value="Room Rent">Room Rent</option>
                </select>
              </div>
              <div class="form-group">
                <label for="estimated_price">Estimated Price:</label>
                <input type="number" class="form-control" id="estimated_price" name="estimated_price" required>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="total_rooms">Total No. of Rooms:</label>
                <input type="number" class="form-control" id="total_rooms" name="total_rooms" required>
              </div>
              <div class="form-group">
                <label for="bedroom">No. of Bedroom:</label>
                <input type="number" class="form-control" id="bedroom" name="bedroom" required>
              </div>
              <div class="form-group">
                <label for="living_room">No. of Living Room:</label>
                <input type="number" class="form-control" id="living_room" name="living_room" required>
              </div>
              <div class="form-group">
                <label for="kitchen">No. of Kitchen:</label>
                <input type="number" class="form-control" id="kitchen" name="kitchen" required>
              </div>
              <div class="form-group">
                <label for="bathroom">No. of Bathroom/Washroom:</label>
                <input type="number" class="form-control" id="bathroom" name="bathroom" required>
              </div>
              <div class="form-group">
                <label for="description">Full Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
              </div>
              <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="text" class="form-control" id="latitude" name="latitude" readonly required>
              </div>
              <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="text" class="form-control" id="longitude" name="longitude" readonly required>
              </div>
              <button type="button" class="btn btn-success" onclick="getLocation()">Get Latitude and Longitude</button>
              <table class="table" id="dynamic_field">
                <tr>
                  <td><input type="file" name="p_photo[]" class="form-control name_list" required accept="image/*"></td>
                  <td><button type="button" id="add" class="btn btn-success">Add More</button></td>
                </tr>
              </table>
              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-lg" value="Add Property" name="add_property">
              </div>
            </div>
          </div>
        </form>
        <br><br>
      </div>
    </div>

    <!-- View Property Tab -->
    <div id="view-property" class="tab-pane fade">
      <center><h3>View Property</h3></center>
      <div class="container-fluid">
        <input type="text" id="myInput" onkeyup="filterTable('propertyTable')" placeholder="Search..." title="Type in a name">
        <div style="overflow-x:auto;">
          <table id="propertyTable" class="table table-striped">
            <thead>
              <tr class="header">
                <th>Id</th>
                <th>Country</th>
                <th>Province</th>
                <th>City</th>
                <th>District</th>
                <th>Ward No</th>
                <th>Contact No</th>
                <th>Property Type</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Estimated Price</th>
                <th>Total Rooms</th>
                <th>Bedroom</th>
                <th>Living Room</th>
                <th>Kitchen</th>
                <th>Bathroom</th>
                <th>Description</th>
                <th>Photos</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $u_email = $_SESSION["email"];
              $sql1 = "SELECT * FROM owner WHERE email='$u_email'";
              $result1 = mysqli_query($db, $sql1);
              if (mysqli_num_rows($result1) > 0) {
                  $rowss = mysqli_fetch_assoc($result1);
                  $owner_id = $rowss['owner_id'];

                  $sql = "SELECT * FROM add_property WHERE owner_id='$owner_id'";
                  $result = mysqli_query($db, $sql);

                  if (mysqli_num_rows($result) > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                      $property_id = $rows['property_id'];
              ?>
              <tr>
                <td><?php echo $rows['property_id']; ?></td>
                <td><?php echo $rows['country']; ?></td>
                <td><?php echo $rows['province']; ?></td>
                <td><?php echo $rows['city']; ?></td>
                <td><?php echo $rows['district']; ?></td>
                <td><?php echo $rows['ward_no']; ?></td>
                <td><?php echo $rows['contact_no']; ?></td>
                <td><?php echo $rows['property_type']; ?></td>
                <td><?php echo $rows['latitude']; ?></td>
                <td><?php echo $rows['longitude']; ?></td>
                <td><?php echo $rows['estimated_price']; ?></td>
                <td><?php echo $rows['total_rooms']; ?></td>
                <td><?php echo $rows['bedroom']; ?></td>
                <td><?php echo $rows['living_room']; ?></td>
                <td><?php echo $rows['kitchen']; ?></td>
                <td><?php echo $rows['bathroom']; ?></td>
                <td><?php echo $rows['description']; ?></td>
                <td>
                  <?php 
                  $sql2 = "SELECT * FROM property_photo WHERE property_id='$property_id'";
                  $query = mysqli_query($db, $sql2);

                  if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                  ?>
                  <img src="<?php echo $row['p_photo']; ?>" width="50px">
                  <?php 
                    }
                  } 
                  ?>
                </td>
              </tr>
              <?php 
                }
              } 
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Update Property Tab -->
    <div id="update-property" class="tab-pane fade">
      <center><h3>Update Property</h3></center>
      <div class="container-fluid">
        <input type="text" id="myInput" onkeyup="filterTable('propertyTable')" placeholder="Search..." title="Type in a name">
        <div style="overflow-x:auto;">
          <table id="propertyTable" class="table table-striped">
            <thead>
              <tr class="header">
                <th>Id</th>
                <th>Country</th>
                <th>Province</th>
                <th>City</th>
                <th>District</th>
                <th>Ward No</th>
                <th>Contact No</th>
                <th>Property Type</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Estimated Price</th>
                <th>Total Rooms</th>
                <th>Bedroom</th>
                <th>Living Room</th>
                <th>Kitchen</th>
                <th>Bathroom</th>
                <th>Description</th>
                <th>Photos</th>
                <th>Edit/Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $sql = "SELECT * FROM add_property WHERE owner_id='$owner_id'";
              $result = mysqli_query($db, $sql);

              if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                  $property_id = $rows['property_id'];
              ?>
              <tr>
                <td><?php echo $rows['property_id']; ?></td>
                <td><?php echo $rows['country']; ?></td>
                <td><?php echo $rows['province']; ?></td>
                <td><?php echo $rows['city']; ?></td>
                <td><?php echo $rows['district']; ?></td>
                <td><?php echo $rows['ward_no']; ?></td>
                <td><?php echo $rows['contact_no']; ?></td>
                <td><?php echo $rows['property_type']; ?></td>
                <td><?php echo $rows['latitude']; ?></td>
                <td><?php echo $rows['longitude']; ?></td>
                <td><?php echo $rows['estimated_price']; ?></td>
                <td><?php echo $rows['total_rooms']; ?></td>
                <td><?php echo $rows['bedroom']; ?></td>
                <td><?php echo $rows['living_room']; ?></td>
                <td><?php echo $rows['kitchen']; ?></td>
                <td><?php echo $rows['bathroom']; ?></td>
                <td><?php echo $rows['description']; ?></td>
                <td>
                  <?php 
                  $sql2 = "SELECT * FROM property_photo WHERE property_id='$property_id'";
                  $query = mysqli_query($db, $sql2);

                  if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                  ?>
                  <img src="<?php echo $row['p_photo']; ?>" width="50px">
                  <?php 
                    }
                  } 
                  ?>
                </td>
                <td>
                  <button type="button" class="btn btn-success" onclick="editProperty(<?php echo $rows['property_id']; ?>)">Edit</button>
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="property_id" value="<?php echo $rows['property_id']; ?>">
                    <input type="submit" class="btn btn-danger" name="delete_property" value="Delete">
                  </form>
                </td>
              </tr>
              <?php 
                }
              } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Booked Property Tab -->
    <div id="booked-property" class="tab-pane fade">
      <center><h3>Booked Property</h3></center>
      <div class="container">
        <input type="text" id="myInput" onkeyup="filterTable('bookedTable')" placeholder="Search..." title="Type in a name">
        <div style="overflow-x:auto;">
          <table id="bookedTable" class="table table-striped">
            <thead>
              <tr class="header">
                <th>Booked By</th>
                <th>Booker Address</th>
                <th>Property Type</th>
                <th>Property Address</th>
                <th>Property Province</th>
                <th>Property District</th>
                <th>Property Zone</th>
                <th>Property Ward No</th>
                <th>Property Tole</th>
                <th>Estimated Price</th>
                <th>Total Rooms</th>
                <th>Bedrooms</th>
                <th>Living Room</th>
                <th>Kitchen</th>
                <th>Bathroom</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $sql3 = "SELECT * FROM booking WHERE owner_id='$owner_id'";
              $result3 = mysqli_query($db, $sql3);

              if (mysqli_num_rows($result3) > 0) {
                while ($rows = mysqli_fetch_assoc($result3)) {
                  $tenant_id = $rows['tenant_id'];
                  $property_id = $rows['property_id'];

                  $sql1 = "SELECT * FROM tenant WHERE tenant_id='$tenant_id'";
                  $result1 = mysqli_query($db, $sql1);

                  if (mysqli_num_rows($result1) > 0) {
                    $tenant = mysqli_fetch_assoc($result1);

                    $sql2 = "SELECT * FROM add_property WHERE property_id='$property_id'";
                    $result2 = mysqli_query($db, $sql2);

                    if (mysqli_num_rows($result2) > 0) {
                      $property = mysqli_fetch_assoc($result2);
              ?>
              <tr>
                <td><?php echo $tenant['full_name']; ?></td>
                <td><?php echo $tenant['address']; ?></td>
                <td><?php echo $property['property_type']; ?></td>
                <td><?php echo $property['address']; ?></td>
                <td><?php echo $property['province']; ?></td>
                <td><?php echo $property['district']; ?></td>
                <td><?php echo $property['zone']; ?></td>
                <td><?php echo $property['ward_no']; ?></td>
                <td><?php echo $property['tole']; ?></td>
                <td><?php echo $property['estimated_price']; ?></td>
                <td><?php echo $property['total_rooms']; ?></td>
                <td><?php echo $property['bedroom']; ?></td>
                <td><?php echo $property['living_room']; ?></td>
                <td><?php echo $property['kitchen']; ?></td>
                <td><?php echo $property['bathroom']; ?></td>
                <td><?php echo $property['description']; ?></td>
              </tr>
              <?php 
                    }
                  }
                }
              } 
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Property Modal -->
<div class="modal fade" id="editPropertyModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Property</h4>
      </div>
      <div class="modal-body">
        <form id="editPropertyForm" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="edit_property_id" name="property_id">
          <div class="form-group">
            <label for="edit_country">Country:</label>
            <input type="text" class="form-control" id="edit_country" name="country" readonly>
          </div>
          <div class="form-group">
            <label for="edit_province">Province:</label>
            <input type="text" class="form-control" id="edit_province" name="province" readonly>
          </div>
          <div class="form-group">
            <label for="edit_city">City:</label>
            <input type="text" class="form-control" id="edit_city" name="city" readonly>
          </div>
          <div class="form-group">
            <label for="edit_district">District:</label>
            <input type="text" class="form-control" id="edit_district" name="district" required>
          </div>
          <div class="form-group">
            <label for="edit_zone">Zone:</label>
            <input type="text" class="form-control" id="edit_zone" name="zone" required>
          </div>
          <div class="form-group">
            <label for="edit_vdc_municipality">VDC/Municipality:</label>
            <input type="text" class="form-control" id="edit_vdc_municipality" name="vdc_municipality" required>
          </div>
          <div class="form-group">
            <label for="edit_ward_no">Ward No.:</label>
            <input type="text" class="form-control" id="edit_ward_no" name="ward_no" required>
          </div>
          <div class="form-group">
            <label for="edit_tole">Tole:</label>
            <input type="text" class="form-control" id="edit_tole" name="tole" required>
          </div>
          <div class="form-group">
            <label for="edit_contact_no">Contact No.:</label>
            <input type="text" class="form-control" id="edit_contact_no" name="contact_no" required>
          </div>
          <div class="form-group">
            <label for="edit_property_type">Property Type:</label>
            <select class="form-control" id="edit_property_type" name="property_type" required>
              <option value="Full House Rent">Full House Rent</option>
              <option value="Flat Rent">Flat Rent</option>
              <option value="Room Rent">Room Rent</option>
            </select>
          </div>
          <div class="form-group">
            <label for="edit_estimated_price">Estimated Price:</label>
            <input type="number" class="form-control" id="edit_estimated_price" name="estimated_price" required>
          </div>
          <div class="form-group">
            <label for="edit_total_rooms">Total No. of Rooms:</label>
            <input type="number" class="form-control" id="edit_total_rooms" name="total_rooms" required>
          </div>
          <div class="form-group">
            <label for="edit_bedroom">No. of Bedroom:</label>
            <input type="number" class="form-control" id="edit_bedroom" name="bedroom" required>
          </div>
          <div class="form-group">
            <label for="edit_living_room">No. of Living Room:</label>
            <input type="number" class="form-control" id="edit_living_room" name="living_room" required>
          </div>
          <div class="form-group">
            <label for="edit_kitchen">No. of Kitchen:</label>
            <input type="number" class="form-control" id="edit_kitchen" name="kitchen" required>
          </div>
          <div class="form-group">
            <label for="edit_bathroom">No. of Bathroom/Washroom:</label>
            <input type="number" class="form-control" id="edit_bathroom" name="bathroom" required>
          </div>
          <div class="form-group">
            <label for="edit_description">Full Description:</label>
            <textarea class="form-control" id="edit_description" name="description" required></textarea>
          </div>
          <div class="form-group">
            <label for="edit_latitude">Latitude:</label>
            <input type="text" class="form-control" id="edit_latitude" name="latitude" readonly required>
          </div>
          <div class="form-group">
            <label for="edit_longitude">Longitude:</label>
            <input type="text" class="form-control" id="edit_longitude" name="longitude" readonly required>
          </div>
          <button type="button" class="btn btn-success" onclick="getLocationEdit()">Get Latitude and Longitude</button>
          <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg" value="Update Property" name="update_property">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  document.getElementById("latitude").value = position.coords.latitude;
  document.getElementById("longitude").value = position.coords.longitude;
}

function getLocationEdit() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPositionEdit);
  } else { 
    alert("Geolocation is not supported by this browser.");
  }
}

function showPositionEdit(position) {
  document.getElementById("edit_latitude").value = position.coords.latitude;
  document.getElementById("edit_longitude").value = position.coords.longitude;
}

function filterTable(tableId) {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById(tableId);
  tr = table.getElementsByTagName("tr");
  th = table.getElementsByTagName("th");
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none";
    for (j = 0; j < th.length; j++) {
      td = tr[i].getElementsByTagName("td")[j];      
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        }
      }
    }
  }
}

$(document).ready(function(){  
  var i = 1;  
  $('#add').click(function(){  
    i++;  
    $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="file" name="p_photo[]" class="form-control name_list" required accept="image/*"></td><td><button type="button" class="btn btn-danger btn_remove" id="'+i+'">X</button></td></tr>'); 
  });  

  $(document).on('click', '.btn_remove', function(){  
    var button_id = $(this).attr("id");   
    $('#row'+button_id+'').remove();  
  });  
});

function editProperty(propertyId) {
  $.ajax({
    url: 'fetch_property.php', // This file will fetch the property details
    type: 'POST',
    data: { property_id: propertyId },
    success: function(response) {
      var property = JSON.parse(response);
      $('#edit_property_id').val(property.property_id);
      $('#edit_country').val(property.country);
      $('#edit_province').val(property.province);
      $('#edit_city').val(property.city);
      $('#edit_district').val(property.district);
      $('#edit_zone').val(property.zone);
      $('#edit_vdc_municipality').val(property.vdc_municipality);
      $('#edit_ward_no').val(property.ward_no);
      $('#edit_tole').val(property.tole);
      $('#edit_contact_no').val(property.contact_no);
      $('#edit_property_type').val(property.property_type);
      $('#edit_estimated_price').val(property.estimated_price);
      $('#edit_total_rooms').val(property.total_rooms);
      $('#edit_bedroom').val(property.bedroom);
      $('#edit_living_room').val(property.living_room);
      $('#edit_kitchen').val(property.kitchen);
      $('#edit_bathroom').val(property.bathroom);
      $('#edit_description').val(property.description);
      $('#edit_latitude').val(property.latitude);
      $('#edit_longitude').val(property.longitude);
      $('#editPropertyModal').modal('show');
    }
  });
}

function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>
