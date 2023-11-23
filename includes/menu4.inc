<nav>
  <ul>
    <li><a href="staff.php">Edit Orders</a></li>
    <li><a href="booking.php">View Orders</a></li>
    <li class="dropdown">
      <?php
      session_start();
 if (isset($_SESSION['staff_name'])) {
        $staffName = $_SESSION['staff_name'];
        echo '<a href="#" class="dropbtn">Welcome, ' . $staffName . '</a>';
      } else {
        echo '<a href="#" class="dropbtn">Welcome</a>';
      }

      ?>
      <div class="dropdown-content">
        <a href="managerlogout.php">Logout</a>
      </div>
    </li>
  </ul>
</nav>
</div>
</header>
