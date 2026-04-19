<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Message</title>
</head>

<body style="font-family: Arial, sans-serif; background: #f7f7f7; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 10px;">
        <h2>New Contact Message</h2>
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $data['message'] }}</p>
    </div>
</body>

</html>