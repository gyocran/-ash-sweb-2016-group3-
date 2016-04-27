<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
    font-family: 'Open Sans', sans-serif;
    font-weight: 300;
    line-height: 1.42em;
    color: #A7A1AE;
    /*background-color: #1F2739;*/
            }
            table {
      text-align: left;
    overflow: hidden;
    width: 80%;
    margin: 0 auto;
    display: table;
    padding: 0 0 8em 0;
}
td  {
    padding-bottom: 2%;
    padding-top: 2%;
    padding-left: 2%;
    /*padding-right: 2%;*/
}
h1{
    font-size: 3em;
    font-weight: 300;
    line-height: 1em;
    text-align: center;
    color: #4DC3FA
}
        </style>
        <title>Bookings</title>
        <script type="text/javascript" src="js/jquery-1.12.1.js"></script>
        <script type="text/javascript"></script>
    </head>
    <body>
        <script>
        function displayBookingsComplete(xhr) {
                var obj = $.parseJSON(xhr.responseText);
                var i = 0;
                var j = 0;
                var k = 0;
                var item;
                var result = obj.AllBookings.outcome[0].result;

// if result==2, display by week
                if (result === 2) {
//                    $("p").append("<table>");
                    item += "<table>";
                    item += "<tr><td colspan=2></td>";
                    item += "<th colspan=10>Time</th>";
                    item += "</tr>";
                    item += "<tr>";
                    item += "<th>Date</th>";
                    item += "<th>Labs</th>";
                    for (j = 0; j < obj.AllBookings.times.length; j++) {
                        item += "<td>" + obj.AllBookings.times[j].Time + "</td>";
                    }
                    item += "</tr>";
                    for (i = 0; i < obj.AllBookings.bookings.length; i++) {
                        var mod = i % 4;
                        if (mod === 0) {
                            item += "<tr><td rowspan = 4>" + obj.AllBookings.bookings[i].Date + "</td>";
                        }

                        item += "<td>" + obj.AllBookings.bookings[i].LabName + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status0 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status1 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status2 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status3 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status4 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status5 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status6 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status7 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status8 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status9 + "</td>";
                        item += "</tr>";
                        console.log(k);
                        console.log(i);
                    }
                    document.getElementById("displayTable").innerHTML = item;
                }



                else {
                    item += "<table class>";
                    item += "<tr>";
                    item += "<td></td>";
                    item += "<th colspan=10>Time</th>";
                    item += "</tr>";
                    item += "<tr>";
                    item += "<th>Labs</th>";
                    console.log(obj.AllBookings.bookings.length);
                    for (i = 0; i < obj.AllBookings.times.length; i++) {
                        item += "<td>" + obj.AllBookings.times[i].Time + "</td>";
                    }

                    for (i = 0; i < obj.AllBookings.bookings.length; i++) {
                        item += "</tr>";
                        item += "<td>" + obj.AllBookings.bookings[i].LabName + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status0 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status1 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status2 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status3 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status4 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status5 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status6 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status7 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status8 + "</td>";
                        item += "<td>" + obj.AllBookings.bookings[i].status9 + "</td>";
                        item += "</tr>";
                    }
                    document.getElementById("displayTable").innerHTML = item;
                }
                item += "</table>";
            }

            function displayBookings(obj) {
                var theUrl = "displayBookings_ajax.php?cmd=" + obj.value;
                $.ajax(theUrl,
                        {async: true,
                        complete: displayBookingsComplete}
                );
            }
        </script>
        <!--<link rel="stylesheet" href="css/style.css">-->
            
        <h1>Please Select Your Option From The Drop Down Below</h1>
        
        <form id="form">
            <select id= "displayvalue" onchange="displayBookings(this)">
                <option value='0'></option>
                <option value='1'>Today</option>
                <option value='2'>This week</option>
            </select>
        </form>
        
        <div id="displayTable"></div>
    </body>
</html>

