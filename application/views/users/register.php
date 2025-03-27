<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
</head>
<body>
    <h2>Register User</h2>

    <!-- Show validation errors -->
    <?php echo validation_errors(); ?>

    <!-- Show flash messages -->
    <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>

    <?php echo form_open('user/register'); ?> 

    <label>Firstname:</label>
    <input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>"><br>
    <label>Lastname:</label>
    <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>"><br>
    <label>Email:</label>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>

    <label>Password:</label>
    <input type="password" name="password"><br> <!-- Changed to password field -->

    <label>Confirm Password:</label>
    <input type="password" name="confirm_password"><br> <!-- Changed to password field -->

    <button type="submit">Register</button>
    <button type="button" onclick="window.location.href='<?php echo site_url('user/login'); ?>'">Cancel</button>

    <?php echo form_close(); ?>
</body>
</html>
