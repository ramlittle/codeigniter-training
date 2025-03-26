<!DOCTYPE html>
<html>
<head>
    <title>Patients List</title>
</head>
<body>
    <h2>Patients List</h2>
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>
    <a href="<?php echo site_url('patient/add'); ?>">Add New Patient</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($patients as $patient): ?>
        <tr>
            <td><?php echo $patient['id']; ?></td>
            <td><?php echo $patient['name']; ?></td>
            <td><?php echo $patient['email']; ?></td>
            <td><?php echo $patient['phone']; ?></td>
            <td>
                <a href="<?php echo site_url('patient/edit/'.$patient['id']); ?>">Edit</a> |
                <a href="<?php echo site_url('patient/delete/'.$patient['id']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
