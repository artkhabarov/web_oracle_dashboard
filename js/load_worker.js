function show()  
	{  
		$.ajax({  
			url: "kpi.php",  
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