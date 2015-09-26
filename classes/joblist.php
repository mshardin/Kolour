<?php
include_once('db.php'); 

// Connect to mongodb kolour database
$db = db_connect("kolour");

// get jobs collection
$c = $db->jobs;

// find each job document
$cursor = $c->find();

function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}

include_once('views/_header.php');
include_once('views/menu_bar.php');
?>

<div id="left-menu">
    <nav id="main-navigation" class="center">
        <ul>
            <!-- -------------BUTTON #1-------------- -->
            <li><a href="#">
                <span class="icon-block"><img class="nav-icon" src="http://kolour.me/views/Images/jobs-icon-thin.svg"></span>
                <span class="text-block">My Account</span>
            </a></li>

            <!-- -------------BUTTON #2-------------- -->
            <li><a href="#">
                <span class="icon-block"><img class="nav-icon" src="http://kolour.me/views/Images/profile-icon-thin.svg"></span>
                <span class="text-block">Profile</span>
            </a></li>
            <!-- -------------BUTTON #3-------------- -->
            <li><a href="#">
                <span class="icon-block"><img class="nav-icon" src="http://kolour.me/views/Images/pricing-icon-thin.svg"></span>
                <span class="text-block">Upgrades</span>
            </a></li>
            <!-- -------------BUTTON #4-------------- -->
            <li><a href="#">
                <span class="icon-block"><img class="nav-icon" src="http://kolour.me/views/Images/tour-icon-thin.svg"></span>
                <span class="text-block">Tour</span>
            </a></li>
        </ul>
    </nav>    
</div>
<div id="container">
    <div id="jobs-cont">
    	<div id="job-list-banner">
	    	<span></span><section>
	    		<h1>Main title</h1>
	    		<h2>Sub title</h2>
	    	</section>    		
    	</div>
        <table>
            <tbody>
            <?php
        		while ($cursor->hasNext()) {
    				$job = $cursor->getNext();
    		?>
    			<tr>
    				<td><span class="jobs-cont-title"><?php echo $job['title']; ?> @<br><?php echo $job['date'][0] . "\n" . $date += $job['date'][1]; ?></span></td>			
    				
                    <td class="company-name"><b><?php echo $company = $job['company']; ?></b></td>
    				   				
                    <td><span class="salary-mask" style="width:calc(4vw * <?php echo intval($job['salary']) / 160000 ; ?>)">
				<span class="salary-icon-green"></span>
			</span></td>    				
    			</tr>
    		<?php } ?>
            </tbody>
        </table>
    </div>
    <div id="filter-jobs"></div>
</div>
<?php include_once('views/_footer.php'); ?>