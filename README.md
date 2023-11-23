# ActionSphere Cinemas - Ticket Booking System
SWE20001 - ActionSphere Cinemas


ActionSphere Cinemas is a startup movie theatre that specializes in providing patrons the opportunity to reserve screenings of various movie genres, with a primary focus on action films. Additionally, the cinema offers distinct themed spaces available for renting, complete with action-oriented decorations, games, and events, creating an immersive experience for visitors. 

They are looking to have a web-based application for their customers to get to know their business operations and what they have to offer and make reservations. Simultaneously, the backend system is being designed to empower the staff in efficiently overseeing and managing these bookings. 

Therefore, we bring this development to github for easy collaboration between the development team and audit for changes made to the code and for file redundancies.

----------------------------------------
Requirements for testing:
XAMP, Cisco Anyconnect Swinburne VPN, sendmail module

Steps:
1. Our host is done on localhost via XAMP. Our database is hosted on swinburne Feenix MariaDB, Cisco Anyconnect is required to connect to Swinburne VPN for MariaDB
   (vpn.swin.edu.au/mfa)

2. In order for our mail function to work correcrtly, XAMP will need to be configured (config.ini and sendmail module)
   (Make sure to download the sendmail module folder!)
   [Note: INTI Subang campus: INTI campus wifi will block off the sending of mail, try other network methods]
   Configure XAMP for mail module Tutorial Video: https://www.youtube.com/watch?v=TvaKz3wwvWY

3. Our database is on Feenix MariaDB, you may refer to the database for our tables.
   [Note that the tables involved in this server is only the ones that have the name format "Action_******"]
   link:https://feenix-mariadb-web.swin.edu.au/index.php?route=/
   Username: s104653754
   Password: 260404

4. Main page of our system is: http://localhost/ActionSphere/indexguest.php
