

<?php

require_once 'requires/head.php';

if($_SESSION['role']!=4){
        
  header("Location:index.php");
}

include 'requires/com_ssd.php';
$com_ssd=new com_ssd();
$the_else=$feed="";
$period=$com_ssd->getPeriods($_SESSION['grp'],$_SERVER['REQUEST_URI']);
$serve=$com_ssd->getServices($_SESSION['grp'],$_SERVER['REQUEST_URI']);

echo $_SERVER['REQUEST_URI'];

if (isset($_GET['payid'])){
  $remark=$com_ssd->getRemark($_GET['payid']);
  $files=$com_ssd->getFiles($_GET['payid']);

  // $note=mysqli_fetch_array($remark);

  $paymentDetails=$com_ssd->getPaymentDetails($_GET['payid']);

  $results=mysqli_fetch_array($paymentDetails);

  //company details
  $com_name=$results['company_name'];
  $com_tin=$results['TIN'];
  $com_p1=$results['phone'];
$com_p2=$results['phone_2'];
$com_p3=$results['phone_3'];
$com_email=$results['email'];
$com_web=$results['website'];
$com_address=$results['address'];


//payment details
$pay_id=$results['payment_id'];
  $pay_amt=$results['amount'];
  $pay_period=$results['period_title'];
  $pay_year=$results['year'];
  $pay_stat=$results['status'];
  $pay_amc_in=$results['amc_start'];
  $pay_amc_out=$results['amc_end'];
  $pay_due=$results['due_date'];

//Service provided
$service_prov=$results['service_title'];


}
else{

 $the_else="
 <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Hmmm!</strong> Something went wrong <a href='index.php'>GO back</a>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div>
 
 ";
 
}

if(isset($_POST['edit'])){

  $amnt=$_POST['newAmnt'];
  $amc_in=$_POST['newAmc_in'];
  $amc_out=$_POST['newAmc_out'];
  $due_date=$_POST['newDue_date'];
  $period=$_POST['newPeriod'];
  $year=$_POST['newYear'];
  $service=$_POST['newService'];

  $status="Stand By";

  if($_SESSION['role']==4)
  {
    $status="Submitted";
  }

  
  $com_ssd->editPayment($pay_id,$amnt,$amc_in,$amc_out,$due_date,$period,$year,$service,$_SESSION['role'],$status);
  
  $com_ssd->addRemark($pay_id,$_SESSION['user_id'],$_POST['note']);
  $link="Location:review.php?payid=".$pay_id;

  header($link);
  
  // header("Location:index.php");

  }

  if(isset($_GET['fly'])){
    $feed= $com_ssd->deletePayment($_GET['fly']);
    // echo $feed;
      header("Location:index.php");
    }






    include 'requires/heading.php';
?>


<div id="content-wrapper">
<?php 
if($the_else){
echo $the_else; 
exit();
}
?>
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
          <li class="breadcrumb-item active">Payment ID:<?php echo $results['payment_id']; ?></li>
        </ol>
      
        <div class="container"> 
         <?php echo $feed; ?>
          <div class="row">
            <div class="col-3">
                <?php
                echo $com_ssd->status($pay_stat);
                ?>
          </div>
          <div class="col-6">
          <h4 class="mb-3"><?php echo "<b>".$service_prov." </b>"; ?></h4> 
          </div>
  
        <div class="col-3">
        <a href="edit.php?fly=<?php echo $pay_id; ?>" class="btn btn-outline-danger" >Delete</a>
      </div>
        
</div>
</div>

      </div>



<div class=" container card" style="margin-top:5%;">
  <div class="card-body">
    <body class="bg-light">
    <div class="container">
  
<!--Remarks -->
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Company Details</span>
      </h4>
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><?php echo $com_name;?></h6>
         <p>   <small class="text-muted"><b>Tel:</b><?php echo " ".$com_p1; ?> </small>
         <small class="text-muted"><?php echo "<br> ".$com_p2; ?> </small>
         <small class="text-muted"><?php echo "".$com_p3; ?> </small>
         </p>
         <p><small class="text-muted"><b>email:</b><?php echo " ".$com_email; ?> </small></p>
         <p><small class="text-muted"><b>website:</b><?php echo " ".$com_web; ?> </small></p>

            <small class="text-muted"><b>TIN:</b><?php echo " ".$com_tin; ?> </small>
          </div>
          
        </li>
      </ul>

      <!--Remarks-->

      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Remarks</span>
        <span class="badge badge-secondary badge-pill"><?php echo mysqli_num_rows($remark); ?></span>
      </h4>
      <ul class="list-group mb-3">
