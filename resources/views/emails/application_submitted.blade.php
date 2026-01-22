<div style="font-family: sans-serif; background-color: #f7fafc; padding: 40px; text-align: center;">
    <div style="max-width: 500px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 20px; shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h1 style="color: #2f855a; font-size: 24px; margin-bottom: 10px;">🎉 Congratulations!</h1>
        <p style="color: #4a5568; line-height: 1.6;">We are pleased to inform you that your application to <strong>FUMCES</strong> has been approved.</p>
        
        <div style="background-color: #f0fff4; border: 1px dashed #68d391; padding: 15px; border-radius: 12px; margin: 20px 0;">
            <p style="margin: 0; color: #276749; font-size: 14px;">Your Official Student Number</p>
            <strong style="font-size: 22px; color: #2f855a;">{{ $admission->student_number }}</strong>
        </div>

        <p style="color: #718096; font-size: 14px; margin-bottom: 25px;">You may now access the Student Portal to view your schedule and records.</p>
        
        <a href="{{ route('login') }}" style="display: inline-block; padding: 14px 30px; color: #ffffff; background-color: #2f855a; text-decoration: none; border-radius: 50px; font-weight: bold;">
            Access Student Portal
        </a>
    </div>
</div>