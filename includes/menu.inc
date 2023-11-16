<nav>
  <ul>
    <li><a href="index.php">Home</a></li>
    <li class="dropdown">
      <a href="#" class="dropbtn">Movie&Theme</a>
      <div class="dropdown-content">
        <h16>Movies</h16>
        <a href="m_endgame.php">Avengers: Endgame</a>
        <a href="m_mission.php">Mission: Impossible</a>
        <a href="m_transformers.php">Transformers: Rise of the Beasts</a>
        <br>
        <h16>Theme Rooms</h16>
        <a href="theme1.php">Star Wars</a>
        <a href="theme2.php">Batman</a>
        <a href="theme3.php">Jurassic Park</a>
      </div>
    </li>

    <li><a href="currentbook.php">My Bookings</a></li>

    <li class="dropdown">
      <?php
      session_start();
      if (isset($_SESSION['cust_username'])) {
        echo '<a href="#" class="dropbtn">Welcome, ' . $_SESSION['cust_username'] . '</a>';
      } else {
        echo '<a href="#" class="dropbtn">Welcome</a>';
      }
      ?>
      <div class="dropdown-content">
        <a href="spinwheel.php">SpinWheel</a>
       <a href="faq.php">FAQ</a>
        <a href="customerlogout.php">Logout</a>
      </div>
    </li>
  </ul>
</nav>
</div>
</header>

