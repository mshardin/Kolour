<?php
session_start();
    /**
     * creates a personal private user directory for each newly registered user
     */
    function createUserProfDir($user)
    {
        $cwd = $_SERVER['DOCUMENT_ROOT'] . '/users';
        $cud = $cwd. '/' .$user;

        if (!file_exists($cwd. '/' .$user)) {
            mkdir($cud, 0755, true);
            mkdir($cud . '/style', 0755, true);
        } 
        $profile_src = $_SERVER['DOCUMENT_ROOT'] . '/views/profile/'  . 'profile.php';
        $profile = $_SERVER['DOCUMENT_ROOT'] . '/users/' . $user . '/index.php';
        $profile_style = $_SERVER['DOCUMENT_ROOT'] . '/style/960.css';
        copy($profile_src, $profile);
        copy($profile_style, $cud . '/style/960.css');
    }

    // Print Skills Table
    function printSkillsTable() 
    {
?>
        <table border='0' style='background-color:#CCFFFF;border-collapse:collapse;border:0px solid #000000;color:#000000;width:100px;' cellpadding='3' cellspacing='3'>
        <?php 
        //echo $_SESSION['user_name'] . 'Skills:';
        $i = 1;
        do {
        ?>
            <tr>
                <td>Skill: <?php echo $i; ?><input type="text" name="skills[skill][]"></td>
                <td>Description: <textarea name="skills[desc][]"></textarea></td>
                <td>Experience: <input type="number" name="skills[exp][]"></td>
            </tr>
        <?php 
        $i = $i + 1;
        } while($i <= 5);
        ?>
        <?php if(check_user_auth($_SESSION['user_name'])) { 
        ?>
            <tr><td><input type="submit" name="submit"></td></tr>
        <?php
        }
        ?>
        </table>
        </form>
<?php
    }

    // Print Basic Information Table
    function printBasicInfoTable() 
    {
    $basic_info_arr = ["Birthplace", "Current Location", "Race", "Sex", "Highest Education Completed", "Degree", "Speciality"];
    $basic_info_arr_names = ["birthplace", "current_loc", "race", "sex", "hec", "degree", "speciality"];
?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Basic Information:</label>
    <table border="0" style="background-color:#CCFFFF;border-collapse:collapse;border:0px solid #000000;color:#000000;width:100%;height:100px;" cellpadding="3" cellspacing="3">
    <tr>
    <?php
    for($i = 0; $i < count($basic_info_arr)/2; $i++) 
    {
    ?>
        <td><label><?php echo $basic_info_arr[$i];?>:</label></td>
        <td><input type="text" name="<?php echo $basic_info_arr_names[$i];?>"></td>
    <?php 
    }
    ?>
    </tr>
    <tr>
    <?php
    for($i = (count($basic_info_arr)/2)+1; $i < count($basic_info_arr); $i++) 
    {
    ?>
        <td><label><?php echo $basic_info_arr[$i];?>:</label></td>
        <td><input type="text" name="<?php echo $basic_info_arr_names[$i];?>"></td>
    </tr>
    <?php 
    }
    printSkillsTable();
    ?>
    </table>
    </form>
<?php
}

function check_user_auth($user) 
{
    if(isset($user)) {
        return true;
    } else {
        return false;
    }
}

function clean($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>