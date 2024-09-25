<!-- resources/views/user/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register New Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            color: #666;
        }
        input {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
        .success {
            color: green;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Register New Admin</h1>

    <div id="message"></div>

    <form id="adminForm">
        <label for="nama_admin">Name:</label>
        <input type="text" id="nama_admin" name="nama_admin" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="no_telp">Phone Number:</label>
        <input type="text" id="no_telp" name="no_telp" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register Admin</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#adminForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '/api/admin/register',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#message').html('<p class="success">Admin registered successfully!</p>');
                    $('#adminForm')[0].reset();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '<div class="error"><ul>';
                    $.each(errors, function(key, value) {
                        errorMessage += '<li>' + value + '</li>';
                    });
                    errorMessage += '</ul></div>';
                    $('#message').html(errorMessage);
                }
            });
        });
    });
</script>
</body>
</html>
