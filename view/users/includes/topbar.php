<?php
include("../../auth/authenticationForUser.php");

// Ensure user is logged in
if (!isset($_SESSION['authUser']['userId'])) {
    die("User not logged in.");
}
$user_id = $_SESSION['authUser']['userId'];

// Query to fetch user's first name, last name, and role
$query = "SELECT firstName, lastName, role FROM users WHERE userId = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $user_name = $row['firstName'] . " " . $row['lastName']; // Combine first and last name
    $user_role = $row['role']; // Get user role
} else {
    $user_name = "Guest";
    $user_role = "User";
}
?>



<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <!-- <div class="d-flex align-items-center justify-content-between">
    
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="../../assets/img/Logo_TransparentBG .png" alt="">
      <span class="d-none d-lg-block">Lume Manor</span>
    </a>
    
  </div>End Logo -->

  <i class="bi bi-list toggle-sidebar-btn"></i>
  
  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      

      <li class="nav-item dropdown">



      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= htmlspecialchars($user_name) ?></span>
        </a><!-- End Profile Image Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
              <h6 style="color: white;"><?= htmlspecialchars($user_name) ?></h6>
              <span style="color: white;"><?= htmlspecialchars($user_role) ?></span>
          </li>
          <li>
              <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="./controller/logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

  <style>
    /* Topbar (Header) background color */
    #header {
      background-color: #222D17 !important;
    }

    /* Topbar text and icons color */
    #header, 
    #header .nav-link, 
    #header .nav-link i, 
    #header .logo span, 
    #header .badge-number {
      color: white !important;
    }

    /* Dropdown menu background */
    #header .dropdown-menu {
      background-color: #222D17 !important;
      border-color: #BB9C34 !important;
    }

    /* Dropdown text color */
    #header .dropdown-item {
      color: white !important;
    }

    #header .dropdown-item:hover {
      background-color: #BB9C34 !important;
      color: #222D17 !important;
    }

    .toggle-sidebar-btn {
      color: white !important;
    }
  </style>

</header><!-- End Header -->