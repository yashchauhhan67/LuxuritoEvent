<?php

//Session start
session_start();
//Setting time zone
date_default_timezone_set('Asia/Kolkata');
//including database
include './DBC.php';

if (isset($_POST['book'])) {
    //storing data in variable

    $Checkin = $_POST['CheckIn'];
    $Checkout = $_POST['CheckOut'];
    $StartTime = $_POST['StartTime'];
    $EndTime = $_POST['EndTime'];
    $DateTime = date('Y-m-d h:i:s');
    $C_ID = $_SESSION['CID'];
    $C_Name = $_SESSION['CName'];
    $idvenue = $_POST['id'];
    $TotalAmount = $_POST['price'];

    if ($Checkin == $Checkout) {
        
        $check = "SELECT * from eventbooking WHERE (Start_Time >= $StartTime OR End_Time <= $EndTime) AND Venue_ID = '$idvenue'";
        $res_check = mysqli_query($con,$check);
       
                //query to add details of booking in database                
                $add_Booking = "INSERT INTO eventbooking (Check_in_date,Check_out_date,Start_Time,End_Time,Total_Amount,Booking_DateTime,Venue_ID,C_ID)VALUES('$Checkin','$Checkout','$StartTime','$EndTime','$TotalAmount','$DateTime','$idvenue','$C_ID')";
                            
                $qryReturn1 = $con -> query($add_Booking);
                if($qryReturn1 == true)
                {
                    //succes
                    echo '<script>alert("Event is Booked");'
                            . 'window.location.href = "Bookings.php";'
                            . '</script>';
                    
                }
                else{
                    //print errors
                    echo $con->error;
            }
        
        
        
    } else {
        $check = "SELECT * from eventbooking WHERE (Check_in_date >= $Checkin OR Check_out_date <= $Checkout) AND Venue_ID = $idvenue";
        $res_check = mysqli_query($con, $check);

        if (mysqli_num_rows($res_check) > 0) {
            //If result foung in database then redirect to venue-Detail page
            echo '<script>alert("Venue is Not Available");'
            . 'window.location.href = "EventDetail.php";'
            . '</script>';
        } else {
            //query to add details of booking in database                
            $add_Booking = "INSERT INTO eventbooking (Check_in_date,Check_out_date,Start_Time,End_Time,Total_Amount,Booking_DateTime,Venue_ID,C_ID)VALUES('$Checkin','$Checkout','$StartTime','$EndTime','$TotalAmount','$DateTime','$idvenue','$C_ID')";

            $qryReturn1 = $con->query($add_Booking);
            if ($qryReturn1 == true) {
                //succes
                echo '<script>alert("Event is Booked");'
                . 'window.location.href = "Bookings.php";'
                . '</script>';
            } else {
                //print errors
                echo $con->error;
            }
        }
    }
}
?>