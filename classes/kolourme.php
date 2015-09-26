<?php 
include("db.php"); 

$db = db_connect("kolour");
$c = $db->profile;

$cursor = $c->find(array('user_email' => $_SESSION['user_email']));
$cursor = $cursor->getNext();
//var_dump($cursor['profile_vid']['mp4_vid']);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" rel="stylesheet" />
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet" type="text/css">
<link href="https://raw.githubusercontent.com/t0m/select2-bootstrap-css/bootstrap3/select2-bootstrap.css" rel="stylesheet" type="text/css">
<script src="js/modernizr.js"></script>
<script src="js/video.js"></script>
<script src="js/functions.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/main_style.css">
    <title>Kolour Me - You on the Internet</title>
<!-- <link rel="stylesheet" type="text/css" href="css/video-js.min.css"> -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Kolour.me Profile</title>
<!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script type="text/javascript">

var c = 0;
    i = 0;
var score;
var skill ='<div id="skill"> \
            <input name="skill[]" placeholder="Skill" type="text"> \
            <div id="addProject"> \
              <input name="project-title[]" placeholder="Project Title" type="text"> \
              <button class="exp green-btn addProject">+</button> \
            </div> \
            <button class="removeBtn rs">Delete Skill</button> \
            <div id="projects" class="flag projects"></div> \
            <div id="details" class="display"> \
              <h1 id="title"></h1> \
              <span id="description"></span> \
            </div> \
          </div>';

var project = '<div id="project" class="project"> \
            <div class="num-cont"> \
              <input class="num flag1 maxFlag" id="income" type="number" value="0" name="income" min="0" max="20"> \
              <input class="num maxFlag" id="team-size" type="number" value="0" name="team-size" min="0" max="20"> \
              <input class="date dt1" placeholder="Start" type="text"> \
              <input class="date dt2" placeholder="End" type="text"> \
            </div> \
            <textarea placeholder="Description" class="description" name="description[]"></textarea> \
            <span class="left"> </span> \
          </div>';

var storeScore = [];

$(document).ready(function() {
    $("#years").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('#skills').on('focus', '.dt1', function() {
      $(".dt1").datepicker({
          dateFormat: "dd-M-yy",
          minDate: 0,
          onSelect: function (date) {
              var dt2 = $('.dt2');
              var startDate = $(this).datepicker('getDate');
              var minDate = $(this).datepicker('getDate');
              dt2.datepicker('setDate', minDate);
              startDate.setDate(startDate.getDate() + 30);
              //sets dt2 maxDate to the last day of 30 days window
              dt2.datepicker('option', 'maxDate', startDate);
              dt2.datepicker('option', 'minDate', minDate);
              $(this).datepicker('option', 'minDate', minDate);
          }
      });
    });

    $('#skills').on('focus', '.dt2', function() {
      $('.dt2').datepicker({
          dateFormat: "dd-M-yy"
      });
    });
});

//Sum up array
$.fn.maxPoints = function() {
    var map = {};

    this.on('change', function() {
      // $(this).each(function() {
          map[$(this).attr("name")] = parseInt($(this).val());
          
          var total = 0;
          $.each(map,function() {
              total += this;
          });

          if (total < 20){
            console.log(total);
          }
      // });
    });
};

$(function() {

    // $('#skills').on('focus', '.flag', function() {
    //   $(this).parent().addClass( "current" );
    // });

    // $('#skills').on('focusout', '.flag', function() {
    //   $(this).parent().removeClass( "current" );
    // });

    $('.edit').on('click', function(){
        $('#details').addClass("display");
        var last = storeScore.length - 1;
        var prevScr = storeScore[last];
        colorScr(0, prevScr);
    });

    $('#skills').on('focus', '.rs', function() {
      $(this).parent().addClass( "current-rs" );
    });

    // $('#skills').on('focusout', '.rs', function() {
    //   $(this).parent().removeClass( "current-rs" );
    // });

    $('#skills').on('focus', '.removeBtn', function() {
      var checkDiv = $(this).parent().parent().attr('id');
      // var bars = $(this).closest('#project').find('h1').width();
      // var unit1 = $('#container').width()/20;
      // var newScr = (0.5 + Math.floor(bars / unit1));
      // var top = $(this).parent().attr('id');

      var p = $(this).parent().animate({
                "opacity" : "0",
                },{
                "complete" : function() {
                      $(this).remove();
                }
            });

      if (checkDiv == "projects"){
        colorScr(0,0.5);
      }else{
        var div = $( "div" );
        var rp = $('.current-rs div').length - 1;
        var r = rp * 0.5;
        //alert(rp);
        console.log(r);
        colorScr(0,r); 
      };
    });

    $('#skills').on('click', '.addProject', function() {
      //$('#details').remove();
      var k = $('#skills').find('.flag1').length;
      //var house = $('.current').attr("id");
      if(k < 5){
        $(this).parent().append(project)
        $('#project').attr('id', 'project');

        $('.maxFlag').maxPoints();

        return colorScr(0.5,0);
      };
    });

    $('textarea').keyup(function(e) {
        var tval = $('textarea').val(),
            tlength = tval.length,
            set = 140,
            remain = parseInt(set - tlength);
        
        if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
            $('textarea').val((tval).substring(0, tlength - 1))
        }

       return $('.left').text(remain + ' ' + 'char left');
    })
});

