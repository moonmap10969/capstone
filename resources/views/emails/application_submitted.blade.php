<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media screen and (max-width: 600px) {
            .container { padding: 20px !important; }
            .content { padding: 20px !important; }
        }
    </style>
</head>
<body style="font-family: 'Helvetica Neue', Arial, sans-serif; line-height: 1.6; color: #2d3748; margin: 0; padding: 0; background-color: #f7fafc;">
    <table width="100%" cellpadding="0" cellspacing="0" class="container" style="padding: 30px 0;">
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="background-color: #2f855a; padding: 20px; text-align: center;">
                        </td>
                    </tr>
                    <tr>
                        <td class="content" style="padding: 40px;">
                            <h2 style="margin-top: 0; color: #2f855a; font-size: 24px;">Application Received!</h2>
                            <p>Dear Mr./Mrs. <strong>{{ $admission->parentLastName }}</strong>,</p>
                            <p>We received the application for <strong>{{ $admission->studentFirstName }} {{ $admission->studentLastName }}</strong>.</p>
                            <div style="background-color: #f0fff4; border-left: 4px solid #48bb78; padding: 20px; margin: 25px 0;">
                                <p style="margin: 0; font-weight: bold; color: #276749;">Next Steps:</p>
                                <ul style="margin: 10px 0 0 0; padding-left: 20px; color: #2f855a;">
                                    <li>Submit physical documents on-site</li>
                                    <li>Participate in an interview</li>
                                    <li>Settle school fees at Accounting</li>
                                </ul>
                            </div>
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 40px; border-top: 1px solid #edf2f7;">
                                <tr>
                                    <td style="padding-top: 25px;">
                                        <p style="margin: 0; font-weight: bold;">FUMCES Admissions Team</p>
                                        <p style="margin: 5px 0 0 0; font-size: 13px; color: #718096;">Phone: (0912) 345 6789</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>