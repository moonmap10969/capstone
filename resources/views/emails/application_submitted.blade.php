<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333333; line-height: 1.6; }
        .email-wrapper { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { border-bottom: 2px solid #15803d; padding-bottom: 10px; margin-bottom: 30px; }
        .title { color: #15803d; font-size: 22px; font-weight: bold; text-transform: uppercase; margin: 0; }
        .section-title { font-size: 14px; font-weight: bold; color: #15803d; text-transform: uppercase; margin-top: 25px; margin-bottom: 10px; }
        .content { font-size: 16px; margin-bottom: 20px; }
        .data-box { background-color: #f9f9f9; padding: 15px; border: 1px solid #eeeeee; margin: 20px 0; }
        .footer { margin-top: 40px; border-top: 1px solid #dddddd; padding-top: 20px; font-size: 13px; color: #777777; }
        .signature-name { font-weight: bold; color: #333333; margin: 0; }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="header">
            <h1 class="title">FUMCESS ADMISSIONS</h1>
        </div>

        <div class="content">
            <p>Dear <strong>Mr./Mrs. {{ $admission->parentLastName }}</strong>,</p>

            <p>This email confirms that we have successfully received the formal application for <strong>{{ $admission->studentFirstName }} {{ $admission->studentLastName }}</strong>. Our team is currently reviewing the submitted information for the upcoming academic period.</p>

            <div class="data-box">
                <strong>APPLICATION SUMMARY:</strong><br>
                Applicant Name: {{ $admission->studentFirstName }} {{ $admission->studentLastName }}<br>
                Submission Date: {{ date('F d, Y') }}
            </div>

            <h2 class="section-title">Required Next Steps</h2>
            <p>To finalize the enrollment process, please ensure the following actions are completed:</p>
            <ol>
                <li><strong>Document Submission:</strong> Present all original physical copies of the uploaded documents to the Registrar's Office for verification.</li>
                <li><strong>Interview Schedule:</strong> You will receive a separate notification regarding the scheduled interview with our Department Head.</li>
                <li><strong>Financial Clearance:</strong> Proceed to the Accounting Office for the settlement of necessary school fees once documents are verified.</li>
            </ol>

            <p>If you have any immediate questions regarding this application, please contact our office directly at <strong>(0912) 345 6789</strong> or reply to this email.</p>
        </div>

        <div class="footer">
            <p class="signature-name">Office of the Admissions</p>
            <p style="margin: 0;">FUMCESS Institutional Management</p>
            <p style="margin: 0;">Main Campus | Admissions Department</p>
            <p style="margin-top: 15px; font-style: italic;">This is an official communication. Please retain a copy for your records.</p>
        </div>
    </div>
</body>
</html>