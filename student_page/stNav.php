
<header class="p-3  bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <a class="navbar-brand" href="#" style="color: #FFFF;">|Roommate |Recommendation</a>
          <li><a href="index_st.php?u_ID=<?php echo $_SESSION['u_ID'] ?>" class="nav-link px-2 link-active text-white">
            
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z"/>
          </svg>
          หน้าแรก</a></li>
          <li><a href="domitory.php?u_ID=<?php echo $_SESSION['u_ID'] ?>" class="nav-link px-2 link-white text-white">หอพักทั้งหมด</a></li>
          <li><a href="checkForm.php?u_ID=<?php echo $_SESSION['u_ID']; ?>" class="nav-link px-2 link-white text-white">ตอบแบบสอบถาม</a></li>
        </ul>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <?php
              isset($row['st_pic']) ? $row['st_pic'] : $row['st_pic'] = 'default.png';
              $dir = '../uploads/';
              $fileImage_st = $dir . basename($row['st_pic']);
              if($row['st_pic'] == null){

                  echo "<img src='../uploads/default.png' alt='profile Pic' width='32' height='32' class='rounded-circle'>";

              }else{
                  echo "<img src='$fileImage_st' width='32' height='32' class='rounded-circle'>";                  
                      }
              ?>
            <span class="text-white"><?php echo $_SESSION['username']; ?></span>
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="profile_st.php?u_ID=<?php echo $_SESSION['u_ID']; ?>
            ">ตั้งค่าบัญชีผู้ใช้</a></li>
            <li><a class="dropdown-item" href="answer_form.php?userid=u_ID=<?php echo $_SESSION['u_ID']; ?>
            ">ประวัติการตอบ</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../login/login.php">ออกจากระบบ</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>