<!DOCTYPE html>
<html>
<head>
<title>Edit Patient</title>
</head>
<body>
<h2>Edit Patient</h2>
<?php echo validation_errors(); ?>
<?php echo form_open('patient/edit/'.$patient->id); ?>
<label for="name">Name:</label>
<input type="text" name="name" value="<?php echo $patient->name; ?>"/>


<label for="email">Email:</label>
<input type="email" name="email" value="<?php echo $patient->email; ?>"/>


<label for="phone">Phone:</label>
<input type="text" name="phone" value="<?php echo $patient->phone; ?>"/>


<input type="submit" name="submit" value="Update Patient"/>
<?php echo form_close(); ?>
</body>
</html>
