<?php
include("../../auth/authenticationForUser.php");
include("../../dB/config.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];
    $roomId = $_POST['roomId'];
    $paymentMethod = $_POST['paymentMethod'];
    $numberOfGuests = $_POST['numberOfGuests'];


    // Ensure user is logged in
    if (!isset($_SESSION['authUser']['userId'])) {
        die("User not logged in.");
    }
    $userId = $_SESSION['authUser']['userId'];

    // Default payment status
    $paymentStatus = "Pending";

    // Insert into database
    $sql = "INSERT INTO reservations (userId, roomId, checkIn, checkOut, numberOfGuests, booked_at, paymentMethod, paymentStatus) 
            VALUES ('$userId', '$roomId', '$checkIn', '$checkOut', '$numberOfGuests', NOW(), '$paymentMethod', '$paymentStatus')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Booking successful!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}


?>


<!-- General Form Elements -->
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Find Your Perfect Stay</h5>

            <form method="POST" action="bookAroom.php">
            <div class="row mb-3">
                <label for="checkIn" class="col-sm-2 col-form-label">Check-IN Date</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" name="checkIn" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="checkOut" class="col-sm-2 col-form-label">Check-OUT Date</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" name="checkOut" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="roomId" class="col-sm-2 col-form-label">Room Type</label>
                <div class="col-sm-10">
                <select class="form-select" name="roomId" required>
                    <option selected disabled>Select Room Type</option>
                    <option value="1">Single Room</option>
                    <option value="2">Standard Room</option>
                    <option value="3">Family Room</option>
                    <option value="4">Executive Room</option>
                    <option value="5">Deluxe Suite</option>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="numberOfGuests" class="col-sm-2 col-form-label">Number of Guests</label>
                <div class="col-sm-10">
                <select class="form-select" name="numberOfGuests" required>
                    <option selected disabled>Number of Guests</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="paymentMethod" class="col-sm-2 col-form-label">Payment Method</label>
                <div class="col-sm-10">
                <select class="form-select" name="paymentMethod" required>
                    <option selected disabled>Select Payment Method</option>
                    <option value="1">Credit Card</option>
                    <option value="2">Debit Card</option>
                    <option value="3">Bank Transfer</option>
                    <option value="4">Pay at Hotel</option>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Terms & Conditions</legend>
                <div class="col-sm-10">

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="terms" required>
                    <label class="form-check-label">
                    I agree to the terms and conditions of Lume Manor.
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