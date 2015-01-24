<?
include('db.php');
$db = db_connect("kolour");

include_once('views/_header.php');
include_once('classes/Newsreader.php');
$frag = $_GET['cat'];
include_once('news.php');

foreach ( $feed['items'] as $key => $value ) {
	$feedContent = purge($feedContent = $value['summary']['content']);

	$feed_array[$key]['title'] 	 = htmlentities($value['title']);
	$feed_array[$key]['href'] 	 = $value['canonical'][0]['href'];
	$feed_array[$key]['href2'] 	 = $value['alternate'][0]['href'];
	$feed_array[$key]['image']   = getBackgroundImage($feedContent);
	$feed_array[$key]['summary'] = $value['summary']['content'];
	$feed_array[$key]['author']  = $value['author'];
}

include('views/menu_bar.php');
?>

<div id="left-menu">
    <img id="logo-icon" src="../views/Images/kolour-icon.svg">
    <img id="logo-head" src="../views/Images/kolour-logo-white.svg">
    <nav id="main-navigation">
        <ul>
            <li><a href="">home</a><img class="nav-icon" src="../views/Images/home-icon.svg"></li>
            <li><a href="">profile</a><img class="nav-icon" src="../views/Images/profile-icon.svg"></li>
            <li><a href="">tour</a><img class="nav-icon" src="../views/Images/tour-icon.svg"></li>
            <li><a href="">pricing</a><img class="nav-icon" src="../views/Images/pricing-icon.svg"></li>
            <li><a href="">jobs</a><img class="nav-icon" src="../views/Images/jobs-icon.svg"></li>
        </ul>
    </nav>
</div>
<div id="container">
    <div id="top-menu">
        <img id="search-icon" src="../views/Images/search-icon.svg"><span class="spacer-cont"><span class="spacer"></span></span>
        <ul id="news-sort">
            <li><a href="#Features" onclick="changeFrag(this);" class="<? echo $frag == 'Features'?'active':''; ?>">Features</a></li>
            <li><a href="#News" onclick="changeFrag(this);" class="<? echo $frag == 'News'?'active':''; ?>">News</a></li>
            <li><a href="#Tips" onclick="changeFrag(this);" class="<? echo $frag == 'Tips'?'active':''; ?>">Tips</a></li>
            <li><a href="#Science" onclick="changeFrag(this);" class="<? echo $frag == 'Science'?'active':''; ?>">Science</a></li>
            <li><a href="#Technology" onclick="changeFrag(this);" class="<? echo $frag == 'Technology'?'active':''; ?>">Tech</a></li>
            <li><a href="#Design" onclick="changeFrag(this);" class="<? echo $frag == 'Design'?'active':''; ?>">Design</a></li>
            <li><a href="#WasteTime" onclick="changeFrag(this);" class="<? echo $frag == 'WasteTime'?'active':''; ?>">Waste Time</a></li>
        </ul>
        <img id="menu-icon" style="float:right !important" src="../views/Images/menu-icon.svg">
        <span class="spacer-cont" style="float:right !important"><span class="spacer"></span></span>

       <!--  ------------PROFILE THUMNAIL GOES HERE------------- -->
        <div id="profile-thumnail">
            <ul id="profile-menu">
                <div class="hover-buffer"></div>
                <li><a href="#">Preview</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="index.php?logout">Sign Out</a></li>
            </ul>
        </div>
    </div>
	<!-- JOBS CONTAINER -->
	<?php include('job-widget.php'); ?>

	<div id="news-cont">
		<div id="news-header">
            <span></span><section>
			<h2 class="medium-text" style="opacity:0.6; color:white !important; text-transform: capitalize;">Hello, <?php echo $_SESSION['user_name'] ?></h2>
			<h2 class="smaller-text" style="color:white !important;">Stay updated with latest news, tips, and opportunities.</h2>
            </section>
		</div>

        <div id="newsfeed" class="mousescroll">
            <? for ($i = 0; $i < count($feed_array); $i++) { 
                if (strstr($feed_array[$i]['image'][0], '.gif') != FALSE || $feed_array[$i]['image'][0] == '' || strstr($feed_array[$i]['image'][0], 'http://feeds.feedburner.com') != FALSE ) 
                    continue
            ?>
    		<div class="block">
    	        <div class="cell" style="background-image: url(<? echo checkForGif($feed_array[$i]['image'][0]); ?>); background-position:center; background-size: cover;">
    	        </div>
    	        <? if (isset($feed_array[$i]['image'][1])) { ?>
    		        <div class="cell">
    		        	<iframe src="<? echo $feed_array[$i]['image'][1] ?>" width="<? echo $width = empty($feed_array[$i]['image'][0])?'100%':''; ?>">
    		        		Sorry, your browser does not support youtube.
    		        	</iframe>
    		        </div>
    		    <? } ?>
                <div class="title-cont">
                	<span></span><a href="<? echo $feed_array[$i]['href'] ? $feed_array[$i]['href2'] : '';?>" target="_blank"><h1 class="title medium-text"><? echo $feed_array[$i]['title']; ?></h1></a>
                    <div class="social-container">
                        <img class="share-icon" src="../views/Images/share-icon.svg">
                        <div class="social-footer"> 
                            <span class='st_facebook_custom social-btn' displayText='Facebook' st_title='<? echo $feed_array[$i]['title']; ?>' st_url='<? echo $feed_array[$i]['href']; ?>'></span>
                            <span class='st_twitter_custom social-btn' displayText='Tweet' st_title='<? echo $feed_array[$i]['title']; ?>' st_url='<? echo $feed_array[$i]['href']; ?>'></span>
                            <span class='st_googleplus_custom social-btn' displayText='Google +' st_title='<? echo $feed_array[$i]['title']; ?>' st_url='<? echo $feed_array[$i]['href']; ?>'></span>
                            <span class='st_linkedin_custom social-btn' displayText='LinkedIn' st_title='<? echo $feed_array[$i]['title']; ?>' st_url='<? echo $feed_array[$i]['href']; ?>'></span>
                        </div>
                    </div>
                </div>
            </div>
            <? } ?>
        </div>		       
    </div>	
    <div id="promotions">
        <span></span><section><h2 id="promo-title">Have your profile automatically sent to qualified job listings.</h2><br><span id="upgrade-btn">Upgrade</span></section>
    </div>	
</div>
<script src="js/jquery.fittext.js"></script>
<script type="text/javascript">
    $(".small-text").fitText(2.5,{minFontSize:"12px",maxFontSize:"48px"});$(".medium-text").fitText(2,{minFontSize:"12px",maxFontSize:"48px"});$(".large-text").fitText(1.5,{minFontSize:"16px",maxFontSize:"48px"});$(".small-text").fitText(2.5,{minFontSize:"12px",maxFontSize:"36px"});

    function changeFrag(frag) {
      var frag = frag.toString();
      var finalFrag = frag.slice(frag.indexOf("#")+1, frag.length);
      //alert(finalFrag);
      window.location.href = "?cat=" + finalFrag; 
    };

    $(window).on('resize',function() {
        var h = $(window).height();
        var p = $(window).height()/100;
        var dif = $('#job-container').height() + $('#top-menu').height() + p*2;
        var pro_h = h - dif;

       $('#promotions').css({
            'height': ''+pro_h+'px',
        });
    }).trigger('resize');
</script>
<script src="js/scroll-fade.js"></script>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "4c119437-bdab-4440-bdca-1fdf5b7a2613", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
<? include_once('views/_footer.php'); ?>