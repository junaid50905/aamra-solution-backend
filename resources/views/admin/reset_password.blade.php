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

        <h2>Reset user password</h2>

        <div class="reset_form w-25 bg-info p-3">
            <form action="{{ route('reset', $reset_user->id) }}" method="POST">
                @csrf
            <input type="password" name="password" class="form-control">
            <button type="submit" class="btn btn-success mt-2">Reset</button>
        </form>
        </div>

    </div>


    <script src="{{ asset('ui/admin/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
