<?php
require_once 'requires/head.php';
?>



    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Review</li>
        </ol>
        <div class="container">
          <div class="row">
            <div class="col-3">
                <button class='btn btn-lg btn-outline-primary'>Submitted..</button>
          </div>
          <div class="col-6">
          <h4 class="mb-3"><?php /*echo "<b>".$service_prov." </b>";*/ ?>the service</h4> 
          </div>
  
        <div class="col-3">
        <a href="" class="btn btn-outline-info" >Edit</a>
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
            <h6 class="my-0"><?php /*echo $com_name;*/ ?></h6>
         <p>   <small class="text-muted">Contact:<?php /*echo " 0".$com_contact;*/ ?> </small></p>
            <small class="text-muted">TIN:<?php /*echo " ".$com_tin;*/ ?> </small>
          </div>
          
        </li>
      </ul>

      <!--Remarks-->

      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Remarks</span>
        <span class="badge badge-secondary badge-pill"><?php /*echo mysqli_num_rows($remark_result);*/ ?></span>
      </h4>
      <ul class="list-group mb-3">
<?php
// while($remark=mysqli_fetch_array($remark_result))
// echo'
//         <li class="list-group-item d-flex justify-content-between lh-condensed">
//           <div>
//             <h6 class="my-0">'.$remark['fname'].'(<b>'.$remark['role'].'</b>)</h6>
//             <small class="text-muted">'.$remark['date'].'</small>
//             <p>'.$remark['note'].'
          
//           </p>
//           </div>
//         </li>
//         ';
      
      ?>
      </ul>
    </div>
    <!--End of Remarks -->

    <div class="col-md-8 order-md-1">
      <div class="row">
      <div class="col-8">
       <h4 class="mb-3"><?php /*echo "<b>".$service_prov." </b>";*/ ?></h4>
      </div>
     <div class="col-4">
      <?php
//       switch($_SESSION['rank']){
//         case "AC":
//         if($pay_stat=="Revise"||$pay_stat=="Stand By"){
//           echo '<a href="edit.php?payid='.$_GET['payid'].'" class="btn btn-outline-info" >Edit</a>
//           <a href="update.php?payid='.$_GET['payid'].'" class="btn btn-outline-danger" >X Delete</a>';
//         }
//         else{
//           if($pay_stat=="Submitted"){
//             echo"<button class='btn btn-outline-primary'>".$pay_stat."...</button>";
//           }
//           if($pay_stat=="Recommended"){
//             echo"<button class='btn btn-primary'>".$pay_stat."</button>";
//           }
//           if($pay_stat=="Approved"){
//             echo"<button class='btn btn-success'>".$pay_stat."</button>";
//           }
          
//         }
//         break;
// case "staff":
// if($pay_stat=="Denied"){
//   echo '<a href="edit.php?payid='.$_GET['payid'].'" class="btn btn-outline-info" >Edit</a>';
// }
// else{
//   if($pay_stat=="Submitted"){
//     echo"<button class='btn btn-outline-primary'>".$pay_stat."...</button>";
//   }
//   if($pay_stat=="Recommended"){
//     echo"<button class='btn btn-primary'>".$pay_stat."</button>";
//   }
//   if($pay_stat=="Approved"){
//     echo"<button class='btn btn-success'>".$pay_stat."</button>";
//   }
//   if($pay_stat=="Stand By"){
//     echo"<button class='btn btn-info'>".$pay_stat."</button>";
//   }
//   if($pay_stat=="Revise"){
//     echo"<button class='btn btn-waring'>".$pay_stat."</button>";
//   }
//   if($pay_stat=="Declined"){
//     echo"<button class='btn btn-danger'>".$pay_stat."</button>";
//   }
// }
// break;
// default:
// if($pay_stat=="Submitted"){
//   echo"<button class='btn btn-outline-primary'>".$pay_stat."...</button>";
// }
// if($pay_stat=="Recommended"){
//   echo"<button class='btn btn-primary'>".$pay_stat."</button>";
// }
// if($pay_stat=="Approved"){
//   echo"<button class='btn btn-success'>".$pay_stat."</button>";
// }
// if($pay_stat=="Stand By"){
//   echo"<button class='btn btn-info'>".$pay_stat."</button>";
// }
// if($pay_stat=="Revise"){
//   echo"<button class='btn btn-waring'>".$pay_stat."</button>";
// }
// if($pay_stat=="Declined"){
//   echo"<button class='btn btn-danger'>".$pay_stat."</button>";
// }
// if($pay_stat=="Denied"){
//   echo"<button class='btn btn-outline-danger'>".$pay_stat."</button>";
// }
// if($pay_stat=="Revise"){
//   echo"<button class='btn btn-'>".$pay_stat."...</button>";
// }


      // }

      // if($_SESSION['rank']=="AC"&&$pay_stat=="Revise"||$pay_stat=="Stand By"){
      // echo '<a href="edit.php?payid='.$_GET['payid'].'" class="btn btn-outline-info" >Edit</a>';
    
      ?>
      </div>
    </div>
      <form class="needs-validation" action="update.php" method="POST">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Company Name</label>
            <input name="id" hidden value="<?php /*echo $pay_id*/ ?>" >
            <input type="text" class="form-control" id="firstName" name="company" value="<?php /*echo $com_name;*/ ?>" readonly style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAfBJREFUWAntVk1OwkAUZkoDKza4Utm61iP0AqyIDXahN2BjwiHYGU+gizap4QDuegWN7lyCbMSlCQjU7yO0TOlAi6GwgJc0fT/fzPfmzet0crmD7HsFBAvQbrcrw+Gw5fu+AfOYvgylJ4TwCoVCs1ardYTruqfj8fgV5OUMSVVT93VdP9dAzpVvm5wJHZFbg2LQ2pEYOlZ/oiDvwNcsFoseY4PBwMCrhaeCJyKWZU37KOJcYdi27QdhcuuBIb073BvTNL8ln4NeeR6NRi/wxZKQcGurQs5oNhqLshzVTMBewW/LMU3TTNlO0ieTiStjYhUIyi6DAp0xbEdgTt+LE0aCKQw24U4llsCs4ZRJrYopB6RwqnpA1YQ5NGFZ1YQ41Z5S8IQQdP5laEBRJcD4Vj5DEsW2gE6s6g3d/YP/g+BDnT7GNi2qCjTwGd6riBzHaaCEd3Js01vwCPIbmWBRx1nwAN/1ov+/drgFWIlfKpVukyYihtgkXNp4mABK+1GtVr+SBhJDbBIubVw+Cd/TDgKO2DPiN3YUo6y/nDCNEIsqTKH1en2tcwA9FKEItyDi3aIh8Gl1sRrVnSDzNFDJT1bAy5xpOYGn5fP5JuL95ZjMIn1ya7j5dPGfv0A5eAnpZUY3n5jXcoec5J67D9q+VuAPM47D3XaSeL4AAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">
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
            <input type="number" class="form-control" id="username"value="<?php /*echo $pay_amt;*/ ?>" readonly>
            
          </div>
        </div>

