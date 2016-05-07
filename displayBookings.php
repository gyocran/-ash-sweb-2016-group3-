<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                color: #A7A1AE;
                text-align: center;
            }

            .container {
                overflow: hidden;
                width: 80%;
                margin: 0 auto;
                display: table;
                background: #A32222;
            }
            td  {
                color: #A32222;
                padding-bottom: 2%;
                padding-top: 2%;
                padding-left: 2%;
                padding-right: 2%;
            }

            .container th h1{
                text-align: center;
                font-weight: 900;
                padding-bottom: 2%;
                padding-top: 2%;
                padding-left: 2%;
                padding-right: 2%;
                color: #fb667a
            }

            .container th{
                padding-left: 2%;
                padding-right: 2%;
                padding-bottom: 1%;
                padding-top: 1%;
            }
            .container td{
                padding-left: 2%;
                padding-right: 2%;
                font-weight: bold;
                color: yellow;
            }

            .container td:first-child {
                color: #fb667a;
                text-align: center;
                font-weight: 900;
            }

            .container tr:nth-child(odd) {
                background-color: #594875;
            }

            .container tr:nth-child(even) {
                background-color: #575475;
            }

            .container td:hover {
                background-color: #FFF842;
                color: #403E10;
                font-weight: bold;
                box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
                transform: translate3d(6px, -6px, 0);

                transition-delay: 0s;
                transition-duration: 0.4s;
                transition-property: all;
                transition-timing-function: line;
            }

            h1{
                font-size: 1em;
                font-weight: 100;
                line-height: 1em;
                text-align: left;
            }

            .viewTable{
                background: #f5f5f5;
                border-collapse: separate;
                box-shadow: inset 0 1px 0 #fff;
                font-size: 12px;
                line-height: 24px;
                margin: 30px auto;
                text-align: left;
                width: 800px;
            } 
        </style>
        <title>Bookings</title>
        <script type="text/javascript" src="js/jquery-1.12.1.js"></script>
        <script type="text/javascript"></script>
    </head>
    <body>
        <script>
            /*
             * 
             * @param {type} xhr
             * @returns {undefined}
             */
            function displayBookingsComplete(xhr) {
                var obj = $.parseJSON(xhr.responseText); //retrive JSON object from ajax page
                //variables for looping
                var i = 0;
                var j = 0;
                var numLabs = obj.AllBookings.labs.length; //determines the length of labs array
                var item = "<br>"; // used for displaying table in div.innerHTML
                var result = obj.AllBookings.outcome[0].result; // determines whether to display week's bookings of day's bookings

                // if result==2, print out table for week's bookings
                if (result === 2) {
                    item += "<table class=\"container\">";
                    item += "<tr><th colspan=2></th>";
                    item += "<th colspan=10>Time</th>";
                    item += "</tr>";
                    item += "<tr>";
                    item += "<th>Date</th>";
                    item += "<th>Labs</th>";

                    // print out all the times in a loop
                    for (j = 0; j < obj.AllBookings.times.length; j++) {
                        item += "<th><h1>" + obj.AllBookings.times[j].Time + "</h1></th>";
                    }
                    item += "</tr>";

                    // print out booking information including labs, booking status and dates in a loop 
                    for (i = 0; i < obj.AllBookings.bookings.length; i++) {

                        /* 
                         * var mod is used to make date column span some rows
                         * if the modulus of the count and the number of labs is 0,
                         * then print out the date to span {numLabs} rows
                         */
                        var mod = i % numLabs;
                        if (mod === 0) {
                            item += "<tr><th rowspan =" + numLabs + ">" + obj.AllBookings.bookings[i].Date + "</th>";
                        }

                        item += "<th><h1>" + obj.AllBookings.bookings[i].LabName + "</th></h1>";
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



                else {
                    item += "<table class=\"container\">";
                    item += "<tr>";
                    item += "<th><h1></h1></th>";
                    item += "<th colspan=10>Time</th>";
                    item += "</tr>";
                    item += "<tr>";
                    item += "<th>Labs</th>";

                    // print out all the times in a loop
                    for (i = 0; i < obj.AllBookings.times.length; i++) {
                        item += "<th><h1>" + obj.AllBookings.times[i].Time + "</h1></th>";
                    }

                    for (i = 0; i < obj.AllBookings.bookings.length; i++) {
                        item += "</tr>";
                        item += "<th><h1>" + obj.AllBookings.bookings[i].LabName + "</h1></th>";
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

                }
                item += "</table>";
                document.getElementById("displayTable").innerHTML = item;
            }

            // ajax function to display bookings
            function displayBookings(obj) {
                var theUrl = "displayBookings_ajax.php?cmd=" + obj.value;
                $.ajax(theUrl,
                        {async: true,
                            complete: displayBookingsComplete}
                );
            }
        </script>
        <link rel="stylesheet" href="css/style.css">

        <h2>Please Select Your Option From The Drop Down Below</h2>

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

