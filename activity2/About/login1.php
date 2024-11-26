<?php
session_start(); // Start the session

// Assuming you set this session variable when the user successfully logs in
// $_SESSION['loggedin'] = true; // This should be set in your login logic

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
?>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="topnav" id="myTopnav">
        <a href="http://localhost/activity2/About/Main.php" class="active"><img src="logo.jpg"></a>
        <a href="javascript:alert('Report Is not been Added so chill and check our website while were working on this');">Report</a>
        <div class="dropdown">
            <button class="dropbtn">Contact Us On Social Media
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="https://www.facebook.com/richie.cabantog.5">Facebook</a>
                <a href="https://www.instagram.com/chiechi32/">Instagram</a>
                <a href="https://github.com/pichie22">Github</a>
            </div>
        </div> 
        <a href="\activity2\Main\main.html">Home</a>
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
    </div>
    <br>

    <div class="info">
        <img src="logo.jpg" alt="logo" class="plmun">
        <br>
        <div class="centered">
            <?php if (!$isLoggedIn): ?>
                <button onclick="document.getElementById('id01').style.display='block'" style="font-size: 50px;">Login</button>
            <?php else: ?>
                <button onclick="logout()" style="font-size: 50px;">Logout</button>
            <?php endif; ?>
        </div>
    </div>
    <div id="id01" class="modal">
        <form class="modal-content animate" id="login-form">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="logo.jpg" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" id="username" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" id="password" required>
                
                <button type="submit">Login</button>
                <div id="login-response"></div>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').submit(function(event) {
                event.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();
                $.ajax({
                    type: 'POST',
                    url: 'http://localhost/activity2/About/login.php',
                    data: {username: username, password: password},
                    success: function(response) {
                        $('#login-response').html(response);
                    }
                });
            });
        });
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
        function logout() {
            $.ajax({
                type: 'POST',
                url: 'http://localhost/activity2/About/logout.php',
                success: function() {
                    // On success, redirect to the current page to refresh the session state
                    window.location.href = window.location.href;
                }
            });
        }
    </script>
</body>
</html>