<?php
include('config.php');

function curPageURL()
{
	$pageURL = 'http';
	if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" )
		$pageURL .= "s";
	$pageURL .= "://";
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	 
	$pos = strrpos( $pageURL, basename( $pageURL ) );

	if( $pos !== false )
		$pageURL = substr_replace( $pageURL, "", $pos, strlen( $pageURL ) );
		
	return $pageURL;
}

function LOG_STATUS( $type, $message )
{
	if ( $GLOBALS['debug'] )
	{
		$string = "| ".$type." | ".$message."<br>\n";
		// Uncomment one of the ones below depending on if you want written debug logs or other
		echo $string;
		//error_log( $string , 3, "debug.log" );
	}
}

function startDBConnection( $db_server, $db_user, $db_pass, $db_database, $db_port = NULL )
{
	if ( empty( $db_port ) )
		$db_port = ini_get("mysqli.default_port");
	$mysqli = new mysqli( $db_server,$db_user,$db_pass,$db_database, $db_port );

	// Check connection
	if( $mysqli->connect_error ) 
		 die( "Connect Error (" . mysqli_connect_errno() . ") ". mysqli_connect_error() );
		
	return $mysqli;
}

function closeDBConnection( $mysqli )
{
	$mysqli->close();
}

function startTime()
{
	if ( $GLOBALS['debug'] )
	{
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		global $start;
		$start = $time;
		LOG_STATUS( "DEBUG", "Started script." );
	}
}

function endTime()
{
	if ( $GLOBALS['debug'] )
	{
		$time = microtime();
		$time = explode(' ', $time);
		$time = $time[1] + $time[0];
		$finish = $time;
		$total_time = round(($finish - $GLOBALS['start']), 4);
		LOG_STATUS( "DEBUG", "Page generated in $total_time seconds." );
	}
}

function formatBytes( $bytes, $precision = 2 )
{ 
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB' ); 

    $bytes = max( $bytes, 0 ); 
    $pow = floor( ( $bytes ? log( $bytes ) : 0 ) / log( 1024 ) ); 
    $pow = min( $pow, count( $units ) - 1 ); 

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    $bytes /= ( 1 << ( 10 * $pow ) ); 

    return round( $bytes, $precision ) . ' ' . $units[$pow]; 
} 

?>