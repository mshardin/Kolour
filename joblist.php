<?php
include_once('db.php'); 

$db = db_connect("kolour");
$c = $db->jobs;
$cursor = $c->find();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>lulz</title>

        <style type="text/css">
        table {
            border-collapse: collapse;
        }

        table thead th {
        	border: 1px solid black;
        }

        table tbody td {
        	border: 1px solid black;
        }
        </style>
    </head>

    <body>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Company</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Salary</th>
                    <th>Type</th>
                    <th>Kolour Score Limit</th>
                    <th colspan="2">Location</th>
                </tr>
            </thead>

            <tbody>
            <?
        		while ($cursor->hasNext()) {
					$job = $cursor->getNext();
			?>
				<tr>			
					<td><? echo $date          = $job['date'][0] . "\n" . $date += $job['date'][1]; ?></td>
                    <td><? echo $company       = $job['company']; ?></td>
					<td><? echo $title         = $job['title']; ?></td>
					<td><? echo $description   = $job['description']; ?></td>
                    <td><? echo $salary        = $job['salary']; ?></td>
					<td><? echo $type          = $job['type']; ?></td>
					<td><? echo $k_score_limt  = $job['k-score-limit']; ?></td>
					<td><? echo $lat           = $job['location'][0]; ?></td>
					<td><? echo $long          = $job['location'][1]; ?></td>
				</tr>
			<? } ?>
            </tbody>
        </table>
    </body>
</html>