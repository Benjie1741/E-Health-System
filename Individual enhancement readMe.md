Arjun Grewal - B6025753 Individual Enhancement

Accessibility Page - theme, text size, font
Password change

For my Individual Enhancement as part of the group project I have added a settings page with accessibility options, and a change
password option.

How they were implemented:

The accessibility settings were implemented by adding fields to the database storing the settings. The settings are then stored in sessions
when the user logs in so that the theme can persist throughout the different pages and though logouts. The sessions and fields are updated
when the user clicks save changes on the settings page.

The password change was added by asking the user to enter their old password, new password, and to confirm the new password.
It first checks to see if the 2 new passwords are the same, and then it check if the old password is the same, then it will update the 
password in the database. It will also hash the new password.

What Benefits this Enhancement offers:

The reason I added a accessibility setting was becasue our system is a e-health web app that doctors give to patients so patients who
have visual difficulties are still able to use the system, either by changing the font size, the colours, or the fonts themselves. It 
is also just so that the user can feel comfortable using the system, as some people prefer a dark mode over a light mode becasue it is
easier on the eyes at all times of the day.

The reason I added a password change feaute, was because in the group version the doctor sets the users password when he registers them
and then the user has to sue that password forever. However users might want to change the password to something that they can easiy remeber,
and might feel more comfortable knowing that no one else knows the password to their account as it hold sensitive health data.

Testing:

In order to sufficently test my individual enhancement, Manual Unit Testing was used. Each button was tested to ensure it was working
as intended. I also did amnual unit testing for the password change function, and tested the PhP functions.

Proof of this can be found in the 'Manual Unit Testing - Individual Enhancement' File on this Branch. 
