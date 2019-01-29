## Exercises PDF finder and send via email


## Installation

Clone this repository and do this ff config to run.


## Setup Sample DB

In you `phpmyadmin` make new database name 'activity_files' then import sql file under SqlFile/activity_files.sql.


## Setup Email Config if you want to test send searched/selected filed to your email.

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=    //your email address (it needed for the email comes from when you trigger send mail button)
MAIL_PASSWORD=	   //email password
MAIL_ENCRYPTION=tls
```

## Usage 

 You may run `php artisan serve` in your terminal in project root.

## Preview 

