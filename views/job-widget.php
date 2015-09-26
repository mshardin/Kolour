<?php 
$c = $db->jobs;
$cursor = $c->find()->limit(5)->batchSize(-5);
?>
<div id="job-container">
	<span></span><section><div id="job-banner">
        <?php
        while ($cursor->hasNext()) {
            $job = $cursor->getNext();
        ?>
		<div class="job-block">
			<h1 class="job-title larger-text"><?php echo $job['title']; ?> @<br><span style="font-family: 'nexa_boldregular'"><?php echo $job['company']; ?></span></h1>
			<span class="salary-mask" style="width:calc(4vw * <?php echo intval($job['salary']) / 160000 ; ?>)">
				<span class="salary-icon"></span>
			</span>
		</div>
        <?php } ?>
	</div>
	</section>
</div>

