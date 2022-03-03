<?php

if (isset($_POST['submit']) && $_POST['submit'] != '') {
    // require the db connection
    require_once 'includes/db.php';

    $first_name = (!empty($_POST['first_name'])) ? $_POST['first_name'] : '';
    $last_name = (!empty($_POST['last_name'])) ? $_POST['last_name'] : '';
    $gender = (!empty($_POST['gender'])) ? $_POST['gender'] : '';
    $email = (!empty($_POST['email'])) ? $_POST['email'] : '';
    $course = (!empty($_POST['course'])) ? $_POST['course'] : '';
    $semester = (!empty($_POST['semester'])) ? $_POST['semester'] : '';

    $id = (!empty($_POST['student_id'])) ? $_POST['student_id'] : '';

    if (!empty($id)) {
        // update the record
        $stu_query = "UPDATE `students` SET fname='" . $first_name . "', lname='" . $last_name . "',gender='" . $gender . "',email= '" . $email . "', course='" . $course . "',semester='".$semester."' WHERE id ='" . $id . "'";
        $msg = "update";
    } else {
        // insert the new record
        $stu_query = "INSERT INTO `students` (fname, lname, gender,email,course,semester) VALUES
         ('". $first_name ."', '" . $last_name . "', '" . $gender . "', '" . $email . "', '" . $course . "' ,'" . $semester . "')";
        $msg = "add";
    }

    $result = mysqli_query($conn, $stu_query);

    if ($result) {
        header('location:/crud/index.php?msg=' . $msg);
    }

}

if (isset($_GET['id']) && $_GET['id'] != '') {
    // require the db connection
    require_once 'includes/db.php';

    $stu_id = $_GET['id'];
    $stu_query = "SELECT * FROM `students` WHERE id='" . $stu_id . "'";
    $stu_res = mysqli_query($conn, $stu_query);
    $results = mysqli_fetch_row($stu_res);
    $first_name = $results[1];
    $last_name = $results[2];
    $gender = $results[3];
    $email = $results[4];
    $course = $results[5];

} else {
    $first_name = "";
    $last_name = "";
    $gender = "";
    $email = "";
    $course = "";
    $stu_id = "";
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'partial/head.php';?>
<body>
   <?php include 'partial/nav.php';?>

    <div class="container">
        <div class="formdiv">
        <div class="info"></div>
        <form method="POST" action="" class="shadow p-3">
            <h2 class="text-center text-white bg-dark p-3">Add Record</h2>
            <div class="form-group row">
                <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-7">
                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="<?php echo $first_name; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-7">
                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>">
                </div>
            </div>
            <div class="form-group row">
            <label for="gender" class="col-sm-3 col-form-label">Gender</label>
            <div class="col-sm-7">
                <select class="form-control" name="gender" id="gender">
                <option value="">Select Gender</option>
                <option value="Male" <?php if ($gender == 'Male') {echo "selected";}?> >Male</option>
                <option value="Female" <?php if ($gender == 'Female') {echo "selected";}?>>Female</option>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-7">
                <input type="email" value="<?php echo $email; ?>" name="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group row">
            <label for="course" class="col-sm-3 col-form-label">Course</label>
            <div class="col-sm-7">
                <select class="form-control" name="course" id="course">
                <option value="">Select Course</option>
                <option value="BCA" <?php if ($course == 'BCA') {echo "selected";}?>>BCA</option>
                <option value="MCA" <?php if ($course == 'MCA') {echo "selected";}?>>MCA</option>
                </select>
                </div>
            </div>
            <div class="form-group row">
            <label for="course" class="col-sm-3 col-form-label">semester</label>
            <div class="col-sm-7">
                <select class="form-control" name="semester" id="course">
                <option value="">Select Course</option>
                <option value="ist" <?php if ($course == 'ist') {echo "selected";}?>>Ist</option>
                <option value="2nd" <?php if ($course == '2nd') {echo "selected";}?>>2nd</option>
                <option value="3rd" <?php if ($course == '3rd') {echo "selected";}?>>3rd</option>
                <option value="4rth" <?php if ($course == '4rth') {echo "selected";}?>>4rth</option>
                <option value="5th" <?php if ($course == '5th') {echo "selected";}?>>5th</option>
                <option value="6th" <?php if ($course == '6th') {echo "selected";}?>>6th</option>
                <option value="7th" <?php if ($course == '7th') {echo "selected";}?>>7th</option>
                <option value="8th" <?php if ($course == '8th') {echo "selected";}?>>8th</option>

                </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-7">
                <input type="hidden" name="student_id" value="<?php echo $stu_id; ?>">
                <input type="submit" name="submit" class="btn btn-dark text-white" value="SUBMIT" />
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>