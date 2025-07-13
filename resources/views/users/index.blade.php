<!DOCTYPE html>
<html>

<head>
    <title>Laravel Yajra DataTable</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="container">
        <h2>User List</h2>
        <table id="users-table" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
        </table>
    </div>
  
  
  
    <div class="container mt-4">
    <h2>Add User</h2>
    <form id="user-form">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" name="name" required />
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" required />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<hr>

  
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('users.data') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' }
            ]
        });

        $('#user-form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('users.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    alert(response.message);
                    $('#user-form')[0].reset();
                    table.ajax.reload(); // reload table
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let messages = '';
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            messages += value + '\n';
                        });
                        alert(messages);
                    } else {
                        alert('Something went wrong!');
                    }
                }
            });
        });
    });
</script>


</body>

</html>