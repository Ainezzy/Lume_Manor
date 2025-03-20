<?php
include("../../auth/authenticationForUser.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");
?>

<section class="section">
    <div class="row">
        <!-- Facility Reservations Table -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Facility Reservations</h5>
                    <p>Reserve our premium hotel facilities to enhance your stay at Lume Manor. Whether you're looking for a relaxing spa, a fully equipped gym, or a luxurious swimming pool, we offer top-tier amenities to make your experience unforgettable.</p>

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Facility</th>
                                <th>Description</th>
                                <th>Price (PHP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Spa & Wellness</td>
                                <td>Access to sauna, jacuzzi, and massage therapy</td>
                                <td>1,500.00</td>
                            </tr>
                            <tr>
                                <td>Swimming Pool</td>
                                <td>Day pass for pool access with towel service</td>
                                <td>500.00</td>
                            </tr>
                            <tr>
                                <td>Fitness Center</td>
                                <td>Gym access with personal trainer (optional)</td>
                                <td>800.00</td>
                            </tr>
                            <tr>
                                <td>Conference Room</td>
                                <td>Meeting space with audio-visual setup</td>
                                <td>2,000.00/hour</td>
                            </tr>
                            <tr>
                                <td>Event Hall</td>
                                <td>Spacious hall for weddings, parties, and corporate events</td>  
                                <td>5,000.00/hour</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Facility Reservation Form -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Reserve a Facility</h5>
                    <form>
                        <div class="row mb-3">
                            <label for="guestName" class="col-sm-2 col-form-label">Guest Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="guestName">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="roomNumber" class="col-sm-2 col-form-label">Room Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="roomNumber">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Facility</label>
                            <div class="col-sm-10">
                                <select class="form-select">
                                    <option selected>Select Facility</option>
                                    <option value="1">Spa & Wellness</option>
                                    <option value="2">Swimming Pool</option>
                                    <option value="3">Fitness Center</option>
                                    <option value="4">Conference Room</option>
                                    <option value="5">Event Hall</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="reservationTime" class="col-sm-2 col-form-label">Preferred Time</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="reservationTime">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Payment Method</label>
                            <div class="col-sm-10">
                                <select class="form-select">
                                    <option selected>Select Payment Method</option>
                                    <option value="1">Credit Card</option>
                                    <option value="2">Debit Card</option>
                                    <option value="3">Bank Transfer</option>
                                    <option value="4">Pay at Hotel</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
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