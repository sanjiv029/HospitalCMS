<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .details {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 5px 0;
        }
        p {
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Hello {{ $patient->name }}</h1>
    <p>Your appointment has been confirmed!</p>
    <p>Details:</p>

    <div class="details">
        <ul>
            <li>Doctor: {{ $appointment->doctor->name }}</li>
            <li>Day: {{ $appointment->day }}</li>
            <li>Time: {{\Carbon\Carbon::parse($appointment->time_slot)->format('g:i A')}}</li>
            <li>Department: {{ $appointment->department->name }}</li>
        </ul>
    </div>

    <p>If you have any questions or need to reschedule, please contact us at support@example.com.</p>
    <p>Thank you!</p>
</body>
</html>
