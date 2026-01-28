<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 20px 0; text-align: center; background-color: #1a1a1a;">
                <img src="{{ asset('Logo.png') }}" alt="Texas Training Group" style="height: 50px;">
            </td>
        </tr>
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-collapse: collapse; border: 1px solid #e0e0e0;">
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h1 style="margin: 0 0 20px 0; color: #1a1a1a; font-size: 24px; font-weight: bold;">Reset Your Password</h1>
                            
                            <p style="margin: 0 0 20px 0; color: #333333; font-size: 16px; line-height: 1.6;">
                                Hello {{ $user->name }},
                            </p>
                            
                            <p style="margin: 0 0 20px 0; color: #333333; font-size: 16px; line-height: 1.6;">
                                We received a request to reset your password for your account. If you made this request, please click the button below to reset your password:
                            </p>
                            
                            <table role="presentation" style="margin: 30px 0; width: 100%;">
                                <tr>
                                    <td style="text-align: center;">
                                        <a href="{{ $resetLink }}" style="display: inline-block; padding: 12px 30px; background-color: #1a1a1a; color: #ffffff; text-decoration: none; font-weight: bold; border-radius: 0;">Reset Password</a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="margin: 20px 0 0 0; color: #666666; font-size: 14px; line-height: 1.6;">
                                Or copy and paste this link into your browser:
                            </p>
                            <p style="margin: 10px 0 20px 0; color: #1a1a1a; font-size: 14px; word-break: break-all;">
                                <a href="{{ $resetLink }}" style="color: #1a1a1a; text-decoration: underline;">{{ $resetLink }}</a>
                            </p>
                            
                            <p style="margin: 20px 0 0 0; color: #666666; font-size: 14px; line-height: 1.6;">
                                This password reset link will expire in 24 hours.
                            </p>
                            
                            <p style="margin: 20px 0 0 0; color: #666666; font-size: 14px; line-height: 1.6;">
                                If you did not request a password reset, please ignore this email. Your password will remain unchanged.
                            </p>
                            
                            <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;">
                            
                            <p style="margin: 0; color: #999999; font-size: 12px; line-height: 1.6;">
                                If you're having trouble clicking the button, copy and paste the URL above into your web browser.
                            </p>
                        </td>
                    </tr>
                </table>
                
                <table role="presentation" style="max-width: 600px; margin: 20px auto 0; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 20px 30px; text-align: center;">
                            <p style="margin: 0; color: #999999; font-size: 12px;">
                                © {{ date('Y') }} Texas Training Group. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
