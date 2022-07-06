

window.onload = function () {

    var oinputs = document.getElementsByTagName("input");
    var btn = document.getElementById("btn");

     btn.onclick = function () {
        
        //var time = new Date();
        var ale = document.getElementById("alert");
        if ((!oinputs[0].value || !oinputs[1].value)) {
            alert("输入内容不能为空");
            
        } 
        
        else {
           
            $.ajax({
                type: "post",
                url: "./static/php/register.php",
                data : {
                    username : oinputs[0].value,
                    password : oinputs[1].value
                    
                },
                success: function(result){
                
                    var res = JSON.parse(result);
                    alert(""+res.message);
                    
                    if(res.code == 0){         
                    }
    
                    if(res.code == 1){  
                    }
                    
                    if(res.code == 2){
                       
                    }

                    if(res.code == 3){
                        window.location.href = "./index.html";
                    }
                    
                 
              },
                error:function(){
                    alert("ajax请求失败");
                }
    
            });
           
        }
         
    }
}