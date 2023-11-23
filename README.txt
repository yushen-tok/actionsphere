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