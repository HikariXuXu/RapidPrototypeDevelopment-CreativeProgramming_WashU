function showAddEvents(event){
    let day = event.target.textContent;
    sessionStorage.setItem('day', day);
    document.getElementById("add").style.display = "inline";
    // Show events
    monthEn = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    monthNum = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    let year = document.getElementById("year").textContent;
    let month = monthNum[monthEn.indexOf(document.getElementById("month").textContent)];
    let username = document.getElementById("user").textContent;
    if (username != ""){
        let date = year + "-" + month + "-" + day;
        const data = { 'username': username, 'date': date };
        fetch("readEvent_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then(function(data){
            if (data.success){
                console.log("Successfully read events.");
                let events = data.events;
                document.getElementById("event").innerHTML = "";
                for (let event of events){
                    let date = year + "-" + month + "-" + day;
                    let divContent = "<div id=" + event["event_id"].toString() + ">";
                    divContent += "<h3 name='event_title'>" + event["event_title"] + "  " + date + "</h3>";
                    divContent += "<h4 name='event_body'>" + event["event_body"] + "</h4>";
                    divContent += "<button class='modify_btn' onClick='modifyEvents(this)'>Modify</button>";
                    divContent += "<button class='delete_btn' onClick='deleteEvents(this)'>Delete</button>";
                    divContent += "<p name='modify_event_title'></p>";
                    divContent += "<p name='modify_event_body'></p>";
                    divContent += "<button name='modify_submit_btn' onClick='modifySubmit(this)'>Modify</button>";
                    divContent += "</div>";
                    document.getElementById("event").innerHTML += divContent;
                }
                for (let btn of document.getElementsByName("modify_submit_btn")){
                    btn.style.display = "none";
                }
            }
        });
    }
}

function modifyEvents(obj){
    let event_id = obj.parentNode.id;
    let event = document.getElementById(event_id);
    let event_title = event.childNodes[0].textContent;
    let event_body = event.childNodes[1].textContent;
    event.childNodes[4].innerHTML = "Title:<br/><textarea rows='1' cols='100' type='text' name='title'>" + event_title + "</textarea>";
    event.childNodes[5].innerHTML = "Body:<br/><textarea rows='5' cols='100' type='text' name='body'>" + event_body +"</textarea>";
    event.childNodes[0].style.display = "none";
    event.childNodes[1].style.display = "none";
    event.childNodes[2].style.display = "none";
    event.childNodes[3].style.display = "none";
    event.childNodes[6].style.display = "inline";
}

function modifySubmit(obj){
    let event_id = obj.parentNode.id;
    let event = document.getElementById(event_id);
    let event_title = event.childNodes[4].childNodes[2].value;
    let event_body = event.childNodes[5].childNodes[2].value;
    const data = { 'id': parseInt(event_id), 'title': event_title, 'body': event_body };
    fetch("modifyEvent_ajax.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    })
    .then(response => response.json())
    .then(function(data){
        if (data.success){
            console.log("Successfully modified events.");
            alert("You've modified this event successfully!")
            let divContent = "<div id=" + event_id + ">";
            divContent += "<h3 name='event_title'>" + event_title + "</h3>";
            divContent += "<h4 name='event_body'>" + event_body + "</h4>";
            divContent += "<button class='modify_btn' onClick='modifyEvents(this)'>Modify</button>";
            divContent += "<button class='delete_btn' onClick='deleteEvents(this)'>Delete</button>";
            divContent += "<p name='modify_event_title'></p>";
            divContent += "<p name='modify_event_body'></p>";
            divContent += "<button name='modify_submit_btn' onClick='modifySubmit(this)'>Modify</button>";
            divContent += "</div>";
            event.parentNode.removeChild(event);
            document.getElementById("event").innerHTML += divContent;
            for (let btn of document.getElementsByName("modify_submit_btn")){
                btn.style.display = "none";
            }
            }
        });
}

function deleteEvents(obj){
    let deleteConfirm=confirm("Are you sure to delete this event?");
    if (deleteConfirm == true){
        let event_id = obj.parentNode.id;
        let event = document.getElementById(event_id);
        const data = { 'id': parseInt(event_id) };
        fetch("deleteEvent_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then(function(data){
            if (data.success){
                console.log("Successfully deleted events.");
                alert("You've deleted this event successfully!")
                event.parentNode.removeChild(event);
                }
            });
    }
}

function postEvents(){
  ///for (let i = 0; i < document.getElementsByName('whichday').length; i++){
     ///   if (document.getElementsByName('whichday')[i].checked){
        ///    day = document.getElementsByName('whichday')[i].textContent;
           /// break;
        ///}
///}
    let day = sessionStorage.getItem('day');
    monthEn = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    monthNum = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
    let year = document.getElementById("year").textContent;
    let month = monthNum[monthEn.indexOf(document.getElementById("month").textContent)];
    let title = document.getElementById("title").value;
    let body = document.getElementById("body").value;
    let username = document.getElementById("user").textContent;
    alert(year + "-" + month + "-" + day);
    if (username != ""){
        let date = year + "-" + month + "-" + day;
        if (title == null || title == "") {
            alert("Please enter the title of the event!");
        } else {
            const data = { 'title': title, 'body': body, 'username':username, 'date':date};
            fetch("postEvents_ajax.php", {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'content-type': 'application/json' }
            })
            .then(response => response.json())
            .then(function(data){
                if (data.success){
                    console.log("You've added this event successfully!");
                    alert("You've added this event successfully!");
                } else {
                    console.log(`Sorry, you failed to add this event,please try again!${data.message}`);
                    alert(`Sorry, you failed to add this event,please try again!`);
                }
            });
        }
    }else{
        alert("After log in, you can post the new event!");
    }
}