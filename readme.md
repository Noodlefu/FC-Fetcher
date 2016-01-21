# Free Company Lodestone Fetcher by Jack Wallace (Malrik Rohan @ Leviathan)
Live demo @ www.legionofhalone.com/roster

**viion's XIVPads-LodestoneAPI used for parsing Lodestone (for license info and more see https://github.com/viion/XIVPads-LodestoneAPI).**
**Many personal thanks to viion and the contributors for making things like this possible.**


## Requirements

- PHP 5.4+
- MySQL 5 with MySQLi support
- Web server/provider with support for 20~30+ Mb of script memory usage (depending on FC size)
- CURL enabled on your server

## Install

- Install the database schema using the provided schema.sql file.
- Add database information to config.php file along with Free Company information (see comments in config.php).
- Upload files to web server.
- Setup a cron job for cron.php. I'd suggest renaming this so people can't go to your site and simply look for cron.php and execute it over and over.
- Include roster.php into whatever page you require!

## Updating from previous installation

- Replace database schema.
- Replace all files (make a note to backup your previous installation).
- Re-enter config.php information.

## Notes

- The appearance of the table is controlled entirely by style.css. All changes to the table in regards to image size, etc, are done through this.
- If you want to enable debug messages, change the "$debug = false;" line in config.php to true. This will output information that is useful to troubleshoot what's going on/wrong.
- To get this to appear in Wordpress, I edit my own theme's functions.php (found in content/themes/xxx/functions.php - add one if it's not there if you like), and add the following code and then use [phpinclude]roster.php[/phpinclude]:

```php
function phpinclude_func( $atts , $content = null ) {
	if ( !is_null( $content ) && file_exists( ABSPATH . '../' . $content ) )
		include( ABSPATH . '../' . $content );
	else
		echo "File not found.";
}
add_shortcode( 'phpinclude', 'phpinclude_func' );
```

**License**
- MIT License : Copyright (c) 2015 Jack Wallace
- You may: use, redistribute, modify, share, collaborate, change spaces to tabs, so long as the comment license stays intack at the top. IF YOU MAKE MODIFICATIONS please add your contribution details (name/git handle) in the readme.
