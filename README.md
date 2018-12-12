# Comp5130 Internet & Web system WeeklyReport
## Cheng Wei Liao (#01668051)
Demo : http://weblab.cs.uml.edu/~cliao/
## Purpose of this project
To build a platform that allows users to buy used or new items in a lower or reasonable price and also allow users to sell those items they are no longer used. 
## How to configure
SQL:
1. Create your own database
2. Import "preownstore.sql" into your database

PHP:
1. Open "config.php"
2. Modify corresponding variables to match your setting
```
$Srv_Host = "Your IP";
// Database Settings
$Srv_Database = "Database Name";
$Srv_Username = "Database Username";
$Srv_Password = "Database Password";
```
3. Upload all the files in "Source Code" folder onto HTTP server.

Note:

There are some default accounts appended in the sql file, deleted by your own if you don't want to use them.

The default usernames and passwords are listed below.
```
| [Username] |  [Password] |
|preownseller| preownseller|
|preownbuyer | preownbuyer |
|    alex    |    123456   |
|    david   |    123456   |
```
