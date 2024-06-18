<header class="p-3 text-white" style="background-color: #FF9EAA;">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <a class="navbar-brand" href="#" style="color: #FFFF;">|Roommate |Recommendation</a>
          <li><a href="index_land.php?u_ID=<?php echo $_SESSION['u_ID']; ?>
          " class="nav-link px-2 link-secondary">หน้าแรก</a></li>
          <!-- <li><a href="#" class="nav-link px-2 link-dark">หอพักทั้งหมด</a></li> -->
        </ul>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <?php 
              if($row['land_pic'] == null){
                  echo "<img src='../uploads/default.png' alt='profile Pic' width='32' height='32' class='rounded-circle'>";

              }else{
                  echo "<img src='$fileImage_LAND' width='32' height='32' class='rounded-circle'>";
                  
                      }
              ?>            
              <?php echo $_SESSION['username']; ?>
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="profile_land.php?u_ID=<?php echo $_SESSION['u_ID']; ?>">ตั้งค่าบัญชีผู้ใช้</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../login/logout.php">ออกจากระบบ</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
