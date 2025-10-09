<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Koru-Like OTP</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
      <td align="center" style="padding: 40px 0;">
        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="420" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
          <tr>
            <td align="center" style="padding: 30px;">
              <h2 style="color: #0f172a; margin-bottom: 10px;">🔐 Email Verification</h2>
              <p style="color: #475569; font-size: 15px; line-height: 22px; margin-bottom: 24px;">
                Hello there 👋, <br />
                Use the OTP code below to verify your email address for <strong>Koru-Like</strong>.
              </p>
              <div style="display: inline-block; background-color: #0f172a; color: #ffffff; font-size: 24px; letter-spacing: 6px; padding: 12px 30px; border-radius: 8px; font-weight: bold;">
                {{ $otp }}
              </div>
              <p style="color: #64748b; font-size: 14px; margin-top: 30px;">
                Please do not share it with anyone for security reasons.
              </p>
            </td>
          </tr>
          <tr>
            <td align="center" style="background-color: #f1f5f9; padding: 15px; border-radius: 0 0 10px 10px; font-size: 12px; color: #94a3b8;">
              &copy; {{ date('Y') }} Koru-Like. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>