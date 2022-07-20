# RapidPrototypeDevelopment-CreativeProgramming_WashU
The code in WashU 2022 Summer CSE 503S Rapid Prototype Development and Creative Programming.
### Module 1 - Individual Assignments
1. **Write a birthday card to a friend or family member using HTML and CSS.** Use HTML to define the content of the card (like the headings and the paragraphs), and use CSS to define the appearance. 
2. **Write an HTML document containing a form that searches DuckDuckGo's web site.** You should be able to type in a search term and have your form load the DuckDuckGo search page. In this HTML document you must also include this course's regrade policy to ensure that you have read it and understand it. 
### Module 2 - Group Assignments
1. **Simple File Sharing Site.** Make a simple file sharing site that supports uploading, viewing, and deleting files associated with various users. Details:
- Have a file named users.txt stored in a secure place on your filesystem. It should have at least three usernames, with one username per line.
- Users of the file sharing site should be able to enter their username and then log in.
- Users should see a list of all files associated with their username after the log in.
- Users should be able to view, upload, and delete files associated with their username.
- The URI should NOT reveal the internal file structure of your web site.
- Customize file sharing site by implementing an additional feature or two as part of the creative portion.
### Module 2 - Individual Assignments
1. **Make a calculator using PHP and an HTML form.** The form should have two inputs. The form should submit a GET request either back to the same page or to a different results page. The calculator should support addition, subtraction, multiplication, and division by means of a radio button group on the page.
### Module 3 - Group Assignments
1. **Simple News Web Site.**
- Users can register for accounts and then log in to the website.
- Accounts should have both a username and a secure password. NEVER store plaintext passwords in a database!
- For more information on password security, refer to the Web Application Security guide.
- Registered users can submit story commentary.
- A link can be associated with each story, and they should be stored in a separate database field from the story.
- Registered users can comment on any story.
- Unregistered users can only view stories and comments.
- Registered users can edit and delete their stories and comments.
- All data must be kept in a MySQL database (user information, stories, comments, and links).
- Creative Portion. (Change password, delete account, personal profile, comments).
### Module 4 - Individual Assignments
1. **Write some Regular Expressions.** Write regular expressions that do each the following:
- Match the substring "hello world" in a string.
- Find all words in an input string that contains three or more consecutive vowels, regardless of case.
- Match an input string that is entirely a flight code, of the format AA####, where AA is a two-letter uppercase airline code, and #### is a three- or four-digit flight number.
2. **Baseball Stats Counter.** The St. Louis Cardinals are the most legendary baseball team in the national league. In this exercise, I created a Python script that reads box scores from a file and computes the Cardinals' players' batting averages in a particular season.
### Module 5 - Group Assignments
1. **Build a simple calendar that allows users to add and remove events dynamically.** 
- Support a month-by-month view of the calendar.
- Users can register and log in to the website.
- Unregistered users should see no events on the calendar.
- Registered users can add events.
- Registered users see only events that they have added.
- Registered users can edit and delete their own events, but not the events of others.
- All user and event data should be kept in a database.
- At no time should the main page need to be reloaded.
### Module 5 - Individual Assignments
1. **JavaScript Calculator**
- The web page should have two input fields and a radio button group for the operation, with the 4 basic math operations represented (add, subtract, multiply, divide).
- JavaScript should monitor all three fields and display the current result whenever the user changes any value in any field, without refreshing the page.
- The calculator should be completely self-contained; i.e., you should not be making any requests to any other server-side or client-side scripts or web pages after the initial page load.
2. **Weather Widget**
- Make an empty HTML document; name it weather.html
- Define a function in JavaScript; call it fetchWeather().
- Inside your fetchWeather() function, make an AJAX request to the weather server.
- In your callback, process the JSON and use JavaScript to manipulate the HTML DOM to display the following information on your page: Location, City, State, Humidity, Current Temperature, Image for Tomorrow's Forecast, Image for the Day After Tomorrow's Forecast.
- Finally, bind fetchWeather() to the DOMContentLoaded event so that your weather widget is automatically initialized when the page is loaded.
- In addition, add a button that runs your fetchWeather function when clicked. This should update your widget with the current weather conditions.

