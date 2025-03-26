<!DOCTYPE html>
<html>
<head>
    <title>Patients List</title>
    <meta charset='UTF-8'/>
    <meta name = 'viewport' content = 'width=device-width,initial-scale-1.0'/>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css'>
    <script src='https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js'></script>
</head>
<body>
    <h2>Patients List</h2>
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>
    <a href="<?php echo site_url('patient/add'); ?>">Add New Patient</a>
    <table id="patientsTable" style='width:100%;'>
        <thead>
            <tr>
                <th>ID</th>
                <th>FIRST NAME</th>
                <th>MIDDLE NAME</th>
                <th>LAST NAME</th>
                <th>Email</th>
                <th>Phone</th>
                <th>BIRTH DATE</th>
                <th>SEX</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?php echo $patient['id']; ?></td>
                    <td><?php echo $patient['firstname']; ?></td>
                    <td><?php echo $patient['middlename']; ?></td>
                    <td><?php echo $patient['lastname']; ?></td>
                    <td><?php echo $patient['email']; ?></td>
                    <td><?php echo $patient['phone']; ?></td>
                    <td><?php echo $patient['birthdate']; ?></td>
                    <td><?php echo $patient['sex']; ?></td>
                    <td>
                        <a href="<?php echo site_url('patient/edit/'.$patient['id']); ?>">Edit</a> |
                        <a href="<?php echo site_url('patient/delete/'.$patient['id']); ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('#patientsTable').DataTable();
        });
    </script>
</body>
</html>