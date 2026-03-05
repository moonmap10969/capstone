<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: 'Times New Roman', Times, serif; color: #000000; line-height: 1.5; font-size: 16px; margin: 0; padding: 0; background-color: #ffffff;">
    <div style="max-width: 650px; margin: 40px auto; padding: 0 20px;">
        
        <div style="text-align: center; border-bottom: 2px solid #000000; padding-bottom: 20px; margin-bottom: 30px;">
            <img src="{{ $message->embed(public_path('images/fumces_logo.jpg')) }}" alt="FUMCES Logo" style="max-width: 100px; height: auto; margin-bottom: 15px;">
            <div style="font-size: 20px; font-weight: bold; text-transform: uppercase;">First United Methodist Church Ecumenical School</div>
            <div style="font-size: 16px; margin-top: 5px;">Office of the Registrar</div>
        </div>
        
        <div style="text-align: left;">
            <p>Dear {{ $studentName }},</p>
            
            <p>{{ $customMessage }}</p>
            
            <div style="margin: 25px 0; padding-left: 15px; border-left: 3px solid #000000;">
                <strong>Automated Alert Summary:</strong><br>
                Student Name: {{ $studentName }}<br>
                Notification Date: {{ date('F d, Y') }}
            </div>
            
            <p>If you have any immediate questions regarding your enrollment status, please contact our office directly at (0912) 345 6789 or reply to this email.</p>
        </div>
        
        <div style="margin-top: 50px;">
            Sincerely,<br><br>
            <strong>Office of the Registrar</strong><br>
            FUMCES Institutional Management
        </div>
        
        <div style="margin-top: 50px; font-size: 12px; color: #666666; text-align: center; font-style: italic;">
            This is an official automated communication from the FumiSys platform. Please retain a copy for your records.
        </div>
        
    </div>
</body>
</html>