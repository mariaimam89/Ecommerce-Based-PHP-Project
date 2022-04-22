$( document ).ready(function() {
    
    var pprice=$('.pprice');

	var pquantity=$('.pquantity');

	var ptotal=$('.ptotal');
    var gtotal=$('.gtotal');
 
    
    var gt=0;


	function subtotal(){
		gt=0;

		for(i=0; i<pprice.length;i++){
		ptotal[i].innerText=($('.pprice').eq(i).val()) * ($('.pquantity').eq(i).val())  ;
        gt=gt+(($('.pprice').eq(i).val()) * ($('.pquantity').eq(i).val()));
		
		}
      
        // alert(gt);
       gtotal.innerText=gt;
       $(".gtotal").text(gt);
      
	}
   
	subtotal();

    $('.pquantity').bind('keyup mouseup', function () {
        $(".quantityform").submit();            
    });
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("btn-checkout");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
});

