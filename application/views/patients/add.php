<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>
</head>
<body>
    <h2>Add Patient</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('patient/add'); ?>

    <label>Name:</label>
    <input type="text" name="name" value="<?php echo set_value('name'); ?>"><br>

    <label>Email:</label>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo set_value('phone'); ?>"><br>

    <button type="submit">Submit</button>

    <?php echo form_close(); ?>
</body>
</html>