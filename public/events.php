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
    $i = 0;

    foreach($result as $row) { 

        // this will output the data in a way that the javascript calendar can read
        
        // echo "{
        //     title: '" . $row['subjectname'] . ": " . $row['assignmentname'] . "',
        //     start: '" . $row['duedate'] . "'
        // },";

        array_push($events, array(
            'title' => $row['subjectname'] . ": " . $row['assignmentname'],
            'start' => $row['duedate'], 
        ));


        // events[$i] = 
        //     title: '$row['subjectname']: $row['assignmentname']',
        //     start: '2021-12-09T16:00:00',
        //     end: '2021-12-09T16:00:00'
        // };
    
        $i = $i + 1;
    
    }; //close the foreach
 



?>



    <!-- {
        title: 'English: All Day Event',
        start: '2021-12-09T16:00:00',
        end: '2021-12-09T16:00:00'
    },
    {
        title: 'Long Event',
        start: '2016-12-07',
        end: '2016-12-10'
    },
    {
        id: 999,
        title: 'Repeating Event',
        start: '2016-12-09T16:00:00'
    },
    {
        id: 999,
        title: 'Repeating Event',
        start: '2016-12-16T16:00:00'
    },
    {
        title: 'Conference',
        start: '2016-12-11',
        end: '2016-12-13'
    },
    {
        title: 'Meeting',
        start: '2016-12-12T10:30:00',
        end: '2016-12-12T12:30:00'
    },
    {
        title: 'Lunch',
        start: '2016-12-12T12:00:00'
    },
    {
        title: 'Meeting',
        start: '2016-12-12T14:30:00'
    },
    {
        title: 'Happy Hour',
        start: '2016-12-12T17:30:00'
    },
    {
        title: 'Dinner',
        start: '2016-12-12T20:00:00'
    },
    {
        title: 'Birthday Party',
        start: '2016-12-13T07:00:00'
    },
    {
        title: 'Click for Google',
        url: 'https://google.com/',
        start: '2016-12-28'
    } -->