<hr class="mb-4">

<h4 class="mb-3">AMC Term</h4>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">From</label>
            <input type="date" class=" d-block w-100 form-control" name="amc_in" id="country" readonly value="<?php /*echo $pay_amc_in;*/ ?>">
          
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">To</label>
            <input type="date" class="form-control" name="amc_out" readonly value="<?php /*echo $pay_amc_out;*/ ?>">
            
          </div>
          </div>

          <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Due date</label>
            
            <input type="date" class="form-control" name="due_date" readonly value="<?php /*echo $pay_due;*/ ?>">
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
            <input type="text" class=" d-block w-100 form-control" id="country" readonly value="<?php /*echo $pay_period;*/ ?>">
          
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">Year</label>
            <input type="text" class="form-control" name="year" readonly value="<?php /*echo $pay_year;*/ ?>">
            
          </div>
          </div>
        <hr class="mb-4">
        
        <div class="row col-12" id="buts">
<div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)"><i class="fas fa-fw fa-check"></i><span>Approve</span></button></div>

<div class="col-6"><button class="btn btn-warning btn-lg btn-block" type="button" onclick="drag_remark(this)"><i class="fas fa-fw fa-times"></i><span>Decline</span></button></div>
</div>
                                        <?php
// $rank=$_SESSION['rank'];
// switch($rank){
//   case "AC":
//   if($pay_stat=="Stand By"){
//     echo'
//     <div class="row col-12" id="buts">
// <div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)">Approve</button></div>

// <div class="col-6"><button class="btn btn-warning btn-lg btn-block" type="button" onclick="drag_remark(this)">Decline</button></div>
// </div>';
//   }

//   else{
//     echo '
//     <div class="row col-12" id="buts">
// <div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)">Leave a Remark</button></div>
// </div>
//    ';
//   }
//   break;

//   case "DC":
//   if($pay_stat=="Submitted"){
//     echo'
//     <div class="row col-12" id="buts">
// <div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)">Approve</button></div>

// <div class="col-6"><button class="btn btn-warning btn-lg btn-block" type="button" onclick="drag_remark(this)">Decline</button></div>
// </div>';
//   }

//   else{
//     echo '
//     <div class="row col-12" id="buts">
// <div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)">Leave a Remark</button></div>
// </div>
//    ';
//   }

//   break;

//   case "Commissioner":
//   if($pay_stat=="Recommended"){
//     echo'
//           <div class="row col-12" id="buts">
// <div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)">Approve</button></div>

// <div class="col-6"><button class="btn btn-warning btn-lg btn-block" type="button" onclick="drag_remark(this)">Decline</button></div>
// </div>';
//   }
//   else{
//     echo '
//       <div class="row col-12" id="buts">
// <div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)">Leave a Remark</button></div>
// </div>
//          ';
//   }
//   break;

//   default:
//   echo '
//       <div class="row col-12" id="buts">
// <div class="col-6"><button class="btn btn-success btn-lg btn-block"  type="button" onclick="drag_remark(this)">Leave a Remark</button></div>
// </div>
//          ';
         

// }

 ?>
          <div class="form-group" id="remarks" style="display:none;" >
                                             <label class="control-label ">Remark</label>

                                            <div class="">
                                              
                                                 <textarea id="wysihtml5" class="form-control" rows="9" cols="100" name="note"></textarea>
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
