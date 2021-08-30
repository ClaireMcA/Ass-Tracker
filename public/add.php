<?php 
    
    if (isset($_POST['submit'])) {

        require "../config.php"; 

        try {
            $connection = new PDO($dsn, $username, $password, $options);

            $new_ass = array( 
                "subjectname"    => $_POST['subjectname'], 
                "assignmentname" => $_POST['assignmentname'],
                "duedate"        => $_POST['duedate'],
                "weighting"      => $_POST['weighting'], 
                "completed"      => $_POST['completed'],
            );

            $sql = "INSERT INTO assignments (
                subjectname,
                assignmentname,
                duedate,
                weighting,
                completed
            ) VALUES (
                :subjectname,
                :assignmentname,
                :duedate,
                :weighting,
                :completed
            )";        
        
            $statement = $connection->prepare($sql);
            $statement->execute($new_ass);

        
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        
        }
    }

?>


<?php include "templates/header.php"; ?>  

<?php if (isset($_POST['submit']) && $statement) { ?>
    <p>Assignment successfully added.</p>
<?php } ?>

<form method="post">
    <label for="subjectname">Subject</label> 
    <input type="text" name="subjectname" id="subjectname"> 

    <label for="assignmentname">Assignment Name</label> 
    <input type="text" name="assignmentname" id="assignmentname"> 

    <label for="duedate">Due Date</label> 
    <input type="date" name="duedate" id="duedate"> 

    <label for="weighting">Weighting</label> 
    <input type="text" name="weighting" id="weighting"> 

    <label for="completed">Completion</label>
    <input type="text" name="completed" id="completed"> 

    <input type="submit" name="submit" value="Submit">
</form>



<?php include "templates/footer.php"; ?>