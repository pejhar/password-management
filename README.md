# password-management
A simple website for password management
NOTE: This repository is no longer supported or updated by GitHub. If you wish to continue to develop this code yourself, we recommend you fork it.

# Details:


You should create a password management website.

We can have multi types of passwords. For example, types can be website password, ssh key, wifi password, ... . Password types should be dynamic and we should can add or remove a type.

Also, we should have users and authentication on the website.

We need a CRUD panel for passwords.

Also, we should can update and delete password types.

For users, we don't need any CRUD panel. We only need to add or remove users manually in our database.

# Notes:
1- You should create this project with Laravel or Lumen.

2- You can't use any database (ex: MySQL, SQLite, ...). You should store and update data in the .txt files as a database.

3- You can use any package in the project.

4- You should use the Laravel blade for the front-end side.

5- Front-End design is not important for this task. This is a back-end task but if you have appropriate skills in the front-end stuff, you can use them and we'll happy :)

6- You should use Git in this project

7- Finally, You can compress the project and send it to us.

## .ENV Configuration

```php
DB_PATH="text_db_files"
USER_FILE="user.txt"
PASSWORD_FILE="password.txt"
PASSWORD_TYPE_FILE="password_type.txt"
DEFAULT_USER_ID="lDN00nMXN"
DEFAULT_USERNAME="root"
DEFAULT_USER_PASSWORD="25d55ad283aa400af464c76d713c07ad"
```