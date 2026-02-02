<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submission Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #1a202c; margin: 0; padding: 0; background-color: #f5f6f1;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; padding: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
                    <tr>
                        <td>
                            <h2 style="margin-top: 0;">Dear Mr./Mrs. {{ $admission->parent_last_name }},</h2>

                            <p>We sincerely appreciate your submission of your child's application to <strong>FUMCES</strong>.</p>

                            <p><strong>Application ID:</strong> {{ $admission->application_id }}</p>

                            <p>Your application will be carefully reviewed, and you will be notified once the evaluation process is complete.</p>

                            <p>To proceed, please upload the required documents by clicking the button below:</p>

                            <p style="text-align: center; margin: 30px 0;">
                                <a href="{{ route('student.admissions.documents') }}" style="
                                    display: inline-block;
                                    padding: 14px 28px;
                                    font-size: 16px;
                                    color: #ffffff;
                                    background-color: #2f855a;
                                    text-decoration: none;
                                    border-radius: 6px;
                                    font-weight: bold;
                                ">Upload Documents</a>
                            </p>

                            <p>Thank you for your trust and interest in <strong>FUMCES</strong>.</p>

                            <!-- Signature Section -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 40px;">
                                <tr>
                                    <td style="padding-top: 20px; border-top: 1px solid #e2e8f0; text-align: left;">
                                        <!-- Handwritten Signature Image -->
                                        <img src="{{ asset('images/signature.png') }}" alt="Admissions Signature" style="height: 60px; display: block; margin-bottom: 8px;">

                                        <p style="margin: 0; font-weight: bold;">FUMCES Admissions Team</p>
                                        <p style="margin: 4px 0 0 0; font-size: 14px; color: #718096;">
                                            First United Methodist Church Ecumenical School Inc.<br>
                                            123 FUMCES Street, City, State ZIP<br>
                                            Phone: (0912) 345 6789 | Email: <a href="mailto:admissions@fumces.edu.ph" style="color: #2f855a; text-decoration: none;">admissions@fumces.edu.ph</a>
                                        </p>
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
