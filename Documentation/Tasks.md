#Nathan

##July 3rd, 2013

1. Create directory for POST requests from mobile application 
2. Get POST requests working with responses from mobile application to server.
3. Create authentication script that checks credentials from mobile application against server DB.

##July 4th, 2013

1. Create registration script that assigns a unique ID to each device and records device type.
2. Plan out database structure for unique ID's and device ID's
3. Begin planning syncing function so that...
	- it does not slow down as database size increases.
	- it does not send unnecessary data (that exists both on server and locally)
	- it does not send raw commands for security reasons.

##July 5th, 2013

1. Finish syncing function and begin writing script.
	- See image below for finished process
	- Begin pseudo-writing code before diving right in.
2. Add device type to registration script.

![Syncing Image](syncing.JPG?raw=true)

##July 8th, 2013

1. Split registration script into two different scripts.
2. Finish account_registration script that validates/creates user account
3. Resolve issue with database queries in account_registration script


##Left To Do

1. Display progress data on `reports.php` using [Highcharts JS](http://highcharts.com)
	- Show all students and click to view reports, maybe?
2. Create CRUD functions for attempts
3. Create CRUD functions for accounts
	- We want this to happen on mobile, right?
4. Create UD (C & R are done) functions for courses 
	- probably on this page: `courses.php?action=viewCourse`.
5. Create CRUD for Task Management (will we allow modification of tasks)? 
	- Started
6. Are all default tasks in?
7. Display notice when incorrect login is entered
8. <del>Eliminate buttons on home page (like reports and progress, only show when logged in)</del> Done
9. Create friendly homepage.
14. Make logging out redirect to home page.
 