function newObject(_selector,_flag,_max,_points,_rpoints,_object){
  var max = _max;
  var k = $(_selector).find( '.' + _flag).length;
  
  //var cloned = $('#' + _id + c );
  //$("#skill"+c).clone().attr('id', 'skill'+(++c) ).insertAfter( cloned );
  if(k < max){
    // var clone = $("#skill"+c).clone(true,true).attr('id', 'skill'+(++c) ).insertAfter( cloned );
    // clone.find('div').remove();
    // clone.find('input[type=text]').val('');
    $(_selector).append(_object);
    //$('#'+ _id).attr('id', _id+(++c));
    return colorScr(_points,_rpoints);
  };
}

function removeSkill(){
  $(e).parents(".current").remove();
}

function colorScr(_points,_rpoints){
  $('<div>')
  .append("<span>")
  .attr('id', 'score')
  .appendTo('body')
  .addClass("fadeOutUp");

  var pos = Number(_points);
  var neg = Number(_rpoints);

  if (pos == 0) {
     $("<h1>")
    .appendTo('.fadeOutUp')
    .text('-' + ' ' + _rpoints + '!')
    .css({
      'color': 'red',
    });
  };

  if (neg == 0) {
   $("<h1>")
    .appendTo('.fadeOutUp')
    .text('+' + ' ' + _points + '!')
  };

  setTimeout(function(){$('#score').remove();}, 5000);

  var score = $('#colorScr').text();
  return $('#colorScr').text(Number(score) + _points - _rpoints);
}

 function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            // var video = document.getElementById('vid');
            // var source = document.createElement('source');

            $("#profile-vid video").attr('src', e.target.result);
            $("#profile-vid video")[0].load();

            $('#profile-vid').css({
               'border': 'none',
            });

            // video.appendChild(source);
            // video.play();
            $('.vid').removeClass("display");

            //clear the previous file 
            return $('input[type="file"]').val(null);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function randomArbitraryNum(min, max) {
    return Math.floor(Math.random() * (max - min) + min);
}

function getNum(){
  $.ajax({
      "type": "GET",
      "url": "http://www.random.org/integers/?num=1&min=1&max=55&col=1&base=10&format=plain&rnd=new",
      "success": function( data, status, xhr ){
        //$( document ).ready(function() {
            var d = parseInt( data );
            //alert(d);
            return d;
        //});
      }
  });
}


function done() {

  var skillsArray = $("input[name='skill[]']").map(function(){return $(this).val();}).get();
  var titlesArray = $("input[name='project-title[]']").map(function(){return $(this).val();}).get();
  var yearsArray = $("input[name='p-years[]']").map(function(){return $(this).val();}).get();
  var descsArray = $("textarea[name='description[]']").map(function(){return $(this).val();}).get();

  save_skills_n_xp(skillsArray,titlesArray,yearsArray,descsArray);

  // console.log(skillsArray);
  // console.log(titlesArray);
  // console.log(yearsArray);
  // console.log(descsArray);

}


function addImage() {

  var newId = $('#award-name').val();
  var auth = $('#auth').val();
  var str = newId.replace(/ /g,'');
  var al = $('#awards').find('.award').length;

  if (al == 8) {$('#award').remove();};

  if (newId != 0){
    $('#category').toggleClass("display");
    $('#award-name').val(null);
    $('#auth').val(null);

    $("<div>")
    .appendTo('#new-awards')
    .addClass("award")
    .attr('id', str)

    $('.cat').on('click', function(){
      var image = $(this).attr('src');
      
      $("<img>")
      .appendTo('#' + str)
      .attr('src', image)
      .addClass("aw-pic");

      $("<h1>")
      .addClass("award-title")
      .appendTo('#' + str)
      .text(newId);

      $("<h4>")
      .addClass("auth-name")
      .appendTo('#' + str)
      .text(auth);

      $('#category').addClass("display");

      return str = null;
    });

  }
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.profile-picture').css({
               'background': 'transparent url('+e.target.result +') center center no-repeat',
               'background-size': 'cover',
               'opacity' : '1',
               'border' : 'none'
            });

            //clear the previous file 
            return $('input[type="file"]').val(null);
            alert('cool');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

