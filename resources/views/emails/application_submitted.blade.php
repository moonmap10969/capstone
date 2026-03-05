<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; color: #1a1a1a; line-height: 1.6; font-size: 15px; margin: 0; padding: 0; background-color: #ffffff; }
        .container { max-width: 600px; margin: 40px auto; padding: 0 20px; }
        .title { color: #057E2E; font-size: 16px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 40px; }
        .content { margin-bottom: 40px; }
        .summary { margin: 25px 0; font-weight: normal; }
        .footer { margin-top: 50px; font-size: 11px; color: #777777; font-style: italic; }
        .signature { font-weight: bold; color: #1a1a1a; margin-top: 40px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">FUMCES Enrollment Update</div>
        
        <div class="content">
            <p>Dear {{ $studentName }},</p>
            
            <p>{{ $customMessage }}</p>
            
            <div class="summary">
                <strong>Automated Alert Summary:</strong><br>
                Student Name: {{ $studentName }}<br>
                Notification Date: {{ date('F d, Y') }}
            </div>
            
            <p>If you have any immediate questions regarding your enrollment status, please contact our office directly at (0912) 345 6789 or reply to this email.</p>
        </div>
        
        <div class="signature">
            Office of the Registrar<br>
            <span style="font-weight: normal;">First United Methodist Church Ecumenical School</span>
        </div>
        
        <div class="footer">
            This is an automated communication from the institutional management system. Please retain a copy for your records.
        </div>
    </div>
</body>
</html>