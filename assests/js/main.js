$( document ).ready(function() {
    products();
    

  // Fetching products
    function products(){
        $.ajax({
            url: "action.php",
            method: "POST",
            data:{getProduct:1},
            success:function(response){
                $("#fetch_products").html(response);
            }
        })
    }
//   Fetching selected products
    $('.category').on('click', function(event){
        event.preventDefault();
        var catid=$(this).attr('id');
        $.ajax({
            url: "action.php",
            method: "POST",
            data:{getSelectedProduct:1, cat_id:catid},
            success:function(response){
                $("#fetch_products").html(response);
            }
        })
       

    })
//   Fetching selected brands
    $('.brand').on('click', function(event){
        event.preventDefault();
        var bid=$(this).attr('id');

    
        $.ajax({
            url: "action.php",
            method: "POST",
            data:{getSelectedBrand:1, b_id:bid},
            success:function(response){
                $("#fetch_products").html(response);
            }
        })
       

    })
    //for search
    $('#search-btn').on('click', function(event){
        event.preventDefault();
      var keyword=$("#search").val();
      if(keyword!=""){
        $.ajax({
            url: "action.php",
            method: "POST",
            data:{getSearchResult:1, keyword:keyword},
            success:function(response){
                $("#fetch_products").html(response);
        
            }
        })
        
       

      }    
    })
 
});

