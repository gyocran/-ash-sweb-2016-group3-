<html>
    <head>
        <title>Bookings</title>
    </head>
    <body>
        <form action="displayBookings_ajax.php" method="GET">
            <select name="displayOption">
                <option value='1'>Today</option>
                <option value='2'>This week</option>
            </select>
            <input type="submit" value="display">
        </form>
<?php
//use onready function at the end of the body to call the byDay function

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
    </body>
</html>

