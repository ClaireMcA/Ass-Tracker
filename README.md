# Basic Web Application
## Claire McAuliffe

### The Early Plans
Right from the start I was keen to create an assignment planner. For a planner, i think it is important that you can visualise the assignment due dates on a calendar, so i knew it would be important to find the right calendar to work with.

I began with determining what inputs I would need for the database, by thinking about what information you might need to know about each assignment. I decided on:
- Subject
- Assignment Name
- Due Date
- Weighting
- Completion Progress of the Assignment

Once I knew the data inputs and I had found my [calendar](https://codepen.io/nijin39/pen/JbQBXM), I created the index page first, as well as the footer and header templates. This let me determine what links would be in my navigation bar and start to look at how the calendar works. 

### Working on the 'CR' Bit
From there I began to write the 'Create' section of the site, so that I had data in my database I could work with. This then allowed me to start attempting to display the data on the calendar.

Recieveing the data from the database and then spitting it out into an array that the javascript for the calendar could understand took some time. Once I had created what I thought was, a 'javascript style' array output, I was confused why the events weren't displaying in the calendar. But using developer tools, I realised that Javascript was trying to run the comments that I had in my PHP file, because I had brought it across using the 'include' expression. Once I finally realised, I needed to delete those comments, the events displayed perfectly.

### Authentication System
Once I had a homepage and add page, it was time to create a way to login to those pages. It took a while to wrap my head around how php deals with sessions, and also how to create some security around storing passwords. As I continued to work on the PHP we were given in class to save users to the database and check their credentials when it is time to log in, it started to make more sense. 

### And Now for the ‘UD’ Bit
To make the Web App feel more like something you might come across in the real world, I felt it was important to have the edit and delete buttons on the page that also lets you read the assignment information. This meant I had to learn quite a bit about how the $_GET and $_POST variables work. Utilising the way the $_GET takes information from the URL and how you can add information to the URL, to make sure that things weren’t edited when they were meant to be deleted, or deleted when they were simply meant to display on the page.

### Sticking to the Rubric
The trickiest part of this project was to keep the scope of the app in check and prioritise the key parts of it. It is important to make sure that the app is CRUD before working on other features like a list view to go alongside the calendar, or a change username form to go with the change password. This was quite a challenge for me.

### Making it Presentable
Once the functionality of the app was up and running, I used a framework to format everything to make it feel just a bit more polished. Sadly, I ran into some problems when it came to giving the calendar any kind of styling, but all the other site pages were given a clean-up to make the user experience a bit more friendly.

### Time to Roll Out
Once I was *reasonably* happy with the site, it was time to get it live. I had spent a bit of time finding my way around Siteground in the past week, this meant that I already had a database with details for a user with access in a remote config file. I also had an FTP Account set up, so I could connect easily to the site with FileZilla and transfer all the relevant files. Having pushed the latest version of the site to GitHub and with a working link to the website, this brought my Assignment Tracker project to completion.
