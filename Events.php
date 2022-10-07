<?php
//session started
session_start();

//include database
include './DBC.php';

$prj = "SELECT * FROM event";
$stmt = $con->query($prj);
if ($stmt) {
    while ($row = $stmt->fetch_assoc()) {
        $Idrecord[] = $row['Event_ID'];
    }
}
if (isset($_POST['btnFilter'])) {
    $VenueTypeID = $_POST['venuetype'];

    //query to get venue id in array
    $prj = "SELECT * FROM event where VType_ID = $VenueTypeID";
    $stmt = $con->query($prj);
    if ($stmt) {
        while ($row = $stmt->fetch_assoc()) {
            $Idrecord[] = $row['Venue_ID'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>


        <title>Events</title>
        <!-- ***** Bootstrap and css style links start ***** -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

        <link rel="stylesheet" href="assets/css/templatemo-training-studio.css">
        <!--<link rel="stylesheet" href="./assets/css/style_2.css">-->
        <link rel="stylesheet" href="assets/css/templatemo-training-studio.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <!-- ***** Bootstrap and css style links ends ***** -->
    </head>

    <body>
        <!-- ***** Header included ***** -->
        <?php include './Header.php'; ?>

        <!-- ***** Main Block Start ***** -->
        <section class="section section-bg" id="call-to-action">
            <div class="container">
                <div class="row">
                    <div class=" offset-lg-4">
                        <div class="cta-content">
                            <br>

                            <h2>Our <em>Events</em></h2>
                            <p></p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- ***** Main Block End ***** -->

        <!-- ***** Venues Block Starts ***** -->
        <section class="section" id="trainers">
            <div class="container">
                <div class="row">
                    <!--                    <form method="POST" action="VenuePage1.php">
                                            <p style="padding-left: 50px;">Filter By :</p>
                                            <table>
                    
                                                <tr style="">
                                                    <td style="padding-right: 10px; padding-left: 40px"><select name="venuetype" class="form-control">
                                                            <option value="">Select Venues Type</option>
                    
                    <?php
                    $sql = mysqli_query($con, "SELECT * FROM venuetype");
                    while ($row = $sql->fetch_assoc()) {
                        $id = $row['VType_ID'];
                        echo "<option value=\"$id\">" . $row['VType_Name'] . "</option>";
                    }
                    ?>
                                                        </select></td>
                                                    <td style="padding-right: 10px">
                                                        <input type="number" name="capacity" id="capacity" class="form-control" placeholder="capacity">
                                                    </td>
                                                    <td style="padding-right: 10px"><button type="submit" name="btnFilter" class="btn btn-danger">Filter</button>
                                                    </td>
                                                </tr>
                                            </table>
                    
                                        </form>-->
                    <div class="container">
                        <br>
                        <br>

                        <div class="row" style="display: inline-flex;">
                            <?php foreach ($Idrecord as $rec) { ?>
                                <div class="col-md-4">
                                    <div class="trainer-item">
                                        <div class="image-thumb1">
                                            <?php
                                            $idvenue = $rec;
                                            $srcimg = mysqli_query($con, "Select * FROM Eventimage where Venue_ID = $idvenue");
                                            while ($row = $srcimg->fetch_assoc()) {
                                                $id = $row['Venue_Image'];
                                                echo "<img src=\"assets/images/" . "$id\" >";
                                            }
                                            ?>
                                        </div>
                                        <div class="down-content">
                                            <br>
                                            <h4>
                                                <?php
                                                $idvenue = $rec;
                                                $srcprice = mysqli_query($con, "Select * FROM event where Event_ID = $idvenue");
                                                while ($row = $srcprice->fetch_assoc()) {
                                                    $id = $row['Event_Name'];
                                                    echo $id;
                                                }
                                                ?></h4>

                                            <h7>Price Per Day ₹<?php
                                                $idvenue = $rec;
                                                $srcprice = mysqli_query($con, "Select * FROM event where Event_ID = $idvenue");
                                                while ($row = $srcprice->fetch_assoc()) {
                                                    $id = $row['Price_PerDay'];
                                                    echo $id;
                                                }
                                                ?>
                                            </h7>
                                            <br>

                                            <h7><i class="fas fa-location-arrow">&nbsp;&nbsp; </i><?php
                                                $idvenue = $rec;
                                                $srcprice = mysqli_query($con, "Select * FROM event where Event_ID = $idvenue");
                                                while ($row = $srcprice->fetch_assoc()) {
                                                    $id = $row['Venue_Address'];
                                                    echo $id;
                                                }
                                                ?>
                                            </h7>
                                            <br>
                                            <h7><i class="fa fa-group"></i>&nbsp;&nbsp;<?php
                                                $idvenue = $rec;
                                                $srcprice = mysqli_query($con, "Select * FROM event where Event_ID = $idvenue");
                                                while ($row = $srcprice->fetch_assoc()) {
                                                    $id = $row['Capacity'];
                                                    echo $id;
                                                }
                                                ?>
                                            </h7>

                                            <ul class="social-icons">
                                                <li><?php echo '<a href="EventDetails.php?link=' . $idvenue . ' "> <b>+ View Detail</b></a>'; ?></li>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <li><?php echo '<a href="WishlistDBC.php?id=' . $idvenue . '" name="WishList"><b>+Add to WishList</b></a>'; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ***** Venues Block Ends ***** -->


        <!-- ***** Footer included ***** -->
        <?php include './Footer.php'; ?>




    </body>

</html>