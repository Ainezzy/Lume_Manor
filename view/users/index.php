<?php
include("../../auth/authenticationForUser.php");
include("./includes/header.php");
include("./includes/topbar.php");
include("./includes/sidebar.php");


// Ensure user is logged in
if (!isset($_SESSION['authUser']['userId'])) {
    die("User not logged in.");
}
$userId = $_SESSION['authUser']['userId'];


$bookingOverview = null;
$bookingHistory = [];

if ($userId) {
    // Fetch Guest ID and Full Name from guests and users tables
    $guestQuery = "SELECT g.guest_id, CONCAT(u.firstName, ' ', u.lastName) AS guest_full_name
                   FROM guests g
                   JOIN users u ON g.user_id = u.userId
                   WHERE g.user_id = ?";
    
    $stmt = $conn->prepare($guestQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $guestResult = $stmt->get_result();
    $guest = $guestResult->fetch_assoc();
    $stmt->close();

    if (!empty($guest)) {
        $guest_id = $guest['guest_id'];
        $guest_full_name = $guest['guest_full_name']; // Store full name

        // Fetch most recent booking (Booking Overview)
        $overviewQuery = "SELECT 
                            b.booking_id, b.guest_id, r.room_type, r.room_number, 
                            b.check_in_date, b.check_out_date, 
                            DATEDIFF(b.check_out_date, b.check_in_date) AS nights_stayed,
                            p.amount AS total_paid
                          FROM bookings b
                          JOIN rooms r ON b.room_id = r.room_id
                          LEFT JOIN payments p ON b.payment_id = p.payment_id
                          WHERE b.guest_id = ?
                          ORDER BY b.check_in_date DESC
                          LIMIT 1"; 

        $stmt = $conn->prepare($overviewQuery);
        $stmt->bind_param("i", $guest_id);
        $stmt->execute();
        $overviewResult = $stmt->get_result();
        $bookingOverview = $overviewResult->fetch_assoc();
        $stmt->close();

        // Fetch booking history (Previous bookings)
        $historyQuery = "SELECT 
                            r.room_type, 
                            b.check_in_date, b.check_out_date, 
                            p.amount AS total_paid,
                            (SELECT GROUP_CONCAT(rs.room_service SEPARATOR ', ') 
                             FROM room_services rs 
                             WHERE rs.booking_id = b.booking_id) AS room_services
                         FROM bookings b
                         JOIN rooms r ON b.room_id = r.room_id
                         LEFT JOIN payments p ON b.payment_id = p.payment_id
                         WHERE b.guest_id = ?
                         ORDER BY b.check_in_date DESC";

        $stmt = $conn->prepare($historyQuery);
        $stmt->bind_param("i", $guest_id);
        $stmt->execute();
        $historyResult = $stmt->get_result();

        while ($row = $historyResult->fetch_assoc()) {
            $bookingHistory[] = $row;
        }
        $stmt->close();
    }
    else {
        echo "No guest record found for this user.";
        exit();
    }
}

$conn->close();
?>




   
   
<section class="section">
    <div class="row">
        <!-- Booking Overview (Left Side) -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking Overview</h5>

                    <?php if ($bookingOverview): ?>
                        <h6>📌 Booking Overview (Current Stay)</h6>
                        <ul>
                            <li><strong>Guest Name:</strong> <?= $guest_full_name ?></li>
                            <li><strong>Room Type:</strong> <?= $bookingOverview['room_type'] ?></li>
                            <li><strong>Room Number:</strong> <?= $bookingOverview['room_number'] ?></li>
                            <li><strong>Check-In Date:</strong> <?= $bookingOverview['check_in_date'] ?></li>
                            <li><strong>Check-Out Date:</strong> <?= $bookingOverview['check_out_date'] ?></li>
                            <li><strong>Nights Stayed:</strong> <?= $bookingOverview['nights_stayed'] ?> Nights</li>
                            <li><strong>Total Amount Paid:</strong> ₱<?= number_format($bookingOverview['total_paid'], 2) ?></li>
                        </ul>
                    <?php else: ?>
                        <p>No active bookings found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- End Booking Overview -->

        <!-- Booking History (Right Side) -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Booking History</h5>

                    <?php if (!empty($bookingHistory)): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Room Type</th>
                                    <th>Check-In Date</th>
                                    <th>Check-Out Date</th>
                                    <th>Room Services</th>
                                    <th>Total Paid</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookingHistory as $index => $history): ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td><?= $history['room_type'] ?></td>
                                        <td><?= $history['check_in_date'] ?></td>
                                        <td><?= $history['check_out_date'] ?></td>
                                        <td><?= $history['room_services'] ?? 'None' ?></td>
                                        <td>₱<?= number_format($history['total_paid'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No booking history found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- End Booking History -->
    </div> <!-- End Row -->

    <!-- Booking FAQs (Below) -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Frequently Asked Questions</h5>

                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Items -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What time is check-in and check-out?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="faqOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <strong>Check-in:</strong> 2:00 PM onwards<br>
                                    <strong>Check-out:</strong> Until 12:00 PM<br>
                                    Late check-out may be available upon request and subject to additional charges.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Can I modify or cancel my booking?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="faqTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, you can modify or cancel your booking by contacting our front desk or using the online booking system. Cancellation fees may apply based on the booking policy.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What amenities are included in my stay?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="faqThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Your stay includes free Wi-Fi, breakfast, pool & gym access, and daily housekeeping. Additional services like laundry and spa treatments are available at an extra charge.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- End Booking FAQs -->
    </div> <!-- End Row -->

</section>




<?php
include("./includes/footer.php");
?>