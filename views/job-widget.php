<? 
$c = $db->jobs;
$cursor = $c->find()->limit(5)->batchSize(-5);
?>
<div id="job-container">
	<div id="job-banner">
        <?
        while ($cursor->hasNext()) {
            $job = $cursor->getNext();
        ?>
		<div class="job-block">
			<h1 class="job-title medium-text"><? echo $job['title']; ?>&nbsp;<span style="font-weight:normal; margin:0% 1%; color: #9b9899; ">needed at</span>&nbsp;<? echo $job['company']; ?></h1>
			<h2 class="job-pay small-text">Pay:<? echo " $" . $job['salary']; ?></h2>
		</div>
        <? } ?>
	</div>
</div>