</script>
</head>
<body>
  <?php include('views/menu_bar.php'); ?>
  <div id="profile-pop-up">
  <div class="container">
    <div id="profile">
      <div id="profile-container">
        <!-- COLOR SCORE -->
        <div id="colorScr-Container">
          <span></span><h1 id="colorScr">0</h1>
        </div>

        <!-- PROFILE CARD -->
        <div id="profile-card" class="section">
          <div class="top-banner">Profile Card</div>          
          <div class="profile-picture">
            <input class="custom-file-input" type='file' onchange="readURL(this);" />
          </div>
          <div id="intro-video">
            <h1>[ Add Intro Video ]</h1> 
            <p>(<i>just introduce yourself 30s max</i>)</p>
            <input class="custom-file-input" accept="video/*" type="file" name="file" id="file" onchange="uploadFile(this);">
          </div>
          <div id="social-profiles">
            <div id="connect-social-container">
              <a id="connect-facebook" class="s-icon" href="#"></a>
              <a id="connect-twitter" class="s-icon" href="#"></a>
              <a id="connect-instagram" class="s-icon" href="#"></a>
            </div>
          </div>
          <input type="text" placeholder="Your Name">
          <textarea placeholder=" Sell your self in 140 characters." class="description" name="description[]"></textarea> 
          <span class="left"></span> 
        </div>

        <!--  SKILLS -->
        <div id="skill-cont" class="section round-top">
          <div class="top-banner">Skills + Work History</div>
          <div id="skills"></div>
          <!-- <button id="newSkill">New Skill</button> -->
          <button id="new-skill" class="clear green-btn" onclick="newObject('#skills','flag',3,0.5,0,skill);">+ Skill</button>
          <button class="green-btn clear"onclick="done();"><span class="done">Save</span><span class="edit display">Edit</span></button>
        </div>

        <!--  ACHIEVEMENTS -->
        <div id="awards" class="section round-top">
          <div class="top-banner">Achievements</div>
          <div id="new-awards"></div>
          <div id="award">
            <img class="aw-pic" src="Categories/award-wmark.svg">
            <input type="text" id="award-name" name="award-name" placeholder="Award">
            <span class="border"></span>
            <input type="text" id="auth" name="auth" placeholder="Authority">
            <button id="award-btn" onclick="addImage();" class="green-btn blue-btn">+ Award</button>
          </div>
        </div>

        <!-- KEYWORDS -->
        <div id="keywords" class="section round-top">
          <div class="top-banner">Keywords</div>
          <div class="section round-top select2-container select2-container-multi" style="display:block;">
            <div class="select2-choices">
              <div class="select2-search-field" style="float:left;">
                <select class="keywords select2-input select2-default" name="keywords[]" id="keywords" multiple="multiple" style="width:100%;"></select>
              </div>
            </div>
          </div>
        </div>

        <!-- SOCIAL -->
        <div id="social" class="section round-top">
        </div>

       <!--  CATEGORIES -->
        <div id="category" class="display">
          <h1 id="a-h">Choose Category.</h1>
          <div class="cat-cont">
            <img class="cat" src="Categories/web-icon.svg">
            <h4>Web</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/legal-icon.svg">
            <h4>Legal</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/marketing-icon.svg">
            <h4>Marketing</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/science-icon.svg">
            <h4>Science</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/medical-icon.svg">
            <h4>Medical</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/art-icon.svg">
            <h4>Art</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/research-icon.svg">
            <h4>Research</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/political-icon.svg">
            <h4>Political</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/agriculture-icon.svg">
            <h4>Agriculture</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/patent-icon.svg">
            <h4>Patent</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/armed-forces-icon.svg">
            <h4>Armed Forces</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/music-icon.svg">
            <h4>Music</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/writing-icon.svg">
            <h4>Writing</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/cosmetic-icon.svg">
            <h4>Cosmetic</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/fashion-icon.svg">
            <h4>Fashion</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/business-icon.svg">
            <h4>Business</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/education-icon.svg">
            <h4>Education</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/sports-icon.svg">
            <h4>Sports</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/media-icon.svg">
            <h4>Media</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/public-service-icon.svg">
            <h4>Public Service</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/culinary-icon.svg">
            <h4>Culinary</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/design-icon.svg">
            <h4>Design</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/humanitarian-icon.svg">
            <h4>Humanitarian</h4>
          </div>
          <div class="cat-cont">
            <img class="cat" src="Categories/employee-icon.svg">
            <h4>Employee</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="js/jquery.fittext.js"></script>
  <script type="text/javascript">
    $(".small-text").fitText(2.5,{minFontSize:"12px",maxFontSize:"48px"});$(".medium-text").fitText(2,{minFontSize:"12px",maxFontSize:"48px"});$(".large-text").fitText(1.5,{minFontSize:"16px",maxFontSize:"48px"});$(".small-text").fitText(2.5,{minFontSize:"12px",maxFontSize:"36px"});
  </script>
  <script type="text/javascript">
    $(".keywords").select2({
      placeholder: 'Add 5 tags for job post',
      tags: true,
      maximumSelectionLength: 15,
      // data: tagData,
      tokenSeparators: [',', ' ']
    }); // End of Select2 library
  </script>
</body>
</html>