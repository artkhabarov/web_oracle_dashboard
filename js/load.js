function show()  
	{  
		$.ajax({  
			url: "orders.php",  
			cache: false,  
			success: function(html){  
				$("#content").html(html);  
                }  
            });  
    }  
     
    $(document).ready(function(){  
        show();  
        setInterval('show()',1000);  
    });