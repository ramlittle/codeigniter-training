<!DOCTYPE html>
<html>

<head>
    <title>Edit Patient</title>
</head>

<body>
    <h2>Edit Patient</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart('patient/edit/' . $patient->id); ?>
    <img src = "<?php echo base_url('./uploads/') . $patient->profile_image ;?>"
        alt='broken link'
        style='width:3rem;height:3rem;border-radius:100%;border:1px solid black;'/>
    <label>Profile Image:</label>
    <input type="file" name="profile_image">
    <label for="name">First Name</label>
    <input type="text" name="firstname" value="<?php echo $patient->firstname; ?>" />

    <label for="name">Middle Name:</label>
    <input type="text" name="middlename" value="<?php echo $patient->middlename; ?>" />

    <label for="name">Last Name:</label>
    <input type="text" name="lastname" value="<?php echo $patient->lastname; ?>" />


    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $patient->email; ?>" />


    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="<?php echo $patient->phone; ?>" />

    <label>Birth Date:</label>
    <input type="date" name="birthdate" value="<?php echo $patient->birthdate ?>"><br>

    <label>Sex:</label>
    <select name="sex">
        <option value="">Select Sex</option>
        <option value="M" <?php echo ($patient->sex == 'M') ? 'selected' : ''; ?>>Male</option>
        <option value="F" <?php echo ($patient->sex == 'F') ? 'selected' : ''; ?>>Female</option>
    </select>

    <input type="submit" name="submit" value="Update Patient" />
    <button type="button" onclick="window.location.href='<?php echo site_url('patient/index'); ?>'">
        Cancel
    </button>
    <?php echo form_close(); ?>
</body>

</html>