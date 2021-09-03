Ability to document development processes and outcomes
Demonstrated attention to detail in written work

# h1
## h2

**bold**
*italics*


- dot
- points
- are
- helpful


# Basic Web Application
## Claire McAuliffe

#### The Early Plans
Right from the start I was keen to create an assignment planner. For a planner, i think it is important that you can visualise the assignment due dates on a calendar, so i knew it would be important to find the right calendar to work with.

I began with determining what inputs I would need for the database, by thinking about what information you might need to know about each assignment. I decided on:
- Subject
- Assignment Name
- Due Date
- Weighting
- Completion Progress of the Assignment

Once I knew the data inputs and I had found my [calendar](https://codepen.io/nijin39/pen/JbQBXM), I created the index page first, as well as the footer and header templates. This let me determine what links would be in my navigation bar and start to look at how the calendar works. 

From there I began to write the 'Create' section of the site, so that I had data in my database I could work with. This then allowed me to start attempting to display the data on the calendar.

Recieveing the data from the database and then spitting it out into an array that the javascript for the calendar could understand took some time. Once I had created, what I thought was, a 'javascript style' array output, I was confused why the events weren't displaying in the calendar. But using developer tools, I realised that Javascript was trying to run the comments that I had in my PHP file, because I had brought it across using the 'include' expression. Once I finally realised I needed to delete those comments, the events displayed perfectly.

