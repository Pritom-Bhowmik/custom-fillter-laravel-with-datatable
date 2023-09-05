<!DOCTYPE html>
<html>

<head>
    <title>How to add Custom filter in DataTable AJAX pagination in Laravel 9</title>
    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <!-- Datatable CSS -->
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row offset-2 mt-5 mb-4">
            <div class="col-md-3">
                <!-- City -->
                <select id='sel_city' class="form-control">
                    <option value=''>-- Select city --</option>
        
                    @foreach ($cities as $city)
                        <option value='{{ $city->city }}'>{{ $city->city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <!-- Gender -->
                <select id='sel_gender' class="form-control">
                    <option value=''>-- Select Gender --</option>
                    <option value='male'>Male</option>
                    <option value='female'>Female</option>
                </select>
            </div>
            <div class="col-md-3">
                <!-- Name -->
                <input type="text" id="searchName" class="form-control" placeholder="Search Name">
            </div>
    
    
        </div>
    
        <table id='empTable' class="mt-5 display">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>City</th>
                </tr>
            </thead>
        </table>
    </div>




    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"></script>

    <!-- Script -->
    <script type="text/javascript">
        $(document).ready(function() {

            // DataTable
            var empTable = $('#empTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('getEmployees') }}",
                    data: function(data) {
                        data.searchCity = $('#sel_city').val();
                        data.searchGender = $('#sel_gender').val();
                        data.searchName = $('#searchName').val();
                    }
                },
                columns: [{
                        data: 'username'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'gender'
                    },
                    {
                        data: 'city'
                    },
                ]
            });

            $('#sel_city, #sel_gender').change(function() {
                empTable.draw();
            });

            $('#searchName').keyup(function() {
                empTable.draw();
            });

        });
    </script>
</body>
</html>
