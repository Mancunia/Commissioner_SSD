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
function drag_menu(e){
var com_menu=document.getElementById('com-menu');
    e.style.display="none";
    com_menu.style.display="block";
    com_menu.style.transform="translateX(0)";

    
}
function un_drag_menu(){
    var com_menu=document.getElementById('com-menu');
    var drag_btn=document.getElementById('drag-menu');
    com_menu.style.transform="translateX(100%) translateX(-5px)";
    
        drag_btn.style.display="block";
}

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

