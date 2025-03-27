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
                <th>IMAGE</th>
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
                    <td>
                        <?php
                            if($patient['profile_image']){
                               echo "<img src = '".base_url('./uploads/').$patient['profile_image']."' 
                                alt='broken link'
                                style='width:2rem;height:2rem;border-radius:100%;border:1px solid black;'
                                />";
                            }
                        ?>
                    </td>
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
                        <a href=''>Show modal data</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- PATIENTS DETAILS MODAL -->
    <div class='modal fade' id='patientModal' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-header'>
                <h5 class='modal-title'>Patient Details</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='close'>Close</button>
            </div>
            <div class='modal-body'>
                <p>
                    <strong>Name:
                        <span id='patientName'></span>
                    </strong>
                    <strong>Email:
                        <span id='patientEmail'></span>
                    </strong>
                    <strong>Phone:
                        <span id='patientPhone'></span>
                    </strong>
                    <strong>Address:
                        <span id='patientAddress'></span>
                    </strong>
                </p>
            </div>
            <div class='modalfooter'>
                <button type='button' class='btn btn-secondary' data-bs-dismis='modal'>Close</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#patientsTable').DataTable();
        });

        function getPatientById($id){
            $.ajax({
            type: 'GET',
            url: "<?php echo base_url('patient/getPatientByID/'.$id); ?>",
            dataType: 'json',
            success: function(data) {
                console.log('data here',data);
                // Update HTML elements with patient data
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        }
        
        getPatientById(9);
    </script>
</body>
</html>