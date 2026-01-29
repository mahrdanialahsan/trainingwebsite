<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Consultation Request</title>
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
                            <h1 style="margin: 0 0 20px 0; color: #1a1a1a; font-size: 24px; font-weight: bold;">New Consultation Request</h1>
                            
                            <p style="margin: 0 0 20px 0; color: #333333; font-size: 16px; line-height: 1.6;">
                                You have received a new consultation request from the Consulting page on your website.
                            </p>
                            
                            <div style="background-color: #f9f9f9; padding: 20px; margin: 20px 0; border-left: 4px solid #1a1a1a;">
                                <table role="presentation" style="width: 100%; border-collapse: collapse;">
                                    <tr>
                                        <td style="padding: 8px 0; font-weight: bold; color: #1a1a1a; width: 150px;">Name:</td>
                                        <td style="padding: 8px 0; color: #333333;">{{ $name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px 0; font-weight: bold; color: #1a1a1a;">Email:</td>
                                        <td style="padding: 8px 0; color: #333333;">
                                            <a href="mailto:{{ $email }}" style="color: #1a1a1a; text-decoration: underline;">{{ $email }}</a>
                                        </td>
                                    </tr>
                                    @if($company)
                                    <tr>
                                        <td style="padding: 8px 0; font-weight: bold; color: #1a1a1a;">Company:</td>
                                        <td style="padding: 8px 0; color: #333333;">{{ $company }}</td>
                                    </tr>
                                    @endif
                                    @if($phone)
                                    <tr>
                                        <td style="padding: 8px 0; font-weight: bold; color: #1a1a1a;">Phone:</td>
                                        <td style="padding: 8px 0; color: #333333;">
                                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $phone) }}" style="color: #1a1a1a; text-decoration: underline;">{{ $phone }}</a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if($serviceInterest)
                                    <tr>
                                        <td style="padding: 8px 0; font-weight: bold; color: #1a1a1a;">Service Interest:</td>
                                        <td style="padding: 8px 0; color: #333333;">{{ $serviceInterest }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            
                            <div style="margin: 20px 0;">
                                <h2 style="margin: 0 0 10px 0; color: #1a1a1a; font-size: 18px; font-weight: bold;">Message:</h2>
                                <div style="background-color: #ffffff; padding: 15px; border: 1px solid #e0e0e0; color: #333333; line-height: 1.6; white-space: pre-wrap;">{{ $messageText }}</div>
                            </div>
                            
                            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
                                <p style="margin: 0; color: #666666; font-size: 14px;">
                                    You can reply directly to this email to respond to {{ $name }} at <a href="mailto:{{ $email }}" style="color: #1a1a1a; text-decoration: underline;">{{ $email }}</a>
                                </p>
                            </div>
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
