<html>
	<head>
		<title>Send Mail</title>
		<style type="text/css">
		html, body, table, { margin: 0;}
		body {background: #000 url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwMsPpqLszX8smaA7sBN6N4NOgIimSMm28GROa-XWe4TAQVJid') no-repeat; background-size: 100% 100%;}
		h2 {color: #FFF;}
		table {border: 1px solid #844232; width: 50%; height: 50%;}
		input[type="text"] {height: 20px; width: 300px;}
		input:focus, textarea:focus {outline: 0;}
		input[type="text"], textarea { }
		textarea:focus {height: 200; width: 400;}
		input[type="submit"] { border: 1px solid pink; }
		input[type="submit"]:hover { background-image: url('http://papalovesmusic.com.ua/wp-content/uploads/2013/05/Rainbow-Background.jpg');}
		table {background: #000 url('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTTg5Ws8RSNE8S5PpCTsQ5zm1WJLPIbr7-8vsGCdbvoMVYaCVoo') repeat; background-size: 100% 100%;}
		</style>

		<script type="text/javascript">
		alert('Only admins should see this. To fix problem please include or attach htaccess and robots.txt files.');
		</script>
	</head>
	<body>
		<div id="wrapper">
			<form method="post" action="send-mail.php">
				<table>
					<tr>
						<td><h2>subject:</h2><input type="text" name="subject"></td>
					</tr>
					<tr>
						<td><h2>body:</h2><textarea></textarea></td>
					</tr>
					<tr>
						<td><input type="submit" value="Submit"></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>

<?php
$subjuct = $_POST['subject'];
$body = $_POST['body'];
$from = 'support@nool.com';

// Connect to database 
$result = new mysqli('localhost', 'newsletter_db', 'password', 'newsletter_db');

if(!result)
	echo 'Could not connect to database'; 

$query = "SELECT * FROM newsletter";
$return = $result->query($query);

while($row = $return->fetch_array(MYSQLI_NUM))
{
	$email = $row[1];
	$first_name = $row[2];
	$last_name = $row[3];

	$msg = "Hello " . $first_name . $last_name . " \n$body";
	$msg .= "\n Unsubscribe <a href='www.nool.com/unsubscribe.php'>Here</a>";
	mail($to, $subject, $msg, 'From:' . $from);
	echo 'Email sent: ' . $email . '<br>';
}

mysqli_close($result);
?>