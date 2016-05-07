
<html>
    <head>
        <title>Lab Time | Home</title>
        <link rel="stylesheet" href="style.css">
        <script type="text/javascript" src="js/jquery-1.12.1.js"></script>
    </head>

    <body id="background">
        <script>
            
            /*
             * function to validate username
             */
            function validateUsername(username)
            {
                var rgText= /([a-z]{1,30}).([a-z]{1,30})/;
                
                if(!rgText.test(username))
                {
                    errorMsg.innerHTML="Invalid Username";
                    return false;
                }
                return true;
                
            }

            /*
             callback function for login method
             */
            function loginComplete(xhr, status)
            {
                if (status != "success")
                {
                    alert("Invalid Login");
                }

                var log = $.parseJSON(xhr.responseText);
                if (log.result == 0)
                {
                    errorMsg.innerHTML = log.message;
                }
                else
                {
                    location.href = "viewmybookings.php";
                }

            }

            /*makes request to the ajax page
             */
            function login()
            {
                var username = $("#username").val();
                var password = $("#password").val();
                if (!validateUsername(username))
                {
                    return;
                }
                
               
                var url = "login_ajax.php?cmd=3&username=" + username + "&pword=" + password;

                $.ajax(url,
                        {
                            async: true, complete: loginComplete
                        });
            }

        </script>
        <div id="maindiv">
            <div id="homediv1">
                <center>
                    <img src="images/logo.gif" style="width:230px;height:37%";>
                    <p><h3>Make bookings for your events at the lab and view all bookings to know when and where events will be happening</h1></p>
                </center>	
            </div>

            <div id="homediv2">
                <center>

                    <div class="login">
                        <div style = "color:red" id = "errorMsg"> </div>
                        <input type="login" class= "logininput"placeholder="Username" id="username" name="username">  
                        <input type="password" placeholder="password" id="password" name = "pword">  
                        <a href="#" class="forgot">forgot password?</a>
                        <input type="submit" id="loginbutton" value="Sign In" onclick="login()">
                    </div>
                    <span style="color: black"><b>or</b></span>
                    <input type="submit" id="loginbutton" value="View All Bookings">
                </center>
            </div>

        </div>
    </body>
</html>