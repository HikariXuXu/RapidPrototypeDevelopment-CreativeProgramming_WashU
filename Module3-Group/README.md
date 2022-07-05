# CSE330
Kaiyu Zhang - 489920 - kaiyuky

Minghao Xu - 502549 - HikariXuXu

# Module 3 Group Assignment

## Assignment link
http://ec2-18-191-155-206.us-east-2.compute.amazonaws.com/~MarkXu/News/news.php


## File management Features
### User management
- Users can register and log out.
- Passwords are hashed, salted, and checked securely.
- Users can only edit/delete their own posts.

### Story and Comment Management
- Set the correct data types, primary and foreign keys for the database.
- Stories can only be posted after logging in.
- Comments can be posted in association with a story after logging in.
- Stories can be edited and deleted by the uploader.
- Comments can be edited and deleted by the reviewer.

### Best Practices
- There are proper comments in our code.
- Safe from SQL Injection attacks.
- The code was written to follow FIEO policy.
- All pages pass the W3C validator.
- CSRF tokens are passed when creating, editing, and deleting comments and stories.

## Creative Portion
- Delete the account: If users do not want to use their account anymore, they can go to the "Settings" to delete the account. Once delete it, all information about the account will be deleted (including the username, password and your posts), the data will also be deleted from the database.
- Change the password: Users can change the password in "Setting".
- Registered users can see their own personal profile (all their posts) when click on their username on the top of the page or under each news or comments. Users can see others personal profile when click on the username.
- Registered users can click on "comments" in his personal profile page and see all the comments about their posts.
- "Released time" function: All posts on the site are ordered by time (Newest one is on top, oldest one is on bottom), and users can see the time of all released posts.

## How to use?
- We have already created 3 usernames, they are: Luna(pwd: luna123456), Finn(pwd: Finn123456) and Milo(pwd: milo123456). And you can create any other username and post anything new as you want！
- In the home page, you can see all the news uploaded by registered users ordered by time. Click the title of the news, you can see the link. Click on "comments" under each news, you can see the details (title, body, uploader, time, comments) of the news or comment the news.
- If you want to post a new story, click on "Post" in your own personal profile.
- In the profile of yourself, you can click on "Comments" on the top of the page to see the comments about your posts ordered by time.
- You can change your password or delete your account in "Setting".
