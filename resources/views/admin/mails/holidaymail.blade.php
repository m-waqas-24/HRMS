<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Holiday Notification</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    p {
      color: #555;
      line-height: 1.6;
    }

    .cta-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007BFF;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1> {{ $data['title'] }} Holiday</h1>
    <p>Dear Employee</p>
    <p>We hope this message finds you well. We want to inform you about the company's holiday schedule.</p>
    <p>Our office will be closed on the following dates: {{ \Carbon\Carbon::parse($data['start_date'])->format('d-F-Y') }} To {{ \Carbon\Carbon::parse($data['end_date'])->format('d-F-Y') }}</p>
    <p>We encourage you to plan your work accordingly and make the necessary arrangements to ensure a smooth workflow during this period.</p>
    <p>Thank you for your understanding, and we wish you a joyful holiday season!</p>
    <p>Best regards, HR<br></p>
  </div>
</body>
</html>
