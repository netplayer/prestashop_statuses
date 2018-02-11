# prestashop_statuses
<i>Upgrade order statuses when migrating from 1.4 to 1.5 and above Prestashop version<i>

Recently had to add manualy update of an already upgraded Prestashop version 1.4x to v. 1.6x via one-click update.

Old version restores current order status directly from statuses history while newer versions save last status in orders table.

<u>SOLUTION:</u>
This file contains a quick rty script you can run externally to prestashop in order to update old version's database that has been upgraded to a newer version but you still need to move statuses manually.

<b>SETUP</b>:

Upload the file (fix.php) on the server that hosts the database and replace the connection information in it.
Also, if your database does not use the default db prefix, replace "ps_" prefix with yours.

Run the file once to update the database.

Erase the file as soon you finish, if it is a production server.

