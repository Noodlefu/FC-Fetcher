<?php
require 'lib/api-autoloader.php';
$api = new Viion\Lodestone\LodestoneAPI();
include('config.php');
include('functions.php');
startTime();

$mysqli = startDBConnection( $db_server, $db_user, $db_pass, $db_database, $db_port );

if ( $api->Search->isMaintenance() )
{
	show("Lodestone under maintenance...");
} else {
	$FreeCompany = $api->Search->FreeCompany($fc_id, true);
	show("Free Company found...");
	// Empty table as we're going to populate it - having separate statements to check if it exists beforehand is just wasting time
	$query = "TRUNCATE TABLE classinfo";
	$mysqli->query( $query ) or die( $mysqli->error );

	show("Fetching members...");
	// Members List	
	foreach( $FreeCompany->members as $Member )
	{
		$id = $Member["id"];
		$Character = $api->Search->Character($id);
		//show($Character);
		show("Processing: ".$Character->name."..");
		$rank = "<img src='".$Member["rank"]["icon"]."' title='".$Member["rank"]["title"]."'/>";
		$ClassJobs = $Character->classjobs;
		$avatar = $Character->avatar;
		$sql_columns = "id,name,rank";
		$name = $Character->name;
		$sql_values = "$id,\"$name\",\"$rank\"";
		
		for ( $i = 0; $i < count( $ClassJobs ); $i++ )
		{
			$sql_columns .= ",`".$ClassJobs[$i]["name"]."`";
			if ( $ClassJobs[$i]["level"] != "-" )
				$sql_values .=  ",".$ClassJobs[$i]["level"];
			else
				$sql_values .=  ",0";
		}
		
		$sql_columns .= ",avatar_url";
		$sql_values .= ",'$avatar'";
		
		$query = "INSERT INTO classinfo ( $sql_columns ) VALUES ( $sql_values )";

		show( "Query: ".$query );
		$mysqli->query( $query ) or die ( $mysqli->error );
	}
}


closeDBConnection( $mysqli );
endTime();
?>