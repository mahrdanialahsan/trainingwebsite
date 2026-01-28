<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2e3a47;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .booking-details {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #2e3a47;
        }
        .detail-row {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #2e3a47;
            display: inline-block;
            width: 150px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2e3a47;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Booking Confirmed!</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $booking->first_name }},</p>
        
        <p>Thank you for your booking! We're excited to have you join us for <strong>{{ $booking->course->title }}</strong>.</p>
        
        <div class="booking-details">
            <h2 style="color: #2e3a47; margin-top: 0;">Booking Details</h2>
            
            <div class="detail-row">
                <span class="detail-label">Booking ID:</span>
                <span>#{{ $booking->uid ?? $booking->id }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Course:</span>
                <span>{{ $booking->course->title }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Date:</span>
                <span>{{ $booking->course->date->format('F d, Y') }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Time:</span>
                <span>{{ $booking->course->start_time->format('g:i A') }} - {{ $booking->course->end_time->format('g:i A') }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Attendee:</span>
                <span>{{ $booking->full_name }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span>{{ $booking->email }}</span>
            </div>
            
            @if($booking->phone)
            <div class="detail-row">
                <span class="detail-label">Phone:</span>
                <span>{{ $booking->phone }}</span>
            </div>
            @endif
            
            @if($booking->payment)
            <div class="detail-row">
                <span class="detail-label">Transaction ID:</span>
                <span>{{ $booking->payment->transaction_id }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Amount Paid:</span>
                <span>${{ number_format($booking->payment->amount, 2) }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Payment Method:</span>
                <span>{{ ucfirst($booking->payment->payment_method) }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Payment Date:</span>
                <span>{{ $booking->payment->paid_at->format('F d, Y g:i A') }}</span>
            </div>
            @endif
            
            @if($booking->notes)
            <div class="detail-row">
                <span class="detail-label">Notes:</span>
                <span>{{ $booking->notes }}</span>
            </div>
            @endif
        </div>
        
        <p>We look forward to seeing you at the training. If you have any questions or need to make changes to your booking, please don't hesitate to contact us.</p>
        
        <p style="margin-top: 30px;">
            <a href="{{ route('dashboard', ['tab' => 'bookings']) }}" class="button">View My Bookings</a>
        </p>
    </div>
    
    <div class="footer">
        <p>Thank you for choosing Texas Training Group!</p>
        <p>This is an automated email. Please do not reply to this message.</p>
    </div>
</body>
</html>
