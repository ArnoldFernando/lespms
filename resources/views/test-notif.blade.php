<!DOCTYPE html>
<html>

<head>
    <title>Booking Notification</title>
</head>

<body>
    <h1>New Booking!</h1>
    <p><strong>Customer Name:</strong> {{ $booking['name'] }}</p>
    <p><strong>Customer Email:</strong> {{ $booking['email'] }}</p>
    <p><strong>Service Booked:</strong> {{ $booking['service'] }}</p>
    <p><strong>Booking Date:</strong> {{ $booking['date'] }}</p>
    @if (!empty($booking['notes']))
        <p><strong>Notes:</strong> {{ $booking['notes'] }}</p>
    @endif

</body>

</html>
