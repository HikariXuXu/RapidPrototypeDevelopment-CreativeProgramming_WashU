function logIn(){
    document.getElementById("option_login_signup").style.display = 'none';
    document.getElementById("option_logout").style.display = 'none';
    document.getElementById("login").style.display = 'inline';
    document.getElementById("signup").style.display = 'none';
}

function logInCheck(){
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    if (username == null || username == "") {
        alert("Please enter the username!");
    } else if (password == null || password == "") {
        alert("Please enter the password!");
    } else {
        const data = { 'username': username, 'password': password };
        fetch("login_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then(function(data){
            if (data.success){
                console.log("You've been logged in!");
                alert("You've been logged in!");
                document.getElementById("option_login_signup").style.display = 'none';
                document.getElementById("option_logout").style.display = 'inline';
                document.getElementById("login").style.display = 'none';
                document.getElementById("signup").style.display = 'none';
                document.getElementById("user").textContent = username.toString();
            } else {
                console.log(`You were not logged in: ${data.message}`);
                alert(`You were not logged in: ${data.message}`);
            }
        });
    }
}

function signUp(){
    document.getElementById("option_login_signup").style.display = 'none';
    document.getElementById("option_logout").style.display = 'none';
    document.getElementById("login").style.display = 'none';
    document.getElementById("signup").style.display = 'inline';
}

function signUpCheck(){
    let username = document.getElementById("newusername").value;
    let pwd = document.getElementById("pwd").value;
    let repwd = document.getElementById("repwd").value;
    if (username == null || username == "") {
        alert("Please enter the username!");
    } else if (pwd == null || pwd == "") {
        alert("Please enter the password!");
    } else if (repwd == null || repwd == "") {
        alert("Please enter the password twice!");
    } else if (pwd !== repwd) {
        alert("Password inconsistant!");
    } else {
        const data = { 'username': username, 'password': pwd };
        fetch("signup_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then(function(data){
            if (data.success){
                console.log("You've been signed up!");
                alert("You've been signed up!");
                document.getElementById("option_login_signup").style.display = 'none';
                document.getElementById("option_logout").style.display = 'inline';
                document.getElementById("login").style.display = 'none';
                document.getElementById("signup").style.display = 'none';
                document.getElementById("user").textContent = username.toString();
            } else {
                console.log(`You were not signed up: ${data.message}`);
                alert(`You were not signed up: ${data.message}`);
            }
        });
    }
}

function logOut(){
    document.location = 'logout.php';
}