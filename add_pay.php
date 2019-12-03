<?php
require_once 'requires/head.php';
include_once 'includes/newCompany.html';
include_once 'includes/newService.html';
include_once 'includes/newPeriod.html';
include_once 'requires/com_ssd.php';

$com_ssd=new com_ssd();

$comp=$com_ssd->getCompany($_SESSION['grp']);
$serve=$com_ssd->getService();
$period=$com_ssd->getPeriod();

if(isset($_POST['submitBtn'])){
  extract($_POST);
  // $uid = $_SESSION['user_id'];
  //   $_SESSION['department'];
$pid=$com_ssd->addPayments($_SESSION['user_id'],$company,$amount,$period,$year,$amc_startDate,$amc_endDate,$dueDate,$_SESSION['department'],$service, $_SESSION['role']);
$com_ssd->addRemark($pid,$_SESSION['user_id'],$note);
echo $pid;
}

if(isset($_POST['newCompany'])){
extract($_POST);
  $com_ssd->addCompany($name,$tin,$email,$web,$phone,$phone1,$phone2,$address,$description);
}

if(isset($_POST['newService'])){

  $com_ssd->addService($_POST['name']);
}

if(isset($_POST['newPeriod'])){

 $com_ssd->addPeriod($_POST['period']);
}

?>

<!-- Modal -->

<div id="main" style="margin-top:5%;" >
<center>
        <div class="col-md-9 card" style="width:80rem;">
            <br>
            <div>
                <!-- <div id="chng-menu"> <button class="openbtn" onclick="openNav()">☰Menu </button></div> -->
                <br id="brSU">
                <br>
                <h3 id="lessonN" class="card-title">
                IT SERVICE PROVIDERS PAYMENT FORM
                <hr class="mb-4">
                </h3>
                <br>
            </div>
            <form action="add_pay.php" method="POST" enctype="multipart/form-data" >
                <!-- Company name-->

                <div class="card text-black  mb-3" id="cards_holder_item">
                    <div class="card-header"><b>Company Name</b></div>
                    <div class="card-body">
                   
                      <select name="company" id="companyName" class="form-control">
                        <option value="">Select</option>
                         <?php
                   while($c=mysqli_fetch_array($comp)){
                     echo '
                     <option value="'.$c['company_id'].'">'.$c['company_name'].'</option>
                     ';
                   }
                    ?>
                      </select>
                        <div><br>
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#companyModal" data-whatever="@mdo">
                        <b><h4>+</h4></b> company
                        </button>
                        </div>
                    </div>
                </div>

                <!--Service provided -->
                <div class="card text-black  mb-3" id="cards_holder_item">
                    <div class="card-header"><b>Service Provided</b></div>
                    <div class="card-body">
                   
                      <select name="service" id="companyName" class="form-control">
                        <option value="">Select</option>
                        <?php
                   while($c=mysqli_fetch_array($serve)){
                     echo '
                     <option value="'.$c['service_id'].'">'.$c['service_title'].'</option>
                     ';
                   }
                    ?>
                        
                      </select>
                        <div><br>
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#serviceModal" data-whatever="@mdo">
                        <b><h4>+</h4></b> Service
                        </button>
                        </div>
                    </div>
                </div>

                <!--AMC term -->
                <div class="card text-black  mb-3" id="cards_holder_item">
                    <div class="card-header"><b>AMC Term</b></div>
                    <div class="card-body">
                    <div class="row">

                    <div class="col-6">
                    <label>From</label>
                    <input type="date" class="form-control" name="amc_startDate">
                    </div>

                    <div class="col-6">
                    <label>To</label>
                    <input type="date" class="form-control" name="amc_endDate">
                    </div>
                    
                    </div>

                    </div>
                    </div>

                    <!--Due date -->
                    
                    <div class="card text-black  mb-3" id="cards_holder_item">
                    <div class="card-header"><b>Due date</b></div>
                    <div class="card-body">
                    <div class="row">
                    <div class="col-12">
                    
                    <input type="date" class="form-control" name="dueDate">
                    </div>
                    </div>
                    </div>
                    </div>

                <div class="mb-3">

          <label for="username">Amount</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">ghs</span>
            </div>
            <input type="number" class="form-control" id="username" placeholder="0000.00000" name="amount" required="">
            <div class="invalid-feedback" style="width: 100%;">
              The ammount is required.
            </div>
          </div>
        </div>
                <!-- Payment Period-->
                <?php
                    // $result = $com_ssd->getPeriod();
                    ?>
                <div class="card text-black  mb-3" id="cards_holder_item">
                    <div class="card-header"><b>Payment Period</b></div>
                    <div class="card-body">

                    <label for="country">Period</label>
                    <div class="row">
                    <div class="col-10">
            <select class="custom-select d-block w-100 form-control" id="country" name="period" required="">
              <option value="">Choose...</option>
              <?php
                   while($c=mysqli_fetch_array($period)){
                     echo '
                     <option value="'.$c['period_id'].'">'.$c['period_title'].'</option>
                     ';
                   }
                    ?>
                        
            </select>
          </div>

            <div class="col-2"><button class="btn btn-primary" data-toggle="modal" data-target="#periodModal"><b><h4>+</h4></b></button></div>
            </div>

            <div class="invalid-feedback">
              Please select a valid Period.
            </div>
          </div>

          <div class="col-md-4 mb-3">
            <label for="state">Year</label>
            <input type="text" class="form-control" name="year" value="<?php echo date("Y"); ?>">
            
                    </div>

                </div>

                
                <div class="card text-black  mb-3" id="cards_holder_item">
                    <div class="card-header"><b>Remarks</b></div>
                    <div class="card-body">
                        <textarea class="form-control" rows="5" placeholder="lesson Summary" name="note" required>
                      </textarea>
                        <br>
                        <button class="btn btn-danger" type="reset" name="clear_button">Clear <span class="glyphicon glyphicon-trash"></span></button>
                    </div>
                </div>

                <!-- Attachment-->
        
                       <div class="card text-black mb-3">
                    <div class="card-header"><strong><b>Attach a File</b></strong>
                    </div>
                    <div class="row">
                    <input class="form-control-file btn btn-block" type="file" name="my_file" multiple>
                    </div>
                    
                </div>

                <br>
                <div class="card text-black mb-3">
                    <button type="submit" class="btn btn-primary" name="submitBtn">Submit</button>

                </div>
                </div>
            </form>
            <br>
        </div>
    </center>
</div>
<br>
<br>
      <!-- /.container-fluid -->

      <?php
require 'requires/footer.php';
      ?>

      
