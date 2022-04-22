$( document ).ready(function() {
    products();

 // Fetching products
 function products() {
    $.ajax({
        url: "admin-action.php",
        method: "POST",
        data: {
            getProduct: 1
        },
        success: function(response) {
            $(".table").html(response);
        }
    })
}
$('.getproducts').on('click', function(event){
    event.preventDefault();
    products();

})

//fetch data for categories
$('.category').on('click', function(event){
    event.preventDefault();
    $.ajax({
        url: "admin-action.php",
        method: "POST",
        data: {
            getCategory: 1
        },
        success: function(response) {
            $(".table").html(response);
        }
    })
  

});
// fetching data for brands
$('.brands').on('click', function(event){
    event.preventDefault();
    $.ajax({
        url: "admin-action.php",
        method: "POST",
        data: {
            getBrand: 1
        },
        success: function(response) {
            $(".table").html(response);
        }
    })
  

});
//fetching orders info
$('.orders').on('click', function(event){
    event.preventDefault();
    $.ajax({
        url: "admin-action.php",
        method: "POST",
        data: {
            getOrder: 1
        },
        success: function(response) {
            $(".table").html(response);
        }
    })
  

});

  
    
});

