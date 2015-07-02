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
echo "<table class='tablesorter'><thead><tr><th width='20%'>Name</th><th width='5%'>Rank</th>";

// Generate table headers (this is also a decent place to fill our max values, there's no point doing a for loop twice)
foreach( $classes as $data )
{
		echo "<th class='".$data['type']."' title='".ucwords( $data['name'] )."'><img src=".curPageURL().$data['image']."></th>";
		
		//Max query and array storage
		$query = "SELECT MAX( `".$data['name']."` ) AS n FROM classinfo";
		$res = $mysqli->query( $query );
		if( !$res )
			die( $mysqli->error );
		$obj = $res->fetch_object();
		$values[$data['name']] = intval( $obj->n );
		unset( $obj );
		unset( $res );
}
echo "</tr></thead><tbody>";

// Generate our query
$query = "SELECT * FROM classinfo";
if ( $result = $mysqli->query( $query ) )
{
	// We have our result, generate our table data
	foreach( $result as $row )
	{
		print "<tr>
		<td width='20%' title='".$row['name']."' style='text-align: left;'><img class='members' src='".$row['avatar_url']."'/> <a href=http://eu.finalfantasyxiv.com/lodestone/character/".$row['id']."/ target=_blank>".$row['name']."</a></td>
		<td>".$row['rank']."</td>";
		foreach( $classes as $data )
		{
			$row[$data['name']] == $values[$data['name']] ?	$num = "<b>".$row[$data['name']]."</b>" : $num = $row[$data['name']];
			echo "<td class=".$data['name']." style='text-align: center;'>$num</td>";
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