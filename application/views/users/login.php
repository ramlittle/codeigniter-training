<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login Page</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('user/login'); ?> <!--used form to allow file uploading-->
    <!-- <?php //echo form_open('patient/add'); ?> -->
    <label>Email:</label>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>
    <label>Password:</label>
    <input type="text" name="password" value="<?php echo set_value('password'); ?>"><br>
    <button type="submit">Submit</button>
    <?php echo form_close(); ?>
</body>
</html>

