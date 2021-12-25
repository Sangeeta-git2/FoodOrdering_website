<?php include('config/constant.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>website for restaurant</title>
</head>
<body>
    <!--navbar ko lagi starting-->
    <section class="navbar">
        <div class="container">
        <div class="logo"><img src="images/logo.png" alt="restaurant logo" class="response">
        </div>
        <div class="menu text-right">
            <ul class="colorchange">
                <li>
                    <a href="<?php echo SITEURL; ?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>categories.php">categories</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>foodko.php">foods</a>
                </li>
                
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    </section>