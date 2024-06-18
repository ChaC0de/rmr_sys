<div class="nav d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; " >
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
          <strong>
            Roommate | Recommendation System
            </strong>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="../admin/index_admin.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="../ad_index/index_admin.php"></use></svg>
              หน้าแรก
            </a>
          </li>
          <hr>
          <li>
            <a href="../dormitory/dorm_approval.php" class="nav-link text-white">
              คำร้องขอลงทะเบียนหอพัก
            </a>
          </li>
            <hr>
          <li>
            <a href="#" class="nav-link text-white">
              จัดการแบบสอบถาม
            </a>
            </li>
            <li>
              <a href="../dashboard/faculty.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="../dashboard/faculty.php"></use></svg>
              คณะการศึกษา
            </a>
            </li>

            <li>
              <a href="../question/showtenQues.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="../question/showtenQues.php"></use></svg>
              คำถาม-คำตอบ
            </a>
            </li>

            <li>
              <a href="../form/form.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="../form/form.php"></use></svg>
              แบบสอบถาม
            </a>
            </li>

          </li>
          <li>
              <a href="../form_answer/answerPage.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="../form_answer/answerPage.php"></use></svg>
              แบบสอบถามที่เปิดใช้งาน
            </a>
            </li>
          <li>
            <a href="../form_answer/ansList.php" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="../form_answer/ansList.php"></use></svg>
            การตอบกลับแบบสอบถาม
          </a>
          </li>
          </li>
            <hr>
            <li>
            <a href="#" class="nav-link text-white">
              จัดการข้อมูลหอพักในระบบ
            </a>
            </li>
          <li>
            <a href="../dormitory/showDorm.php" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="../dormitory/showDorm.php"></use></svg>
              หอพักที่ได้รับการอนุมัติแล้ว
            </a>
          </li>
          <li>
            <a href="../dormitory/addDorm.php" class="nav-link text-white">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="../dormitory/addDorm.php"></use></svg>
              เพิ่มหอพัก
            </a>
          </li>
          <hr>
          <li>
          <a href="#" class="nav-link text-white">
              จัดการบัญชีผู้ใช้ในระบบ
            </a>
          </li>
          
          <li>
            <a href="../tenant/tenList.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="../tenant/tenList.php"></use></svg>
              จัดการบัญชีนักศึกษา
              </a>
          </li>
          <li>
            <a href="../landlord/landList.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="../landlord/landList.php"></use></svg>
              จัดการบัญชีเจ้าของหอพัก
            </a>
          </li>
          <!-- <li>
            <a href="../admin/admin_list.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="../admin/admin_list.php"></use></svg>
              จัดการบัญชีผู้ดูแลระบบ
            </a>
          </li> -->
        </ul>
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../../img/propic.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>
              <?php echo $_SESSION['username']; ?>
            </strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="../admin/profile_admin.php?u_ID=<?php echo $_SESSION['u_ID']; ?>">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../../login/login.php">Sign out</a></li>
          </ul>
        </div>
      </div>


  

 