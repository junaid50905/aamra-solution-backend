<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('ui/admin/css/bootstrap.min.css') }}">
</head>

<body>


    <div class="container mt-5">

        <h2>All registered users</h2>

        <table class="table">
        <thead>
            <tr>
                <th scope="col">SN</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Name</th>
                <th scope="col">Activity</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->email }}</td>
                <td>{{ $user->password }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <a href="{{ route('reset_password_form', $user->id) }}" class="btn btn-warning">Reset password</a>
                </td>
            </tr>
            @empty

            @endforelse
        </tbody>
    </table>
    </div>


    <script src="{{ asset('ui/admin/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
