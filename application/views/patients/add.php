<!DOCTYPE html>
<html>

<head>
    <title>Add Patient</title>
</head>

<body>
    <h2>Add Patient</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('patient/add'); ?>

    <label>First Name:</label>
    <input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>"><br>
    <label>Middle Name:</label>
    <input type="text" name="middlename" value="<?php echo set_value('middlename'); ?>"><br>
    <label>Last Name:</label>
    <input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>"><br>

    <label>Email:</label>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo set_value('phone'); ?>"><br>

    <label>Birth Date:</label>
    <input type="date" name="birthdate" value="<?php echo set_value('birthdate'); ?>"><br>

    <label>Sex:</label>
    <select name="sex">
        <option value="">Select Sex</option>
        <option value="M"<?php echo set_select('sex','M'); ?>>Male</option>
        <option value="F"<?php echo set_select('sex','F'); ?>>Female</option>
    </select>
    <br/>
    <button type="submit">Submit</button>

    

    <?php echo form_close(); ?>
</body>

</html>