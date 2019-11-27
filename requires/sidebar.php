<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li> 

      <!--like-admin-->
     <?php
     if($_SESSION['grp']=='1'){
//ordinary
include './includes/grps/ordinary.html';
     }

     if($_SESSION['grp']=='2'){
       //not-so-ordinary
       include './includes/grps/not_so-ordinary.html';
    }

    if($_SESSION['grp']=='3'){
       //like-admin
       include './includes/grps/like-admin.html';
    }

    if($_SESSION['grp']=='4'){
       //Admin
       include './includes/grps/admin.html';
    }
     
     ?>
      <!--Admin -->
      

       


     <!--EveryOne -->
     <div>
        <hr>
      <li class="nav-item">
        <a class="nav-link" href="records.php">
          <i class="fas fa-fw fa-database"></i>
          <span>Records</span></a>
      </li>
<li class="nav-item">
        <a class="nav-link" href="settings/logout.php?logout">
          <i class="fas fa-fw fa-arrow-left"></i>
          <span>Sign Out</span></a>
      </li>
      
      </div>
     
    </ul>