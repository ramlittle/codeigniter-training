<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
</head>
<body>
    <h2>Register User</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('user/register'); ?> <!--used form to allow file uploading-->
    <!-- <?php //echo form_open('patient/add'); ?> -->
    <label>Email:</label>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>
    <label>Password:</label>
    <input type="text" name="password" value="<?php echo set_value('password'); ?>"><br>
    <label>Confirm Password:</label>
    <input type="text" name="confirm_password" value=""><br>
    <button type="submit">Submit</button>
    <button type="button" onclick="window.location.href='<?php echo site_url('user/login'); ?>'">Cancel</button>
    <?php echo form_close(); ?>
</body>
</html>

