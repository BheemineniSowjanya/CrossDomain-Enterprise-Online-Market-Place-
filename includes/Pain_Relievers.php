<?php session_start();  include_once 'dbconnect.php';?>
<?php
    $result = $conn->query("SELECT * FROM Products where productId = 1");
    $prod = $result -> fetch_assoc();
    $hits = $prod["productHits"] + 1;
    $conn->query("UPDATE Products SET productHits = ".$hits." WHERE productId = 1");
    //$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Adhesive Tapes | LifeSaverHub</title>
</head>
<body class="australiaPage">
    <?php $page='Australia'; include 'navbar.php' ?>
    <?php
        if(isset($_SESSION["isSecure"]))
        {
            if($_SESSION["isSecure"])
            {
                $currentUserName = $_SESSION["user"];
                $result = $conn->query("SELECT * FROM UsersList where userName = '".$currentUserName."'");
                $customer = $result -> fetch_assoc();
                $custvisited = $customer["visited"];
                if(isset($custvisited) && $custvisited!="")
                {
                    //$custvisitedarr = explode(",",$custvisited);
                    //if(!in_array("A1",$custvisitedarr))
                    $custvisited = $custvisited.",A1";
                }
                else
                {
                    $custvisited = $custvisited."A1";
                }
                $conn->query("UPDATE UsersList SET visited = '".$custvisited."' WHERE userName = '".$currentUserName."'");
                //$conn->close();
            }
        }
        ?>
    <div class="topContainer">
        <!-- Carousel -->
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators/dots -->
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../img/pain1.jpeg" alt="Adhesive Tape1" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="../img/pain2.jpeg" alt="Adhesive Tape2" class="d-block" style="width:100%">
            </div>
            <div class="carousel-item">
                <img src="../img/pain3.jpeg" alt="Adhesive Tape3" class="d-block" style="width:100%">
            </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="longDescContainer">
            <h4 class="Desctext">Description</h4>
            <p class="longDesc">
            Welcome to the Pain Relief Products section of Life Saver Hub, where we offer a variety of high-quality products designed to provide relief from pain and discomfort. 
            Our pain relief products are crafted for effectiveness, comfort, and versatility.

            <br>
            <br>
            Our pain relief products are known for their exceptional quality and their ability to provide relief from various types of pain. Here are a few reasons to consider our products for your needs:

            Effective Relief: Our products are designed to provide effective relief from pain and discomfort.
            Comfortable Design: Designed for ease of use and maximum comfort during recovery.
            Versatile Use: Suitable for various types of pain relief, from muscle aches to joint pain.
            Responsive Customer Support: Our team is ready to assist with inquiries and orders.
            </p>
        </div>
    </div>

    <div class="bottomContainer">
        <div class="containerHeader">
            <h3 class="reviewsText">Reviews</h4>
            <?php 
                $sql = "SELECT * FROM Products WHERE productID = 1";
                $result = mysqli_query($conn, $sql);
                $rows = mysqli_num_rows($result);
                if($rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        echo "<div class='reviewContainer'>\n";
                            echo"<h4 style='margin-right:1em'>Average Rating</h4>";
                            for($i = 1; $i<=5; $i++)
                            {
                                $roundedRating = ceil($row["productAvgRating"]);
                                echo "<i class='fa fa-star ";
                                if($i <= $roundedRating)
                                {
                                    echo "checked";
                                }
                                else
                                {
                                    echo "unchecked";
                                }
                                echo"'></i>\n";
                            }
                    echo "</div>\n";
                    }
                }
            ?>
        </div>
        <?php 
            $sql = "SELECT * FROM Ratings WHERE productID = 1";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);
            if($rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "<div class='topReviewContainer'>\n";
                        echo "<div class='ratingContainer'>\n";
                            echo "<h4 class='currentUser'>".$row['userName']."</h4>";

                            for($i=1; $i<=5; $i++)
                            {
                                echo "<i class='fa fa-star ";
                                
                                if($i <= $row['rating'])
                                {
                                    echo "checked";
                                }
                                else
                                {
                                    echo "unchecked";
                                }
                                echo"'></i>\n";
                            }
                        echo "</div>\n";

                        echo "<div class='reviewContainer'>\n";
                            echo "<p class='reviewText'>".$row['review']."</p>";
                        echo "</div>\n";
                    echo "</div>\n";
                }
            }
        ?>
    </div>
</body>