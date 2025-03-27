  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">
    <div class="d-flex align-items-center justify-content-between sidebar-logo">
    
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../../assets/img/biggerLogo.png" alt="Lume Manor" class="logo-img">
      </a>
      
    </div><!-- End Logo -->
    <li class="nav-heading">Main</li>

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-heading">Pages</li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="facilities.php">
          <i class="bi bi-person"></i>
          <span>Facilities Management</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link " href="rooms.php">
          <i class="bi-door-closed"></i>
          <span>Room Management</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link " href="bookings.php">
          <i class="bi-calendar-check"></i>
          <span>Booking Management</span>
        </a>
      </li><!-- End Dashboard Nav -->

      

    </ul>

  </aside><!-- End Sidebar-->

    <style>
  /* Sidebar Background */
  .sidebar {
      background-color: #222D17;
      color: white; /* Default text color */
      height: 100vh; /* Full height */
      padding: 20px;
  }

  /* Sidebar Nav Items */
  .sidebar-nav .nav-link {
      color: white !important; /* Force white text */
      background-color: #222D17 !important; /* Match sidebar bg */
      padding: 12px 15px;
      display: flex;
      align-items: center;
      gap: 10px;
      border-radius: 5px;
      transition: background 0.3s ease, color 0.3s ease;
  }

  /* Sidebar Icons */
  .sidebar-nav .nav-link i {
      color: white !important; /* Force white icons */
      font-size: 1.2rem;
  }

  /* Hover Effect - Lighter Shade of Background */
  .sidebar-nav .nav-link:hover {
      background-color: #2E3B20 !important; /* Slightly lighter shade */
      color: white !important;
  }

  /* Active Link - Gold Highlight */
  .sidebar-nav .nav-link.active, 
  .sidebar-nav .nav-link[aria-current="page"] {
      background-color: #BB9C34 !important;
      color: white !important;
  }

  /* Active Icons */
  .sidebar-nav .nav-link.active i {
      color: white !important;
  }

  /* Dropdown Menu inside Sidebar */
  .sidebar-nav .nav-content {
      background-color: #222D17 !important;
      padding-left: 20px;
  }

  /* Dropdown Links */
  .sidebar-nav .nav-content a {
      color: white !important;
  }

  /* Dropdown Hover */
  .sidebar-nav .nav-content a:hover {
      color: #BB9C34 !important;
  }

  .sidebar-logo {
    padding: 15px;
    text-align: center;
  }

  .sidebar-logo img.logo-img {
    width: 800px; /* Adjust the size as needed */
    max-width: 80%;
    height: auto;
    display: block;
    margin: 0 auto;
  }

</style>

  <main id="main" class="main">