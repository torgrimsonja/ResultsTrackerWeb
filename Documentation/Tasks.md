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
	- it does not send unnecessary data (that which exists both on server and locally)
	- it does not send raw commands for security reasons.

##July 5th, 2013

1. Finish syncing function and begin writing script.
	- See image below for finished process
	- Begin pseudo-writing code before diving right in.
2. Add device type to registration script.
3. Eliminate buttons on home page (like reports and progress, only show when logged in)

![Syncing Image](syncing.JPG?raw=true)

##July 8th, 2013

1. Split registration script into two different scripts.
2. Finish account_registration script that validates/creates user account
3. Resolve issue with database queries in `account_registration` script
4. Format daily tasks and timesheet information.
5. Research correct method of retrieving friendly device info (ex: iPhone5 iOS 6.1.3)
6. Implement device method in mobile application (really: bug Joey until he does it for me)
7. Continue working on pseudo-code for syncing script (not pushed yet)
8. Provide consultation for navigation (at $40 an hour, of course)

##July 9th, 2013

1. Updated `account_registration` script to update `device` table with assigned `account_id`
2. Fixed Web Login script (request, error message, and redirect)
3. Get PhoneGap SQLite plugin working on mobile application
4. Get Java to work on my machine
5. Install Android Studio and configure for Results Tracker (Started)
6. Debug `device_registration` script working with jQuery Mobile application
7. Remotely debug POST requests to device registration.
8. Work on local persistence of logging in
9. Work on crUD of courses

##July 10th, 2013 - Todo

1. Get logout script working correctly (redirect doesn't work right.
2. Get the app running locally on Android Studio
3. Finish course crUD
	- on this page: `courses.php?action=viewCourse`.

##Left To Do

1. Display progress data on `reports.php` using [Highcharts JS](http://highcharts.com)
	- Show all students and click to view reports, maybe?
2. Create CRUD functions for attempts
3. Create CRUD functions for accounts
	- We want this to happen on mobile, right?
5. Create CRUD for Task Management (will we allow modification of tasks)? 
	- Started
6. Are all default tasks in?
7. Create friendly homepage.
 
