Free Company Lodestone Fetcher by Jack Wallace (Malrik Rohan @ Leviathan)
Feel free to email me with troubleshooting issues at jack@astutepixel.com
Live demo @ www.legionofhalone.com/roster

License: MIT for works of my own, but not that of the XIVPADS API which falls under GitHub Terms of Service (https://github.com/viion/XIVPads-LodestoneAPI).

1. Requirements
2. Install
3. Notes
4. Changes

1. Requirements:

PHP 5.4+
MySQL 5 with MySQLi support
Web server/provider with support for 20~30+ Mb of script memory usage (depending on FC size)
CURL enabled on your server

2. Install

#1 : Install the database schema using the provided schema.sql file.
#2 : Add database information to config.php file along with Free Company information (see comments in config.php).
#3 : Upload files to web server.
#4 : Setup a cron job for cron.php. I'd suggest renaming this so people can't go to your site and simply look for cron.php and execute it over and over. More in notes below.
#5 : Include roster.php into whatever page you require!

3. Notes

If you're using this for Wordpress, the files should be setup fine from the get-go. I use the Wordpress plugin "Allow PHP in Posts and Pages",
with this you can simply write [php]include 'roster.php';[/php] into a page or post. If you upload the files into the root of your Wordpress install, the roster will appear.

If you're not using Wordpress, a few files will need to be changed, every line that has a "../" in it. Simply delete the two full stops and all should work fine.
This is due to the fact that Wordpress pages act as a folder (so 'roster' page will be /roster/), PHP will run the script thinking all the style, images, and libs are in this 'roster' folder that doesn't exist.
The ../ tells PHP to look in the folder above working around the problem, so removing the two full stops will stop this from happening and return functionality.

It's worth noting that if you want to move the cron file outside of an accessible area,
you'll want to change the line "$destination = dirname(__FILE__)."/images/members/$id.png";" and point it to the images/members/ folder where the roster file resides.

The appearance of the table is controlled entirely by style.css. All changes to the table in regards to image size, etc, are done through this.

If you want to enable debug messages, change the "$debug = false;" line in config.php to true. This will output information that is useful to troubleshoot what's going on/wrong.
If you want to output to a log instead, view the top function in functions.php. The default simply prints debug messages on runtime, whereas log will do it whenever anyone views it.
WARNING : log sizes can become large very quickly if you enable the option to output to file and forget about it!

4. Changes
## 1.7 ##
- Updated api to support lodestone changes.
- Implimented Rogue class addition.
- Database changes require dump and re-creation of database.

## 1.6.1 ##
- Updated api to support lodestone changes.

## 1.6 ##
- Updated api to support lodestone changes.

## 1.5 ##
- Added dynamic pagination.

## 1.4 ##
- Now using www.xivpads.com's API.
- Added rank images (mouseover for rank)
- Truncates names that are very long so as not to deform the table (mouseoever for full name).
- Updated tablesorter javascript library, now much faster.
- Cron job optimised even more.

## 1.3 ##
- Major optimisations to runtime memory usage (uses on average around 20Mb tops).
- Added functions file so I don't need to copy & paste so much code.
- footer.php and database.php files now defunct.