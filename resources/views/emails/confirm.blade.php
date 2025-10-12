<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donation Confirmation - Koru</title>
</head>
<body style="margin:0; padding:0; background-color:#f8fafc; font-family:'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f8fafc; padding:40px 0;">
    <tr>
      <td align="center">
        <table width="480" cellpadding="0" cellspacing="0" border="0" style="background-color:#ffffff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.05); overflow:hidden;">
          <tr>
            <td align="center" style="background-color:#0f172a; padding:25px;">
              <h2 style="color:#ffffff; margin:0;">Koru</h2>
              <p style="color:#94a3b8; margin:4px 0 0; font-size:14px;">Donation Confirmation</p>
            </td>
          </tr>

          <tr>
            <td style="padding:30px;">
                <p style="font-size:15px; color:#334155; margin:0 0 15px;">
                Dear {{ $donation->name }},
                </p>

                <p style="font-size:15px; color:#334155; line-height:22px; margin:0 0 20px;">
                We're happy to let you know that your recent donation 
                @if(isset($donation->type) && $donation->type && $donation->type->project) 
                  for <strong>{{ $donation->type->project }}</strong> 
                @endif 
                has been <strong>verified and confirmed</strong> on the TRON blockchain!
                </p>

              <table width="100%" cellpadding="8" cellspacing="0" style="background-color:#f1f5f9; border-radius:8px; margin-bottom:20px;">
                <tr>
                  <td align="center" style="font-size:18px; font-weight:bold; color:#0f172a;">
                    Donation Amount: <span style="color:#16a34a;">${{ number_format($donation->amount, 2) }} USDT</span>
                  </td>
                </tr>
              </table>

              <table width="100%" cellpadding="4" cellspacing="0" style="margin-bottom:20px;">
                <tr>
                  <td style="font-size:13px; color:#64748b; padding:5px 0;">
                    <strong>Transaction Hash:</strong>
                  </td>
                </tr>
                <tr>
                  <td style="font-size:11px; color:#94a3b8; word-break:break-all; padding:5px 0;">
                    {{ $donation->transaction_hash ?? 'N/A' }}
                  </td>
                </tr>
                <tr>
                  <td style="font-size:13px; color:#64748b; padding:5px 0;">
                    <strong>Confirmation Date:</strong>
                  </td>
                </tr>
                <tr>
                  <td style="font-size:13px; color:#334155; padding:5px 0;">
                    {{ $donation->confirmed_at ? $donation->confirmed_at->format('F d, Y - H:i:s') : now()->format('F d, Y - H:i:s') }}
                  </td>
                </tr>
              </table>

              <p style="font-size:15px; color:#334155; margin:0 0 20px;">
                Thank you for your generous support — every contribution makes a real difference in our mission.
              </p>

              @if($donation->message)
              <div style="background-color:#f1f5f9; padding:15px; border-radius:8px; margin-bottom:20px;">
                <p style="font-size:13px; color:#64748b; margin:0 0 5px;"><strong>Your Message:</strong></p>
                <p style="font-size:13px; color:#334155; margin:0; font-style:italic;">"{{ $donation->message }}"</p>
              </div>
              @endif

              <p style="font-size:14px; color:#64748b; margin:0;">
                You can visit our website anytime to see how your donations are helping build the future.
              </p>
            </td>
          </tr>

          <tr>
            <td align="center" style="background-color:#f1f5f9; padding:15px; font-size:12px; color:#94a3b8;">
              &copy; {{ date('Y') }} Koru. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>