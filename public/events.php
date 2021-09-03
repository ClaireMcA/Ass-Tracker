<?php 
	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM assignments";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	

?>

<?php

 // This is a loop, which will loop through each result in the array
    // $i = 0;

    foreach($result as $row) { 

        // this will output the data in a way that the javascript calendar can read
        
        // echo file_put_contents ("events.php","{
        //     title: '" . $row['subjectname'] . ": " . $row['assignmentname'] . "',
        //     start: '" . $row['duedate'] . "'
        // },");

        
        echo ("{
                title: '" . $row['subjectname'] . ": " . $row['assignmentname'] . "',
                start: '" . $row['duedate'] . "',
                url: 'event-page.php?id=" . $row['id'] . "'
            },");
    

        // array_push($events, array(
        //     'title' => $row['subjectname'] . ": " . $row['assignmentname'],
        //     'start' => $row['duedate'], 
        // ));


        // events[$i] = 
        //     title: '$row['subjectname']: $row['assignmentname']',
        //     start: '2021-12-09T16:00:00',
        //     end: '2021-12-09T16:00:00'
        // };
    
        // $i = $i + 1;
    
    }; //close the foreach
 



?>