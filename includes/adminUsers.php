<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark" style="color:aliceblue;">
          <h5 class="modal-title " id="exampleModalLabel" >Add New User</h5>
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
  <option>Select</option>
  <?php
  while($rol=mysqli_fetch_array($role)){
    echo'<option value"'.$rol['role_id'].'">'.$rol['role_name'].'</option>';
  }
  ?>
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
  
    
      <div class="form-group">
        <label for="inputEmail4">Address:</label>
        <textarea type="text" class="form-control" id="inputEmail4" row="100" col="20" name="address" placeholder="Address">
  </textarea>
      </div>
  
    <!--admin-->
    <div class="form-row">
        <hr>
            <div class="form-group col-md-4">
              <label for="inputEmail4">Office</label>
              <input type="Number" class="form-control" id="inputEmail4" name="phone" placeholder="0240000000">
            </div>
        
            <div class="form-group col-md-4">
              <label for="">Rank:</label>
              <select type="text" class="form-control" name="rank">
              <option>Select</option>
  <?php
  while($rak=mysqli_fetch_array($rank)){
    
    echo'<option value"'.$rak['rank_id'].'">'.$rak['rank_title'].'</option>';
  }
  ?>

              </select>
            </div> 
            
            <div class="form-group col-md-4">
              <label for="">Account Type</label>
              <select name="group" type="text" class="form-control">
              <option>Select</option>
  <?php
  while($grp=mysqli_fetch_array($group)){
    echo'<option value"'.$grp['group_id'].'">'.$grp['group_name'].'</option>';
  }
  ?>

              </select>
            </div>
          </div>

    
   <!--Admin-->
    
  
        </div>
  <div class="modal-footer">
          <button type="submit" name="newUser" class="btn btn-lg btn-block btn-outline-dark">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>