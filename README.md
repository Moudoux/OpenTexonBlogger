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