<?php
while($note=mysqli_fetch_array($remark)){
echo'
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><b>'.$note['first_name']." ".$note['last_name'].'</b></h6>
            <small class="text-muted">'.$note['date_created'].'</small>
            <p>'.$note['note'].'
          
          </p>
          </div>
        </li>
        ';
      }
      ?>
      </ul>

      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Attached Files</span>
        <span class="badge badge-secondary badge-pill"><?php echo mysqli_num_rows($files); ?></span>
      </h4>
      <ul class="list-group mb-3">
  <?php
    while($note=mysqli_fetch_array($files)){
        echo'
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0"><b>'.$note['file_name'].'</b></h6>
            <small class="text-muted">'.$note['first_name'].' '.$note['last_name'].'</small><br>
            <a class="btn btn-group-lg btn-dark" href="docs/'.$note['file_location'].'">Download</a>
          </div>
        </li>
        ';
      }
      ?>
      </ul>
    </div>
    <!--End of Remarks -->

    <div class="col-md-8 order-md-1">
      <div class="row">
      <div class="col-8">
      <script>
      
      </script>
       <h4 class="mb-3">
       
       <?php echo $com_ssd->due($pay_due); ?>
       </h4>
      </div>
     <div class="col-4">
      <?php
//      
    
      ?>
      </div>
    </div>
      <form class="needs-validation" action="" method="POST">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Company Name</label>
            <input name="id" hidden value="<?php /*echo $pay_id*/ ?>" >
            <input type="text" class="form-control" id="firstName" name="company" value="<?php echo $com_name; ?>" readonly style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          
        </div>

        <div class="mb-3">
          <label for="username">Amount</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">ghs</span>
            </div>
            <input type="number" class="form-control" name="newAmnt" id="username"value="<?php echo $pay_amt;?>">
            
          </div>
        </div>

<hr class="mb-4">

<h4 class="mb-3">AMC Term</h4>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">From</label>
            <input type="date" class=" d-block w-100 form-control" name="newAmc_in" value="<?php echo $pay_amc_in; ?>">
          
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">To</label>
            <input type="date" class="form-control" name="newAmc_out" value="<?php echo $pay_amc_out;?>">
            
          </div>
          </div>

          <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Due date</label>
            
            <input type="date" class="form-control" name="newDue_date"  value="<?php echo $pay_due; ?>">
          <script>
          var due_date =document.getElemenyById("due_date");
          var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
          if(due_date.innerHTML == date){
            due_date.setAttribute("class","btn btn-warning btn-lg btn-block");
          }
          </script>
          </div>
          </div>
        <hr class="mb-4">
        


<h4 class="mb-3">Payment Period</h4>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Period</label>
            <select class="custom-select d-block w-100 form-control" id="country" name="newPeriod" required="">
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
          <div class="col-md-4 mb-3">
            <label for="state">Year</label>
            <input type="text" class="form-control" name="newYear" value="<?php echo $pay_year; ?>">
            
          </div>
          </div>
          <hr class="mb-4">
          <h4 class="mb-3">Service Provided</h4>
          <div >
          <select name="newService" id="companyName" class="form-control">
                        <option value="">Select</option>
                        <?php
                   while($c=mysqli_fetch_array($serve)){
                     echo '
                     <option value="'.$c['service_id'].'">'.$c['service_title'].'</option>
                     ';
                   }
                    ?>
                        
                      </select>
          </div>
          <hr class="mb-4">
        <div class="row col-12" id="buts">
<div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)">Done</button></div>
</div>


          <div class="form-group" id="remarks" style="display:none;" >
                                             <label class="control-label ">Remark</label>

                                            <div class="">
                                              
                                                 <textarea id="wysihtml5" class="form-control" rows="9" cols="100" name="note" required></textarea>
                                            </div>
                                            <hr class="mb-4">
        
                                            <button class="btn btn-primary btn-lg btn-block" id="decision" type="submit">Submit</button>
                                        </div>
          
        
        

                                       
                                        
        
      </form>
    </div>
  </div>

  
</div>
  

  </div>
</div>


      </div>
      <!-- /.container-fluid -->

      <?php
require 'requires/footer.php';


      ?>
