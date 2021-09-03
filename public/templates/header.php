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
        <link rel="stylesheet" type="text/css" href="../assets/SemanticUI/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

    </head>
    <body>
        <nav class="ui labeled icon brown inverted five item menu">
            <div class="ui container">
                <a class= "item" href="index.php">
                    <i class= "calendar outline icon"></i>
                    My Planner
                </a>
                <a class= "item" href="add.php">
                <i class= "edit outline icon"></i>
                    Add a New Assignment
                </a>
                <div class= "right menu">
                    <a class= "item" href="account.php">
                    <i class= "user icon"></i>
                        <?php echo htmlspecialchars($_SESSION["username"]); ?>
                    </a>
                    <a class= "item" href="logout.php">
                    <i class= "sign out icon"></i>
                        Log Out
                    </a>
                </div>
            </div>
        </nav>
    
        <div class="ui container">
