<!DOCTYPE html>
<html>

<head>
    <title>Edit Patient</title>
</head>

<body>
    <div style='display:flex; flex-direction:column;align-items:center;'>
        <h2>Edit Patient</h2>
        <?php echo validation_errors(); ?>
    </div>
    <hr />
    <?php echo form_open_multipart('patient/edit/' . $patient->id); ?>
    <div style='display:flex; 
        flex-direction:column;
        justify-content:center;
        align-items:center;'>
        <?php
        if ($patient->profile_image) {
            echo "<img src = '" . base_url('./uploads/') . $patient->profile_image . "' 
                alt='broken link'
                style='width:5rem;height:5rem;border-radius:100%;border:0.25rem solid black;'
                />";
        } else {
            echo "
                    <div style='width: 5rem; height:5rem; 
                        border-radius: 100%; border:0.5rem solid black;
                        background-color: grey;'></div>
                ";
        }
        ?>
    </div>
    <div style='display:flex; justify-content: center;'>
        <div>
            <label for="name">First Name</label>
            <input style='padding:0.25rem'
                type="text" name="firstname" 
                value="<?php echo $patient->firstname; ?>" 
                />
        </div>
        <div>
            <label for="name">Middle Name:</label>
            <input style='padding:0.25rem'
                type="text" name="middlename" value="<?php echo $patient->middlename; ?>" />
        </div>
        <div>
            <label for="name">Last Name:</label>
            <input style='padding:0.25rem'
                type="text" name="lastname" value="<?php echo $patient->lastname; ?>" />
        </div>
    </div>

    <div style='display:flex; justify-content: center;'>
        <div>
            <label for="email">Email:</label>
            <input style='padding:0.25rem'
                type="email" name="email" value="<?php echo $patient->email; ?>" />
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input style='padding:0.25rem'
                type="text" name="phone" value="<?php echo $patient->phone; ?>" />
        </div>

        <div>
            <label>Birth Date:</label>
            <input style='padding:0.25rem'
                type="date" name="birthdate" value="<?php echo $patient->birthdate ?>"><br>
        </div>
    </div>

    <div style='display:flex;justify-content:center;'>
        <div>
            <label>Sex:</label>
            <select style='padding:0.25rem'
                name="sex" >
                <option value="">Select Sex</option>
                <option value="M" <?php echo ($patient->sex == 'M') ? 'selected' : ''; ?>>Male</option>
                <option value="F" <?php echo ($patient->sex == 'F') ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>

        <div>
            <label>Profile Image:</label>
            <input style='padding:0.25rem'
                type="file" name="profile_image">
        </div>
    </div>

    <div style='display:flex; justify-content: center;'>
        <div>
            <input type="submit" name="submit" value="Update Patient" />
            <button type="button" onclick="window.location.href='<?php echo site_url('patient/index'); ?>'">
                Cancel
            </button>
        </div>
    </div>

    <?php echo form_close(); ?>
    <hr/>
</body>

</html>