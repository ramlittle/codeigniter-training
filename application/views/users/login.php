<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login Page</h2>

    <?php if ($this->session->flashdata('error')): ?>
        <p style="color: red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <?php echo validation_errors(); ?>
    
    <?php echo form_open('user/login'); ?>
    
    <label>Email:</label>
    <input type="text" name="email" id='email'><br>
    
    <label>Password:</label>
    <input type="text" name="password" id='password'><br> <!-- Changed input type to password -->
    
    <button type="submit">Login</button>
    <button type="button" onclick="window.location.href='<?php echo site_url('user/register'); ?>'">Register</button>
    <?php echo form_close(); ?>
</body>
</html>
