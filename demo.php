<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datatables Bootstrap 5</title>
    <!-- Basic setup -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap4.css">
    <style>
        .dt-button.red {
            color: red;
        }
    
    </style>
</head>
<body>
<div class="row table-responsive">
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S. No.</th>
                <th>Role</th>
                <th>Image</th>
                <th>User Name</th>
                <th>Contact</th>
                <th>User Id</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>1</td>
            <td>admin</td>
            <td></td>
            <td>Nitesh</td>
            <td>8756192516</td>
            <td>nitesh@123</td>
            <td>Test@123</td>
                <td class="action-buttons">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                    <button type="button" class="btn btn-danger btn-sm"><span class="bi-trash"></span></button>
                </td>
            </tr>
        </tbody>
    </table>
    
                       

    <!-- Basic setup -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap4.js"></script>
    <script>
        new DataTable('#example');
    </script>
    
</body>
</html>