<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Job Board</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <link rel="author" type="text/html" href="http://key-li.me">
        <meta name="author" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <style type="text/css">
        .add {
            margin-bottom: 10px;
            margin-left: 15px;
        }
        input[type=text] {
            margin-bottom: 10px;
        }
        </style>
    </head>

    <body>
       <div class="wrapper" style="margin-top:30px;height:100%">
    
            <form>
                    <label for="comp-name">Company Name:</lable><br>
                    <input type="text" name="comp-name" id="comp-name" maxlength="100"><br>

                    <label for="job-title">Job Title:</label><br>
                    <input type="text" name="job-title" id="job-title" maxlength="100"><br>

                    <label for="job-desc">Job Description:</label><br>
                    <textarea name="job-desc" id="job-desc"></textarea><br><br>

                    <label for="salary">Salary</label><br>
                    <input type="text" name="salary" id="salary"><br>

                    <label for="job-type">Employment Type:</label><br>
                    <select name="job-type" id="job-type">
                        <option>Part-Time</option>
                        <option>Full-Time</option>
                        <option>Part-Time/Full-Time</option>
                        <option>Seasonal</option>
                        <option>Temporary/Seasonal</option>
                        <option>Exempt</option>
                    </select><br><br>

                    <label for="k-score-limit">Kolour Score Limit:</label><br>
                    <select name="k-score-limit" id="k-score-limit">
                    <?php 
                    for ($i = 1; $i < 100; $i++) {
                    ?>
                        <option><?php echo $i; ?></option>
                    <?php
                    }
                    ?>
                    </select><br><br>

                    <!-- <p>Would you like the user the answer interview question ? :</p>

                    Yes&nbsp;&nbsp;<input type="radio" name="yes" id="yes" value="yes">
                    No&nbsp;&nbsp;<input type="radio" name="no" id="no" value="no">

                    <div id="questionDiv">
                    </div><br> -->

                <input type="submit" id="submit" name="submit" value="Submit">
            </form>

        </div>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#submit').click(function(event) {
                event.preventDefault();

                var company     = $('#comp-name').val();
                var title       = $('#job-title').val();
                var description = $('#job-desc').val();
                var salary      = $('#salary').val();
                var type        = $('#job-type').val();
                var limit       = $('#k-score-limit').val();

                // alert(company + "\n" + title + "\n" + description + "\n" + salary + "\n" + type + "\n" + limit)
                // If Geolocation API is available on browser
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        sendIP(position.coords.latitude, position.coords.longitude, company, title, description, salary, type, limit);
                    });
                } else {
                    console.log("do something later");
                }
            }); // Click event handler
        }); // Document.ready

        // Send IP details with the others 
        function sendIP(mylat, mylong, company, title, description, salary, type, limit) {
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
                    'long':mylong
                },
                success: (function(data, textStatus, xhr) {
                    console.log(data + textStatus);
                }), // If successful call 
            }); // Ajax call
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
        </script>
    </body>
</html>