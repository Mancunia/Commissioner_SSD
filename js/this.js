var e ="";

//Remarks
function drag_remark(e){

document.getElementById('buts').style.transform="translateX(0)";
    document.getElementById('buts').style.display="none";


    document.getElementById('remarks') .style.transform="translateX(0)";
    document.getElementById('remarks').style.display="block";
   

if(e.innerHTML=='Approve'){
    document.getElementById("decision").setAttribute("name", "approval");
}
if(e.innerHTML=='Leave a Remark'){
document.getElementById("decision").setAttribute("name", "comment");
}
   if(e.innerHTML=='Decline'){
        document.getElementById("decision").setAttribute("name", "declined");
    }
    if(e.innerHTML=='Done'){
        document.getElementById("decision").setAttribute("name", "edit");
    }
}

//transition bar
// function drag_menu(e){
// var com_menu=document.getElementById('com-menu');
//     e.style.display="none";
//     com_menu.style.display="block";
//     com_menu.style.transform="translateX(0)";

    
// }
// function un_drag_menu(){
//     var com_menu=document.getElementById('com-menu');
//     var drag_btn=document.getElementById('drag-menu');
//     com_menu.style.transform="translateX(100%) translateX(-5px)";
    
//         drag_btn.style.display="block";
// }

function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

// setPass();


// function edit_review(e){

//     document.getElementById("decision").setAttribute("name", "declined");
// }

// disable fields
function disable_New_com(){

document.getElementBy("comp").disabled = true;

}


///check TIN
function validateForm(){
  console.log("hello");
  var Tin= document.forms['myform']['tin'].value;
var n=Tin.length;

if (n==11){
// var regex="/^[C].*[A-Z0-9]$/igm ";

var b = /^[C].*[A-Z0-9]$/igm.test(Tin);

if(b==false){
  document.getElementById("tin_feed").setAttribute("class","badge badge-danger badge-pill");
  document.getElementById("tin_feed").innerHTML="Not a valid TIN";
  disable_New_com();
}
else{
  document.getElementById("tin_feed").setAttribute("class","badge badge-success badge-pill");
  document.getElementById("tin_feed").innerHTML="Good TIN";
}

console.log(b);
  
}
else{
document.getElementById("tin_feed").setAttribute("class","badge badge-danger badge-pill");
  document.getElementById("tin_feed").innerHTML="Too short, must be 11 characters";
  disable_New_com();
}

}


 
    // function PrintDiv() {    
    //    var divToPrint = document.getElementById('divToPrint');
    //    var popupWin = window.open('', '_blank', 'width=300,height=300');
    //    popupWin.document.open();
    //    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    //     popupWin.document.close();
    //         }


    // function myFunction() {
    //           window.print();
    //         }


    function printDiv(divName) {
              var printContents = document.getElementById(divName).innerHTML;
              var originalContents = document.body.innerHTML;
         
              document.body.innerHTML = printContents;
         
              window.print();
         
              document.body.innerHTML = originalContents;
         }



function due_date(){
  var due=document.getElementById("due");
  var state;
  state = due.value
}