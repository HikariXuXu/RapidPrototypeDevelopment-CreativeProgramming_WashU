<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Calendar
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="shortcut icon" href="#">
        <script src = "calendar.js" type = "text/javascript" ></script>
        <script src = "updateCalendar.js" type = "text/javascript" ></script>
        <script src = "calendarUsers.js" type = "text/javascript" ></script>
        <script src = "dateClicked.js" type = "text/javascript" ></script>
    </head>
    <body>
        <?php
            session_start();
        ?>
        <div class="option" id="option_login_signup">
            <button class="login" onClick="logIn()">Log In</button>
            <button class="login" onClick="signUp()">Sign Up</button>
        </div>
        <div class="option" id="option_logout">
            <p id="user"></p> &nbsp;
            <button class="login" onClick="logOut()">Log Out</button>
        </div>
        <div class="user" id="login">
            <p>
                Username: <input type="text" name="username" id="username"/> <br>
                Password: <input type="password" name="pwd" id="password"/> <br>
                <button class="login" onClick="logInCheck()">Log In</button><br>
                If you do not have an account, please <a onclick="signUp()">sign up</a>.
            </p>
        </div>
        <div class="user" id="signup">
            <p>
                UserName: <input type="text" name="new_username" id="newusername"/> <br>
                Password: <input type="password" name="pwd" id="pwd"/> <br>
                Re-enter Password: <input type="password" name="repwd" id="repwd"/> <br>
                <button class="login" onClick="signUpCheck()">Create</button>
            </p>
        </div>
        <input type="date" id="quickselect" name="qs">
        <button id = "gotoDate">Go!</button>
        <div class="calendar">
            <button class="prev" id="prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm11.5 5.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                </svg>
            </button>
            <button class="next" id="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-square" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4.5 5.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                </svg>
            </button>
            <div class="title">
                <h1 id="month"></h1>
                <h2 id="year"></h2>
            </div>
            <div class="body">
                <div class="lightgrey week">
                    <div>SUN</div>
                    <div>MON</div>
                    <div>TUE</div>
                    <div>WED</div>
                    <div>THU</div>
                    <div>FRI</div>
                    <div>SAT</div>
                </div>
                <div class="darkgrey day" id="days">
                </div>
            </div>
        </div>
        <div class="add" id="add">
            <button class="addNewEvents" onClick="postEvents()" id="">Add New Event</button>
            <p>
                Title:<br/>
                <textarea rows="1" cols="20" type="text" name="title" id="title"></textarea> <br/><br/>
                Body:<br/>
                <textarea rows="5" cols="20" type="text" name="body" id="body"></textarea> <br/><br/>
            </p>
        </div> 
        <div id="event">
        </div>
        <script>
            let today = new Date();
            let year = today.getFullYear();
            let month = today.getMonth();
            let day = today.getDate();
            let currentMonth = new Month(year, month);
            document.addEventListener("DOMContentLoaded", function(event){updateCalendar();}, false);
            document.getElementById("prev").addEventListener("click", function(event){
                currentMonth = currentMonth.prevMonth();
                updateCalendar();
            }, false);
            document.getElementById("next").addEventListener("click", function(event){
                currentMonth = currentMonth.nextMonth();
                updateCalendar();
            }, false);
            document.getElementById("gotoDate").addEventListener("click", function(event){
                let DateSelected = document.querySelector('input[id="quickselect"]').value;
                let dateSelected = new Date(DateSelected);
                let yearSelected = dateSelected.getFullYear();
                let monthSelected = dateSelected.getMonth();
                let daySelected = dateSelected.getDate();
                currentMonth = new Month(yearSelected,monthSelected);
                updateCalendar();
            }, false);
            document.getElementById("add").style.display = 'none';
        </script>
        <?php
            if (isset($_SESSION["username"])){
                ?>
                <script>
                    document.getElementById("option_login_signup").style.display = 'none';
                    document.getElementById("option_logout").style.display = 'inline';
                    document.getElementById("login").style.display = 'none';
                    document.getElementById("signup").style.display = 'none';
                    document.getElementById("user").textContent = '<?php echo $_SESSION["username"]; ?>';
                </script>
                <?php
            } else {
                ?>
                <script>
                    document.getElementById("option_login_signup").style.display = 'inline';
                    document.getElementById("option_logout").style.display = 'none';
                    document.getElementById("login").style.display = 'none';
                    document.getElementById("signup").style.display = 'none';
                </script>
                <?php
                
            }
        ?>
    </body>
</html>