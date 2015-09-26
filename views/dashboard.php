<?php
// include mongo db functions and instantiate it 
include('db.php');
$db = db_connect('kolour');

include_once('views/_header.php');
//include_once('classes/Newsreader.php');
//$frag = $_GET['cat']; // get the cat(category) variable to decide which category to view 
//include_once('news.php');
include('views/menu_bar.php'); // top navigation menu
?>

<div id="left-menu">
    <div id="left-menu-top">
        <div id="profile-thumbnail"></div>
        <h2 id="greeting" class="large-text" style="color:white !important; text-transform: capitalize;">Hello, <?php echo $_SESSION['user_name'] ?></h2>
    </div>
    <div id="left-menu-bottom">
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
</div>
<div id="container">
	<!-- JOBS CONTAINER -->
    <div id="dashboard-hero-image">
        <h1 id="promotional-header" class="larger-text"><b style="font-family: 'nexa_boldregular'">Your Resume lives here.</b> Help us <br> make it the industry standard.</h1>
        <a id="invite" class="larger-text" href="#">Invite >></a>
        <?php include('job-widget.php'); // job board widget ?>
    </div>
	
    <div id="sort-menu">
        <h4 id="sort-menu-title">Stay Updated</h4>
        <ul id="news-sort">
            <!-- News -->
            <li><a href="#News" onclick="changeFragAjax('News');" class="<?php echo $frag == 'News'?'active':''; ?>">
                <span style="border:4px solid #d5c8cd;" class="ring"></span>
            </a></li>

            <!-- Tips -->
            <li><a href="#Tips" onclick="changeFragAjax('Tips');" class="<?php echo $frag == 'Tips'?'active':''; ?>">
                <span style="border:4px solid #4bba7d;" class="ring"></span>
            </a></li>

            <!-- Science -->
            <li><a href="#Science" onclick="changeFragAjax('Science');" class="<?php echo $frag == 'Science'?'active':''; ?>">
                <span style="border:4px solid #e24673;" class="ring"></span>
            </a></li>

            <!-- Tech -->
            <li><a href="#Technology" onclick="changeFragAjax('Technology');" class="<?php echo $frag == 'Technology'?'active':''; ?>">
                <span style="border:4px solid #51a5db;" class="ring"></span>
            </a></li>

            <!-- Design -->
            <li><a href="#Design" onclick="changeFragAjax('Design');" class="<?php echo $frag == 'Design'?'active':''; ?>"><span style="border:4px solid #e9d963;" class="ring"></span>
            </a></li>

            <!-- Cool -->
            <li><a href="#WasteTime" onclick="changeFragAjax('WasteTime');" class="<?php echo $frag == 'WasteTime'?'active':''; ?>">
                <span style="border:4px solid #f89d41;" class="ring"></span>
            </a></li>
        </ul>
        <h5 id="sort-by">Sort By</h5>
    </div>
	<div id="news-cont">
        <div id="newsfeed" class="mousescroll">
            <div class="block" id="news-header">
                <span></span><section style="width:80%; margin:0% 10%;">
                    <h2  class="medium-text" style="font-family: 'nexa_boldregular'">Welcome! I'm your dashboard</h2>
                    <h2 class="medium-text" style="font-weight:normal">Stay updated with latest <br> industry news.</h2>
                    <img id="smile-face" src="http://kolour.me/views/Images/smile-face.png">
                </section>
            </div>
            <?php for ($i = 0; $i < count($feed_array); $i++) {  // Loop through the articles 
                // if article has blank image or gif skip it 
                if (strstr($feed_array[$i]['image'][0], '.gif') != FALSE || $feed_array[$i]['image'][0] == '' || strstr($feed_array[$i]['image'][0], 'http://feeds.feedburner.com') != FALSE ) 
                    continue
            ?>
    		<div class="block">
                <div class="overlay"></div>
    	        <div class="cell" style="background-image: url(<?php echo checkForGif($feed_array[$i]['image'][0]); ?>); background-position:center; background-size: cover;">
    	        </div>
    	        <?php if (isset($feed_array[$i]['image'][1])) { ?>
    		        <div class="cell">
    		        	<iframe src="<?php echo $feed_array[$i]['image'][1] ?>" width="<?php echo $width = empty($feed_array[$i]['image'][0])?'100%':''; ?>">
    		        		Sorry, your browser does not support youtube.
    		        	</iframe>
    		        </div>
    		    <?php } ?>
                <div class="title-cont">
                	<a href="<?php echo $feed_array[$i]['href'] ? $feed_array[$i]['href2'] : '';?>" target="_blank">
                        <h4 class="blog-name"><?php echo $feed_array[$i]['blog_name']; ?></h1>
                        <h1 class="title medium-text"><?php echo $feed_array[$i]['title']; ?></h3>
                        <h6 class="pub-date"><?php echo $feed_array[$i]['date_pub']; ?></h6>
                    </a>
                    <div class="social-container">
                        <!--<img class="share-icon" src="../views/Images/share-icon.svg">-->
                        <img class="share-icon" src="https://d20gj6m76a89ac.cloudfront.net/images/share-icon.svg">
                        <div class="social-footer"> 
                            <span class='st_facebook_custom social-btn' displayText='Facebook' st_title='<?php echo $feed_array[$i]['title']; ?>' st_url='<?php echo $feed_array[$i]['href']; ?>'></span>
                            <span class='st_twitter_custom social-btn' displayText='Tweet' st_title='<?php echo $feed_array[$i]['title']; ?>' st_url='<?php echo $feed_array[$i]['href']; ?>'></span>
                            <span class='st_googleplus_custom social-btn' displayText='Google +' st_title='<?php echo $feed_array[$i]['title']; ?>' st_url='<?php echo $feed_array[$i]['href']; ?>'></span>
                            <span class='st_linkedin_custom social-btn' displayText='LinkedIn' st_title='<?php echo $feed_array[$i]['title']; ?>' st_url='<?php echo $feed_array[$i]['href']; ?>'></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>		       
    </div>	
</div>
<!--<script src="js/jquery.fittext.js"></script>-->
<script src="http://isotope.metafizzy.co/isotope.pkgd.min.js"></script>
<script src="https://d20gj6m76a89ac.cloudfront.net/js/jquery.fittext.js"></script>
<script type="text/javascript">
    $(".small-text").fitText(2.5,{minFontSize:"12px",maxFontSize:"48px"});$(".medium-text").fitText(2,{minFontSize:"12px",maxFontSize:"48px"});$(".large-text").fitText(1.5,{minFontSize:"16px",maxFontSize:"48px"});$(".larger-text").fitText(3,{minFontSize:"18px",maxFontSize:"72px"});$(".small-text").fitText(2.5,{minFontSize:"12px",maxFontSize:"36px"});

    function changeFragAjax(cat) {
        $(document).ready(function() {
            $.ajax({
                type: "POST", 
                data: {cat:cat},
                url: "news.php"
            })
            .done(function(data) {
                alert("ajax completed" + data);
                parseData = JSON.parse(data);
                console.log(parseData);
            });
        });
    }

    function changeFrag(frag) {
      var frag = frag.toString();
      var finalFrag = frag.slice(frag.indexOf("#")+1, frag.length);
      window.location.href = "?cat=" + finalFrag; 
    };

    var $container = $('#newsfeed');
    // init
    $container.isotope({
      // options
      itemSelector: '.block',
      isOriginLeft: false,
      layoutMode: 'masonry'
    });

    $(window).on('resize',function() {
        var h = $(window).height();
        var p = $(window).height()/100;
        var dif = $('#job-container').height() + $('#top-menu').height() + p*2;
        var dif2 = h - ($('#left-menu-top').height() + $('#top-menu').height());
        var pro_h = h - dif;

       $('#promotions').css({
            'height': ''+pro_h+'px',
        });

       $('#left-menu-bottom').css({
            'height': ''+dif2+'px',
        });

       console.log('height:' + dif2);
    }).trigger('resize');
</script>
<script src="../js/scroll-fade.js"></script>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="https://d20gj6m76a89ac.cloudfront.net/js/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "4c119437-bdab-4440-bdca-1fdf5b7a2613", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
<?php include_once('views/_footer.php'); ?>
