# About OpenTexonBlogger

OpenTexonBlogger is a free blog platform for Linux/Mac. Wich has everything you'll need for a simple blog, accounts, easy to use article posting, reading articles and comment on them and much more. OpenTexonBlogger is also highly customizable.

### Prerequisites

To Install the OpenTexonBlogger you'll need these things:

* PHP5
* Apache2
* Mod_rewrite
* PEAR
* The following pear modules: mail, Net_SMTP, Auth_SASL, mail_meme

To install these do the following commands

```sh
$ sudo apt-get update
$ sudo apt-get install apache2
$ sudo apt-get install php5
$ sudo a2enmod rewrite
$ sudo apt-get install php-pear
$ sudo pear install mail
$ sudo pear install Net_SMTP
$ sudo pear install Auth_SASL
$ sudo pear install mail_mime
$ sudo service apache2 restart
$ sudo chown -R www-data /var/www
```

Also you must make sure that .htaccess is enabled on your server configuration and that apache2 has read access to the web directory.

This software is NOT compatible with Windows, only Linux or Mac. Also this software uses CloudFlare to get ip information such as country and therefore some features will not work unless you use CloudFlare.

### Installing OpenTexonBlogger

Download the source and put it in your web server then open the file php/config.php and edit to your liking making sure to set a web server address and where the website location is. After that navigate to http://yoursite.com/install and follow the onscreen instructions.

### Configuring the config.php file

Before you install OpenTexonBlogger you must configure the php/config.php file.

Heres what all the options do:

```php
// General settings
 
// The domain of your website
define("Website_Url","http://example.com");

// The name of your website
define("Website_Name","Example");

// Website copyright to display at the bottom of the page
define("Website_Copyright","Copyright &copy; ".constant("Website_Name")." 2014-".date("Y")." All Rights Reserved<br>Powered by the <a href='https://opentexon.com/blog'>OpenTexon Blog Platform</a> | <a href='terms'>Terms & Conditions</a>");

// If the site is on maintenance and should not allow any traffic to the website
define("Website_Lockdown","false");

// IP Addresses that are allowed to visit the site on maintenance mode
define("Excpetions_IP_Addresses","");

// IP Addresses that are blocked from visiting the website
define("Blocker_Blocked_IPS","");

// Country CODES that are blocked from visitng the website
define("Blocker_Blocked_Countries","");

// IP Addresses that should be ignored by the logger
define("Excpetions_IP_Ignore_Log","");

// The email address of the site owner
define("Website_Server_Admin","example@gmail.com");

// When the site should be online when it's on maintenance
define("Website_Maintaince","22:00 CET 15 feb 2016");

// If normal users can post articles
define("Website_Article_CanPost","true");

// The website language
define("Website_Language","EN");

// If it should set the language based on the visitor location
define("Language_Auto","false");

// If users can register an account
define("Website_Allow_Register","true");

// If users must login to view the website
define("Website_Require_Login","false");

// If two step authentication is enabled when logging in
define("Security_EmailLoginVerification","false");

// If it should block users with AdBlock enabled
define("Block_AdBlock","false");

// Email server settings

// Your email server username
define("Email_Username","");

// Your email server password
define("Email_Password","");

// Your email server host
define("Email_Host","");

// Your email server port
define("Email_Port","");

// Location settings

// The location of the logs
define("Logger_Dir","/var/wwwlogs/");

// The location of stored data for accounts etc (Please do NOT store in your web directory)
define("Website_Data_dir","/var/opentexon/");

// The location of the website
define("Website_Location","/var/www/opentexon.com/");

// Website backend information (Do NOT change)
define("Website_Version","0.0.3");

// Update settigns
// If the website should look for updates (Recommended to have set to true)
define("Update_LookForUpdates","true");

// Social media Links
// Just put your web addresses for your social accounts for the webiste
define("Social_Facebook","");
define("Social_Twitter","");
define("Social_GPlus","");
define("Social_YouTube","");
define("Social_LinkedIn","");
define("Social_Dribbble","");
```

### Translations

Feel free to translate this software into your language, head into lang/EN/language.php and create a request and translate to your language.

Current supported languages are:
* Swedish
* English

There is also an option to auto detect what language the user is on depending on their ip address.

### Todos

 - Add more info to account.php
 - Automatic updater
 - Translate more

License
----

This software is licensed under the MIT license.

If you wish to modify this software please give credit and link to this git.

