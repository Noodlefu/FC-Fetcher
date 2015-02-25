<?php
include('lib/api.php');
include('config.php');
include('functions.php');

startTime();
$mysqli = startDBConnection( $db_server, $db_user, $db_pass, $db_database, $db_port );

// Initialize a LodestoneAPI Object
$API = new LodestoneAPI();

$FreeCompany = $API->getFC(
[
	"id" => "$fc_id"
],
[
    "members"   => true,
]);


if ( $FreeCompany != NULL )
{
	LOG_STATUS( "DEBUG", "Free Company found..." );
	// Empty table as we're going to populate it - having separate statements to check if it exists beforehand is just wasting time
	$query = "TRUNCATE TABLE classinfo";
	$mysqli->query( $query ) or die( $mysqli->error );

	
	LOG_STATUS( "DEBUG", "Fetching members..." );
	// Members List
	$Members = $FreeCompany->getMembers();
	
	foreach( $Members as $Member )
	{
		$id = $Member["id"];
		$API->parseProfile( $id );
		$Character = $API->getCharacterByID( $id );
		$name = $Character->getName();
		LOG_STATUS( "DEBUG", "Processing $name..." );
		$rank = "<img src='".$Member["rank"]["image"]."' title='".$Member["rank"]["title"]."'/>";
		$ClassJobs = $Character->getClassJobsOrdered("numbered");
	
		$avatar = $Character->getAvatar( 50 );
		
		$sql_columns = "id,name,rank";
		$sql_values = "$id,\"$name\",\"$rank\"";
		
		for ( $i = 0; $i <= 18; $i++ )
		{
			$sql_columns .= ",".$ClassJobs[$i]["class"];
			if ( $ClassJobs[$i]["level"] != "-" )
				$sql_values .=  ",".$ClassJobs[$i]["level"];
			else
				$sql_values .=  ",0";
		}
		
		$sql_columns .= ",avatar_url";
		$sql_values .= ",'$avatar'";
		
		$query = "INSERT INTO classinfo ( $sql_columns ) VALUES ( $sql_values )";

		LOG_STATUS( "DEBUG", "Query: ".$query );
		$mysqli->query( $query ) or die ( $mysqli->error );	

		LOG_STATUS( "DEBUG", "Current memory usage: ".formatBytes( memory_get_usage( false ) ) );
	}
}			

closeDBConnection( $mysqli );
LOG_STATUS( "DEBUG", "Peak memory usage: ".formatBytes( memory_get_peak_usage( false ) ) );
endTime();
?>