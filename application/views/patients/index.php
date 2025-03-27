<!DOCTYPE html>
<html>

<head>
    <title>Patients List</title>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width'>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src='https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js'></script>
</head>

<body>
    <h2>Patients List</h2>
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
    <?php endif; ?>
    <a href="<?php echo site_url('patient/add'); ?>">Add New Patient</a>
    <a href="<?php echo site_url('user/logout'); ?>" class="btn btn-danger">Logout</a>
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
                        IMAGE HERE
                    </td>
                    <td><?php echo $patient['firstname']; ?></td>
                    <td><?php echo $patient['middlename']; ?></td>
                    <td><?php echo $patient['lastname']; ?></td>
                    <td><?php echo $patient['email']; ?></td>
                    <td><?php echo $patient['phone']; ?></td>
                    <td><?php echo $patient['birthdate']; ?></td>
                    <td><?php echo $patient['sex']; ?></td>
                    <td>
                        <a href="<?php echo site_url('patient/edit/' . $patient['id']); ?>">Edit</a> |
                        <a href="<?php echo site_url('patient/delete/' . $patient['id']); ?>"
                            onclick="return confirm('Are you sure?');">Delete</a>
                        <a href="#" data-patient-id="<?php echo $patient['id']; ?>">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- PATIENTS DETAILS MODAL -->
    <div class='modal fade' id='patientModal' aria-hidden='true'>
        <div class='modal-dialog bg-white'>
            <div class='modal-header'>
                <h5 class='modal-title'>Patient Details</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='close'>Close</button>
            </div>
            <div class='modal-body'>
                <div>
                    <img id="patientProfileImage"
                        alt="broken link"
                        style="width:5rem;height:5rem;border-radius:100%;border:0.25rem solid black;"
                        />
                </div>
                <p>
                    <strong>First Name: <span id='patientFirstName'></span></strong><br>
                    <strong>Middle Name: <span id='patientMiddleName'></span></strong><br>
                    <strong>Last Name: <span id='patientLastName'></span></strong><br>
                    <strong>Email: <span id='patientEmail'></span></strong><br>
                    <strong>Phone: <span id='patientPhone'></span></strong><br>
                    <strong>Birth Date: <span id='patientBirthDate'></span></strong>
                    <strong>Sex: <span id='patientSex'></span></strong>
                </p>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            </div>
        </div>
    </div>

</body>
<script>
    // DATATABLE
    $(document).ready(function () {
        $('#patientsTable').DataTable();
    });

    // AJAX
    function getPatientById(id) {
        $.ajax({
            type: 'GET',
            url: "<?php echo base_url('patient/getPatientByID/'); ?>" + id,
            dataType: 'json',
            success: function (data) {
                console.log('data here', data);
                // Update modal HTML elements with patient data
                // $('$patientProfileImage').src(data.profile_image);
                $('#patientFirstName').text(data.firstname);
                $('#patientMiddleName').text(data.middlename);
                $('#patientLastName').text(data.lastname);
                $('#patientEmail').text(data.email);
                $('#patientPhone').text(data.phone);
                $('#patientSex').text(data.sex);
                $('#patientBirthDate').text(data.birthdate);
                // Show the modal
                $('#patientModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }

    // EVENT LISTENER
    $(document).ready(function () {
        $('#patientsTable').DataTable();
        $('a[data-patient-id]').on('click', function () {
            var patientId = $(this).data('patient-id');
            getPatientById(patientId);
        });
    });
</script>


</html>