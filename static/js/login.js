


window.onload = function () {
    var oinputs = document.getElementsByTagName("input");
    var btn = document.getElementById("btn");
    var Iframe = document.getElementById("myIframe");
    
    

   

    btn.onclick = function () {
       
        //var time = new Date();
        var ale = document.getElementById("alert");
        if ((!oinputs[0].value || !oinputs[1].value)) {
            alert("输入内容不能为空");
        } 


        
        $.ajax({
            type: "post",
            url: "./static/php/login.php",
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
                    window.location.href = "./管理界面.html";
                }
                
                
                
             
          },
            error:function(){
                alert("ajax请求失败");
            }

        });



            //$.get("../php/login.php",function(data,status){
            //    alert(""+ data + "\n" +status);
            //})
        
    


        /*
        else {

            $ajax({
                method : "post",
                url : "/php/login.php",
                data : {
                    username : oinputs[0].value,
                    password : oinputs[1].value
                    
                },
                success : function(result){
                    var res = JSON.parse(result);
                    if(res.code == 2){
                        ale.className = "alert-success";
                        ale.innerHTML = res.message;
                        ale.style.display = "block";
                    }else{
                        ale.className = "alert-warning";
                        ale.innerHTML = res.message;
                        ale.style.display = "block";
                    }
                },
                error : function(msg){
                    console.log(msg);
                }
            });
        }
        */
    }
}