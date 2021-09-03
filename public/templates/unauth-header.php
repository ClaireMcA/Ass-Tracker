<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Assignment Tracker</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/styles.css">
        <!-- <link rel="icon" href="../assets/favicon.svg" type="image/svg+xml"> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>

        <?php 
        require "calendar.php"; 
        ?>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/semantic.min.css">

    </head>
    <body>
        <nav class="ui labeled icon brown inverted menu">
            <div class="ui container">
                <a class= "item" href="">
                    <i class= "calendar outline icon"></i>
                    Assignment Planner
                </a>
                <div class= "right menu">
                    <a class= "item" href="login.php">
                        <i class= "sign in icon"></i>
                        Log In
                    </a>
                </div>
            </div>
        </nav>

        <div class="ui container">