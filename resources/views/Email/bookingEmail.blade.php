<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Hello {{ $MailMessage['user'] }},</h2>
    <p>Your booking has been confirmed with the following details:</p>

    <h3>Doctor Details:</h3>
    <ul>
        <li><strong>Name:</strong>{{ $MailMessage['doctorName'] }}</li>
        <li><strong>Specialization:</strong> {{ $MailMessage['specialization'] }}</li>
        <li><strong>Consultation Fee:</strong> ${{ $MailMessage['price'] }}</li>
        <li><strong>Country:</strong> {{ $MailMessage['country'] }}</li>
    </ul>

    <h3>Appointment Details:</h3>
    <ul>
        <li><strong>Date:</strong> {{ $MailMessage['slotDate'] }}</li>
    </ul>

    <p>Thank you for booking with us!</p>
</body>
</html>
