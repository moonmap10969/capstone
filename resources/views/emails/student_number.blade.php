<div style="font-family: 'Inter', sans-serif; max-width: 600px; margin: 20px auto; padding: 40px; border-radius: 16px; background-color: #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-top: 8px solid #15803d; text-align: center;">
    <div style="background-color: #f0fdf4; width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
        <svg style="width: 40px; height: 40px; color: #15803d;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    </div>
    
    <h2 style="color: #111827; font-size: 28px; margin-bottom: 12px;">Congratulations!</h2>
    <p style="color: #4b5563; font-size: 16px; line-height: 1.6;">Your admission to <strong>FUMCES</strong> has been approved. You can now access the student portal to manage your enrollment and grades.</p>

    <div style="background-color: #f9fafb; border: 1px dashed #d1d5db; border-radius: 12px; padding: 20px; margin: 25px 0; text-align: left;">
        <p style="margin: 5px 0; color: #374151;"><strong>Student Number:</strong> <code style="background: #e5e7eb; padding: 2px 6px; rounded: 4px;">{{ $studentNumber }}</code></p>
        <p style="margin: 5px 0; color: #374151;"><strong>Initial Password:</strong> <code style="background: #e5e7eb; padding: 2px 6px; rounded: 4px;">{{ $studentNumber }}</code></p>
        <p style="margin-top: 10px; font-size: 13px; color: #6b7280; font-style: italic;">Note: You will be required to change your password upon your first login.</p>
    </div>

    <a href="{{ route('login') }}" style="display: inline-block; background-color: #15803d; color: #ffffff; padding: 14px 32px; border-radius: 8px; font-weight: 600; text-decoration: none; transition: background 0.3s ease;">
        Login to Student Portal
    </a>
</div>