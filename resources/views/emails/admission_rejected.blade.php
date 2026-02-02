<div style="background-color: #f9f9f9; padding: 40px 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #eee;">
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ $message->embed(public_path('images/fumces_logo.jpg')) }}" alt="School Logo" style="width: 120px;">
        </div>
        
        <h2 style="color: #2c3e50; text-align: center; font-weight: 300; border-bottom: 1px solid #eee; padding-bottom: 20px;">Admission Status Update</h2>
        
        <div style="color: #555; font-size: 16px; line-height: 1.8;">
            <p>Thank you for giving us the opportunity to review your application. After a thorough evaluation by our admissions committee, we regret to inform you that we are unable to offer you a placement at this time.</p>
            <p>This decision does not reflect your potential, and we truly appreciate the interest you have shown in our institution. We wish you the very best in your future academic pursuits.</p>
            
            <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 6px; text-align: center;">
                <p style="margin-bottom: 15px; font-size: 14px;">If you have any questions or require further information regarding this decision, our team is here to help.</p>
                <a href="{{ url('/contact') }}" style="background-color: #3498db; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Contact Us</a>
            </div>
        </div>
    </div>
</div>