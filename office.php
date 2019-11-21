<?php
require_once 'requires/head.php';
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST">

<!--Names -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Firstname:</label>
      <input type="text" class="form-control" id="inputEmail4" name="fname" placeholder="Firstname">
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Surname:</label>
      <input type="text" class="form-control" id="inputPassword4" name="lname" placeholder="Surname">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Username</label>
      <input type="text" class="form-control" id="inputEmail4" name="userName" placeholder="Username">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="user@email.com">
    </div>
  </div>

  <!--Staff details -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Staff ID:</label>
      <input type="text" class="form-control" id="inputEmail4" name="staff_id" placeholder="Staff ID">
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Role:</label>
      <select type="text" class="form-control" id="inputPassword4" name="role">

</select>

    </div>
  </div>

  <!--phones -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Phone:</label>
      <input type="Number" class="form-control" id="inputEmail4" name="phone" placeholder="0240000000">
    </div>

    <div class="form-group col-md-6">
      <label for="">Phone 2:</label>
      <input type="Number" class="form-control" id="inputPassword4" name="phone1" placeholder="0240000000">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Phone:</label>
      <textarea type="text" class="form-control" id="inputEmail4" row="100" col="100" name="address" placeholder="Address">
</textarea>
    </div>
   </div>

  <!--// -->

  

      </div>
<div class="modal-footer">
        <button type="submit" name="newUser" class="btn btn-lg btn-block btn-outline-dark">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Office</li>
        </ol>
        <button class="btn btn-lg btn-block btn-outline-dark"  data-toggle="modal" data-target="#exampleModal" >Add A New User</button>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Staff ID</th>
                    <th>Rank</th>
                    <th>Date Added</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Staff ID</th>
                    <th>Rank</th>
                    <th>Date Added</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                    <td>Edinburgh</td>
                    
                    
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011/07/25</td>
                    <td>$170,750</td>
                    <td>Edinburgh</td>
                    
                   
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Junior Technical Author</td>
                    <td>San Francisco</td>
                    <td>66</td>
                    <td>2009/01/12</td>
                    <td>$86,000</td>
                    <td>Edinburgh</td>
                    
                    
                  </tr>
                  
                  </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

      </div>
      <!-- /.container-fluid -->

      <?php
require 'requires/footer.php';
      ?>
