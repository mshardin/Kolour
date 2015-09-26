<?php 
include_once('views/_header.php'); 
include_once('views/menu_bar.php'); 
?>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/css/select2.min.css" rel="stylesheet" />

<style type="text/css">
    body, html {
        width: 100%;
        height: 100%;
        box-sizing: border-box;
    }
    #msform input, #msform textarea {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-bottom: 10px;
        width: 100%;
        font-size: 13px;
        background: transparent;
    }
    button {
        color: white;
        cursor: pointer;
        width: 200px !important;
        height: 50px;
        line-height: 25px;
        background-color: #27AE60;
        font-size: 21pt;
        position: relative;
        z-index: 999;
    }
    select {
        padding: 5px 0 5px 20px;
        margin: 0 0 10px 0;
        color: white;
        border: none;
        background-color: #DD1281;
        display: block;
        border-radius: 0;
        -webkit-appearance: none;
        width: 104.5%;
    }
    option { 
        background-color: #252324;
    }
    ::-webkit-scrollbar {
        display: none;
    }
    .error {
        display: none;
        margin-left: 10px;
    }
    .error_show {
        color: red;
        margin-left: 10px;
    }
    /*input.invalid, textarea.invalid {
        background: url(https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Problem.png) no-repeat right center;
        background-size: 20px 20px;
    }
    input.valid, textarea.valid {
        background: url(https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Apply.png) no-repeat right center;
        background-size: 20px 20px;
    }*/
    #msform .action-button {
        width: 100px;
        background: #27ae60;
        color: white;
        border: 0 none;
        border-radius: 1px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }
    #msform .action-button:hover, #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #27ae60;
    }
    /* form styles */
    #msform {
        width: 700px;
        margin: 50px auto;
        text-align: center;
        position: relative;
    }
    /*#msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 3px;
        box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
        padding: 20px 30px;

        width: 100%;
        margin: 0 auto;
    }*/
    #msform fieldset {
        width: 100%;
    }
    /* Hide all except first fieldset */
    #msform fieldset:not(:first-of-type) {
        display: none;
    }
    #progressbar {
        width: 600px;
        margin: 0 auto 30px auto;
        overflow: hidden;
        /* css counters to number the steps */
        counter-reset: step;
    }
    #progressbar li {
        float: left;
        list-style-type: none;
        color: black;
        text-transform: uppercase;
        font-size: 20px;
        width: 200px;
        position: relative;
    }
    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 40px;
        height: 35px;
        line-height: 35px;
        display: block;
        font-size: 15px;
        color: white;
        background: grey;
        border-radius: 3px;
        margin: 0 auto 5px auto;
        text-align: center;
    }
    /* progressbar connectors */
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: black;
        position: absolute;
        left: -50%;
        top: 15px;
        z-index: -1; /* put it behind the numbers */
    }
    #progressbar li:first-child:after {
        /* connector not needed before the first step */
        content: none;
    }
    #progressbar li.active:before, #progressbar li.active:after {
        background: #27ae60;
        color: white;
    }
    .fs-title {
        font-size: 20px;
        text-transform: uppercase;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    .fs-subtitle {
        font-weight: normal;
        font-size: 15px;
        color: #666;
        margin-bottom: 20px;
    }
    input {
        float: none;
        clear: none; /* dmk1 */
    }
    .selection, .select2-search, .select2-search--inline, .select2-search__field {
        width: 100%;
        margin-bottom: 0 !important;
        border: none !important;
    }
</style>

<?php include_once('views/side_bar.php'); ?>

<div id="container">
    <!-- multistep form -->
    <form id="msform">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Basic</li>
            <li>Detailed</li>
            <li>Final</li>
        </ul>
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Basic</h2>
            <h3 class="fs-subtitle">This is step 1</h3>

            <div style="width:100%;display:block;">
                <input type="text" name="business-name" id="business-name" class="invalid employer-input-field" maxlength="100" placeholder="e.g.Algebraic Institute" required style="width:90%;">
            </div>

            <div style="width:100%;display:block;">
                <input type="text" name="business-address" id="business-address" class="invalid employer-input-field" maxlength="100" placeholder="e.g.8383 Craig Street" required style="display:inline-block;width:70%;">
                <input type="text" name="unit-suite" id="unit-suite" maxlength="10" placeholder="4B" style="display:inline-block;width:15%;">
            </div>

            <div style="width:100%;display:block;">
                <input type="text" name="city" id="city" class="invalid employer-input-field" maxlength="100" placeholder="Indianapolis" required style="display:inline-block;width:44%;">
                <input type="text" name="state" id="state" class="invalid employer-input-field" maxlength="2" placeholder="IN" required style="display:inline-block;width:16%;">
                <input type="text" name="zip" id="zip" class="invalid employer-input-field" maxlength="6" placeholder="46250" required style="display:inline-block;width:20%;">
            </div>

            <button type="button" name="next" class="next action-button">Next</button>
        </fieldset>
        <fieldset>
            <h2 class="fs-title">Detailed</h2>
            <h3 class="fs-subtitle">This is step 2</h3>

            <input type="text" name="job-title" id="job-title" maxlength="100" placeholder="Title / Position"><br>

            <select name="job-type" id="job-type">
                <option value="">Please Select...</option>
                <option value="PT">Part-Time</option>
                <option value="FT">Full-Time</option>
                <option value="PTFT">Part-Time / Full-Time</option>
                <option value="TEMP">Temporary / Seasonal</option>
                <option value="EX">Exempt</option>
            </select>

            <select name="job-industry" id="job-industry">
                <option value="">Please Select...</option>
                <option value="ACCT">Accounting/Finance</option>
                <option value="ADMIN">Admin/Office</option>
                <option value="ENG">Architect/Engineer/CAD</option>
                <option value="ART">Art/Media/Design</option>
                <option value="MGMT">Business/Management</option>
                <option value="CUST">Customer service</option>
                <option value="EDU">Education/Teaching</option>
                <option value="FOOD">Food/Beverage</option>
                <option value="GL">General labor</option>
                <option value="GOV">Government</option>
                <option value="HC">Healthcare</option>
                <option value="HOSP">Hospitality</option>
                <option value="HR">Human resources</option>
                <option value="INTENG">Internet engineering</option>
                <option value="LEGAL">Legal/paralegal</option>
                <option value="MANU">Manufacturing</option>
                <option value="PR">Marketing/Advertising/PR</option>
                <option value="NP">Nonprofit</option>
                <option value="RE">Real estate</option>
                <option value="RETAIL">Retail/Wholesale</option>
                <option value="SALES">Sales</option>
                <option value="FIT">Salon/Spa/Fitness</option>
                <option value="BIOTECH">Science/Biotech</option>
                <option value="SECUR">Security</option>
                <option value="ARTISAN">Skilled trades/Artisan</option>
                <option value="SOFTWARE">Software/QA/DBA/etc</option>
                <option value="SYSTEMS">Systems/Networking</option>
                <option value="TECH">Technical support</option>
                <option value="TRANS">Transportation</option>
                <option value="TV">TV/Film/Video/Radio</option>
                <option value="WEB">Web/HTML/Info design</option>
                <option value="WRITE">Writing/Editing</option>
            </select>

            <textarea name="job-description" id="job-description" placeholder="What will be this person's day-to-day responsibilities"></textarea>

            <button type="button" name="previous" class="previous action-button">Previous</button>
            <button type="button" name="next" class="next action-button">Next</button>
        </fieldset>
        <fieldset>
            <h2 class="fs-title">Final</h2>
            <h3 class="fs-subtitle">This is step 3</h3>

            <input type="text" name="salary" id="salary" placeholder="Salary">

            <select name="k-score-min" id="k-score-min" style="display: inline;">
                <?php 
                for ($i = 1; $i <= 100; $i++) {
                ?>
                    <option><?php echo $i; ?></option> 
                <?php
                }
                ?>
                </select>
                to:
                <select name="k-score-max" id="k-score-max" style="display: inline;">
                <?php 
                for ($i = 50; $i <= 100; $i++) {
                ?>
                    <option><?php echo $i; ?></option> 
                <?php
                }
                ?>
            </select>

            <select class="tags" name="tags[]" id="tags" multiple="multiple" style="width: 100%;"></select>

            <button type="button" name="previous" class="previous action-button">Previous</button>
            <button type="button" name="submit" class="submit action-button">Submit</button>
        </fieldset>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.1/js/select2.full.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var current_fs, next_fs, previous_fs; // Fieldsets
    var left, opacity, scale; // Fieldset properties which we will animate
    var animating; // Flag to prevent quick multi-click glitches

    $(".next").click(function() {
        if (animating) return false;

        animating = true; // flag to prevent quick multi-click glitches

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        // activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        // show the next fieldset 
        next_fs.show();

        // hide the current fieldset with style 
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                // as the opacity of current_fs reduces to 0 - stored in now
                // 1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                // 2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                // 3. increase opacity of next-fs to 1 as it moves in
                opacity = 1 - now; 
                current_fs.css({'transform': 'scale('+scale+')'});
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            // this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function() {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        // de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        // show the previous fieldset 
        previous_fs.show();

        // hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                // as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in 
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform':'scale(' + scale + ')', 'opacity': opacity});
            },
            duration: 800,
            complete: function() {
                current_fs.hide();
                animating = false;
            },
            // this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $('#submit').click(function(e) {
        e.preventDefault();

        // pull job post form data values
        var company     = $('#comp-name').val();
        var title       = $('#job-title').val();
        var description = $('#job-desc').val();
        var salary      = $('#salary').val();
        var type        = $('#job-type').val();
        var limit       = $('#k-score-limit').val();
        var tags        = $('#tags').val();

        // alert(company + "\n" + title + "\n" + description + "\n" + salary + "\n" + type + "\n" + limit)
        // If Geolocation API is available on browser
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                sendIP(position.coords.latitude, position.coords.longitude, company, title, description, salary, type, limit, tags);
            });
        } else {
            console.log("do something later");
        }
    }); // Submit click event handler
    getTags(function(tagData) {
        $(".tags").select2({
            placeholder: 'Add 5 tags for job post',
            tags: true,
            maximumSelectionLength: 5,
            data: tagData,
            tokenSeparators: [',', ' ']
        }); // end of Select2 library
    }); // get Tags end function
}); // document ready

// send ip details with the others 
function sendIP(mylat, mylong, company, title, description, salary, type, limit, tags) {
    $.ajax({
        type: 'POST',
        url: 'ajax-job-post.php',
        data: {
            'comp-name':company,
            'job-title':title,
            'job-desc':description,
            'salary':salary,
            'job-type':type,
            'k-score-limit':limit,
            'lat':mylat,
            'long':mylong,
            'tags':tags
        },
        success: (function(data, textStatus, xhr) {
            console.log(data + textStatus);
        }), // if successful call 
    }); // ajax call
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}

// pull tags from database for autocomplete input
function getTags(callback) {
    $.getJSON("/ajax-job-get.php", {} )
    .done(function( json ) {
        var json = json.toString();
        json = json.split(',');
        callback(json);
    })
    .fail(function( jqxhr, textStatus, error ) {
        var err = textStatus + ", " + error;
        console.log( "Request Failed: " + err );
    });
}
</script>
<?php include_once('views/_footer.php'); ?>