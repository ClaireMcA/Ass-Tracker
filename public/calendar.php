



<script type="text/javascript"> 

    let today = new Date().toISOString().slice(0, 10)

    $(document).ready(function() {
            
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek'
            },
            defaultDate: today,
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: [
                

                <?php require "events.php" ?>
                
            ]
            
        });
        
    });

</script>
