<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;line-height:1.6;color:#1f2937;background:#f3f4f6;margin:0;padding:0}.wrapper{padding:40px 20px}.card{max-width:560px;margin:0 auto;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08)}.header{background:#059669;padding:32px;text-align:center}.header h1{color:#fff;font-size:24px;margin:0;font-weight:700}.body{padding:32px}.body p{font-size:15px;margin:0 0 16px;color:#4b5563}.badge{display:inline-block;background#ecfdf5;color:#059669;padding:8px 20px;border-radius:40px;font-size:13px;font-weight:600;margin:8px 0 16px}.details{background:#f9fafb;border-radius:12px;padding:20px;margin:20px 0}.details table{width:100%}.details td{padding:6px 0;font-size:14px}.details td:first-child{color:#6b7280;width:40%}.details td:last-child{font-weight:600;color:#1f2937}.btn{display:inline-block;background:#059669;color:#fff;padding:12px 32px;border-radius:40px;text-decoration:none;font-weight:600;font-size:14px;margin-top:8px}.footer{text-align:center;padding:24px 32px;border-top:1px solid #e5e7eb;font-size:12px;color:#9ca3af}</style></head>
<body><div class="wrapper"><div class="card">
<div class="header"><h1>Payment Approved! &#10003;</h1></div>
<div class="body">
<p>Dear <strong>{{ $verification->customer_name ?? 'Valued Customer' }}</strong>,</p>
<p>Your payment verification has been <strong style="color:#059669;">approved</strong> and your account is now active.</p>
<div class="badge">Order: {{ $verification->order?->order_number ?? $verification->payment?->order?->order_number ?? 'N/A' }}</div>
<div class="details"><table>
<tr><td>Transaction Ref</td><td>{{ $verification->transaction_reference ?? 'N/A' }}</td></tr>
<tr><td>Bank / Method</td><td>{{ $verification->bank_name ?? 'N/A' }}</td></tr>
<tr><td>Amount</td><td>{{ $verification->order?->formatted_amount ?? $verification->payment?->order?->formatted_amount ?? 'N/A' }}</td></tr>
<tr><td>Status</td><td style="color:#059669;">Approved</td></tr>
</table></div>
<p>Thank you for choosing our services. You can now log in and start using your account.</p>
<p style="margin-top:24px"><a href="{{ url('/dashboard') }}" class="btn">Go to Dashboard</a></p>
</div>
<div class="footer"><p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p></div>
</div></div></body>
</html>