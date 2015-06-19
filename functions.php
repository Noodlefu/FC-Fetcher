<?php
include('config.php');

function pager( $rows )
{
print "<div class='pager'> 
        <img src='".curPageURL()."style/first.png' class='first'/> 
        <img src='".curPageURL()."style/prev.png' class='prev'/> 
        <span class='pagedisplay'></span>
        <img src='".curPageURL()."style/next.png' class='next'/> 
        <img src='".curPageURL()."style/last.png' class='last'/> 
        <select class='pagesize' title='Select page size'>";
        for ( $i=10; $i<=ceil($rows / 10) * 10; $i=$i+10 )
			echo "<option value='$i'>$i</option>";
			
        print "</select>
        <select class='gotoPage' title='Select page number'></select>
</div>";
}

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
		show( "Script started." );
		global $start;
		$start = microtime(true);
	}
}

function endTime()
{
	if ( $GLOBALS['debug'] )
	{
		$finish = microtime(true);
		show( "Memory Peak: ". cMem(memory_get_peak_usage() ) );
		show( "Script ended." );
	}
}

function show( $data )
{
	if ( $GLOBALS['debug'] )
		echo '<pre>'. print_r($data, true) .'</pre>';
}

function cMem( $size )
{
	$tmp = array( 'b','kb','mb','gb','tb','pb' );
	if ( $GLOBALS['debug'] )
		return @round( $size/pow( 1024, ( $i=floor( log( $size,1024 ) ) ) ),2 ).' '.$tmp[$i];
}

?>