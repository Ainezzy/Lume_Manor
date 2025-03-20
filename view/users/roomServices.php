<?php
include("../../auth/authenticationForUser.php");
include("../../dB/config.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $roomNumber = $_POST['roomNumber'];
    $serviceType = $_POST['serviceType'];
    $specialRequest = $_POST['specialRequest'];
    $preferredTime = $_POST['preferredTime'];

    // Ensure user is logged in
    if (!isset($_SESSION['authUser']['userId'])) {
        die("User not logged in.");
    }
    $userId = $_SESSION['authUser']['userId'];

     // Get the latest guestId for the logged-in user
    $guestCheckQuery = "SELECT guestId FROM reservations WHERE userId = '$userId' ORDER BY guestId DESC LIMIT 1";
    $guestCheckResult = mysqli_query($conn, $guestCheckQuery);
    if (!$guestCheckResult || mysqli_num_rows($result) == 0) {
        die("No active booking found.");
    }
    $row = mysqli_fetch_assoc($guestCheckResult);
    $guestId = $row['guestId'];

    // Ensure roomNumber exists in the rooms table before inserting
    $roomCheckQuery = "SELECT roomNumber FROM rooms WHERE roomNumber = '$roomNumber'";
    $roomCheckResult = mysqli_query($conn, $roomCheckQuery);
    if (!$roomCheckResult || mysqli_num_rows($roomCheckResult) == 0) {
        die("Invalid room number. Please enter a valid room.");
    }

    // Insert into database (make sure table name and columns match your DB)
    $sql = "INSERT INTO roomservices(roomServiceId, roomNumber, guestId, serviceType, specialRequest, preferredTime) 
            VALUES ('$roomServiceId', '$roomNumber', '$guestId', '$serviceType', '$specialRequest', '$preferredTime')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('We've sent your room service request. Please wait.'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>

<section class="section">
    <div class="row">
        <!-- Table with stripped rows -->
        <div class="col-lg-12">

            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Room Service Menu & Pricing</h5>
                <p>Enjoy a variety of in-room services designed to make your stay at Lume Manor more convenient and relaxing. From delicious meals to housekeeping and special amenities, our room service ensures you have everything you need at your fingertips. Browse our offerings below and request services with ease.</p>

                <table class="table datatable">
                <thead>
                    <tr>
                        <th>Services</th>
                        <th>Description</th>
                        <th>Price (PHP)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Breakfast Set</td>
                        <td>Choice of Continental, American, or Filipino breakfast</td>
                        <td>350.00</td>
                    </tr>
                    <tr>
                        <td>Lunch/Dinner Meal</td>
                        <td>Rice meal with choice of chicken, beef, pork, or seafood</td>
                        <td>500.00</td>
                    </tr>
                    <tr>
                        <td>Snacks & Beverages</td>
                        <td>Sandwiches, pastries, coffee, tea, and soft drinks</td>
                        <td>250.00</td>
                    </tr>
                    <tr>
                        <td>Laundry Service</td>
                        <td>Washing, drying, and folding per kilo</td>
                        <td>150.00/kg</td>
                    </tr>
                    <tr>
                        <td>Housekeeping</td>
                        <td>Room cleaning, fresh towels, and linens</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td>Extra Pillow/Blanket/Bed</td>
                        <td>Additional pillow/blanket/bed upon request</td>
                        <td>100.00 each</td>
                    </tr>
                    <tr>
                        <td>Spa & Massage</td>
                        <td>In-room full body massage (60 mins)</td>
                        <td>1,200.00</td>
                    </tr>
                </tbody>
                </table>
                <!-- End Table with stripped rows -->

            </div>
            </div>

        </div>
        <!-- General Form Elements -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Find Your Perfect Stay</h5>

                    <form method="POST" action="roomServices.php">
                    <div class="row mb-3">
                        <label for="roomNumber" class="col-sm-2 col-form-label">Room Number</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="roomNumber" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="serviceType" class="col-sm-2 col-form-label">Room Service</label>
                        <div class="col-sm-10">
                        <select class="form-select" name="serviceType" required>
                            <option selected disabled>Select Service</option>
                            <option value="1">Breakfast Set</option>
                            <option value="2">Lunch/Dinner Meal</option>
                            <option value="3">Snacks & Beverages</option>
                            <option value="4">Laundry Service</option>
                            <option value="5">Housekeeping</option>
                            <option value="6">Extra Pillow/Blanket/Bed</option>
                            <option value="7">Spa & Massage</option>
                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="specialRequest" class="col-sm-2 col-form-label">Special Requests</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" name="specialRequest" style="height: 100px"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="preferredTime" class="col-sm-2 col-form-label">Preferred Service Time</label>
                        <div class="col-sm-10">
                        <select class="form-select" name="preferredTime" required>
                            <option selected disabled>Select Time</option>
                            <option value="1">Morning (8:00 to 10:00AM)</option>
                            <option value="2">Afternoon (11:00 to 5:00PM)</option>
                            <option value="3">Evening (6:00 to 9:00PM)</option>
                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Terms & Conditions</legend>
                        <div class="col-sm-10">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms" required>
                            <label class="form-check-label">
                            I agree to the service charges and policies of Lume Manor.
                            </label>
                        </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>

    </div>
</section>

<style>
  body {
    background-color: #F4F7EF;
  }
  /* Set font color */
  body, h1, h2, h3, h4, h5, h6, p, label, .form-label {
      color: #1e1e1e !important;
  }

  /* Change active text color */
  a, a:hover, a:focus {
      color: #BB9C34 !important;
  }

  /* Change button color */
  .btn-primary {
      background-color: #FBC741 !important;
      border-color: #FBC741 !important;
      color: #1e1e1e !important;
  }

  /* Button hover effect */
  .btn-primary:hover {
      background-color: #e0a830 !important;
      border-color: #e0a830 !important;
  }
</style>


<?php
include("./includes/footer.php");
?>