Greg Smith - B6003797 Individual Enhancement

Social Media Sharing Buttons - Twitter and Facebook

For my Individual Enhancement as part of the group project I decided to add Social media buttons to the website.
These are present on all pages displaying graph data, this includes Patient Heart Rate, Exercise and Sleep.

How they were implemented:

Both buttons were implemented using their respective API's. an API is an Application Programming Interface that essentially
allows two applications to talk to each other. In order to implement this functionality I first had to sign up to both Twitter
and Facebook's development sites in order to gain access to use their API's.

The Twitter Post Button was the first one I implemented. Firstly, a twitter variable was created which contained all of the health data
which I wanted to be displayed in the post - this included the value and the date it was recorded. A HREF attribute was then used
containing the link to the users Twitter create a post page. It also contained php code to echo the data type that was being posted
(Heart Rate, Exercie or Sleep) and the Twitter variable containing the Health Data. This was done to automatically populate the post 
field when the user clicks on the Twitter Button.

The Facebook share button was next. This uses Facebook's API to create a post for the user currently logged into their account.
The generated code for Facebook's API was inserted into the code in order to do this. The actual Share Button was then created which
at the moment contains a link to google as a placeholder. If our eHealth website was actually live this would be linked instead,
essentially allowing users to post the use of our eHealth application to their facebook walls.

What Benefits this Enhancement offers:

The main reason I decided to implement the Social Media Buttons to the project was to enhance the user experience of the system.
The use of the two buttons allows users to keep their friends and family up to date with their progress and results through
Social Media. If they were to use this functionality regularly and post to their Social Media more often, it would also mean they could
monitor their long term progress because our system only displays health data for the latest week. 

Testing:

In order to sufficently test my individual enhancement, Manual Unit Testing was used. Each button was tested to ensure it was working
as intended. Proof of this can be found in the 'Manual Unit Testing - Individual Enhancement' File on this Branch. 
