<!-- Check if jQuery has been loaded... -->
<script>
	window.jQuery || document.write('<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"><\/script>')
</script>
<?php
include('config.php');
include('functions.php');
startTime();
$mysqli = startDBConnection( $db_server, $db_user, $db_pass, $db_database, $db_port );

// Fetch how many rows we have so we can fill the select box
$query = "SELECT COUNT(*) AS n FROM classinfo";
$res = $mysqli->query( $query );
if( !$res )
	die( $mysqli->error );
$obj = $res->fetch_object();
$rows = intval( $obj->n );
unset( $obj );
unset( $res );
print "<link rel='stylesheet' type='text/css' href='".curPageURL()."style/style.css'>
		<script type='text/javascript' src='".curPageURL()."lib/jquery.tablesorter.min.js'></script>
		<script type='text/javascript' src='".curPageURL()."lib/jquery.tablesorter.widgets.min.js'></script>
		<script type='text/javascript' src='".curPageURL()."lib/jquery.tablesorter.pager.min.js'></script>";
pager( $rows );
echo "<table class='tablesorter'><thead><tr><th>Name</th><th>Rank</th>";

// Generate table headers (this is also a decent place to fill our max values, there's no point doing a for loop twice)
for ( $i=0; $i<sizeof( $classes ); $i++ )
{
	echo "<th title='".ucwords( $classes[$i] )."'><img src=".curPageURL().$classimg[$i]."></th>";
	
	// Max query and array storage
	$query = "SELECT MAX( `".$classes[$i]."` ) AS n FROM classinfo";
	$res = $mysqli->query( $query );
	if( !$res )
		die( $mysqli->error );
	$obj = $res->fetch_object();
	$values[$i] = intval( $obj->n );
	unset( $obj );
	unset( $res );
}
echo "</tr></thead><tbody>";

// Generate our query
$query = "SELECT * FROM classinfo";
if ( $result = $mysqli->query( $query ) )
{
	// We have our result, generate our table data
	while ( $row = $result->fetch_row() )
	{
		echo "<tr>";
		echo "<td width='20%' title='".$row[1]."' style='text-align: left;'><img class='members' src='".$row[2]."'/> <a href=http://eu.finalfantasyxiv.com/lodestone/character/".$row[0]."/ target=_blank>".$row[1]."</a></td>";
		echo "<td>".$row[3]."</td>";
		for ( $i=0; $i<sizeof( $row )-4; $i++ )
		{
			$row[$i+4] == $values[$i] ?	$num = "<b>".$row[$i+4]."</b>" : $num = $row[$i+4];
			echo "<td class=".$classes[$i]." style='text-align: center;'>$num</td>";
		}
		echo "</tr>";
	}

	unset( $result );
}
else
	die( $mysqli->error );

echo "</tbody></table>";

pager( $rows );
closeDBConnection( $mysqli );
endTime();
?>
<script type='text/javascript'>
	jQuery('table').tablesorter({
		widgets: ['zebra', 'columns'],
		sortInitialOrder: "desc"
	}).tablesorterPager({
		container: jQuery(".pager"),
		output: '{startRow} to {endRow} ({totalRows})',
		size: <?php echo $perPage; ?>,
		removeRows: true
	});
</script>