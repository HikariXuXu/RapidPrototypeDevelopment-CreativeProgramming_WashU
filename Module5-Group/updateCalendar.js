function updateCalendar(){
    let today = new Date();
    let todayyear = today.getFullYear();
    let todaymonth = today.getMonth();
    let todayday = today.getDate();
    let weeks = currentMonth.getWeeks();
    let month = currentMonth.month;
    let year = currentMonth.year;
    document.getElementById("days").textContent = "";
    const monthEn = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.getElementById("month").textContent = monthEn[month];
    document.getElementById("year").textContent = year.toString();
    for (let w in weeks){
        let days = weeks[w].getDates();
        for (let d in days){
            if(days[d].getDate()==todayday && month==todaymonth && year==todayyear){
                document.getElementById("days").innerHTML += ("<button name = 'whichday', style='color: #FFC0CB;'>"+days[d].getDate()+"</button>");
            }else if(month!=days[d].getMonth()){
                document.getElementById("days").innerHTML += ("<p></p>");
            }
            else if(days[d].getDate()!=todayday){
                document.getElementById("days").innerHTML += ("<button name = 'whichday'>"+days[d].getDate()+"</button>");
            }
        }
    }
    let days = document.getElementsByName('whichday');
    for (let day of days){
        day.addEventListener("click", showAddEvents, false);
    }
    
}