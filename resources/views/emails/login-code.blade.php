<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SaveUp Login Code</title>
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:Arial,sans-serif;">
    <div style="max-width:600px;margin:40px auto;background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 10px 30px rgba(15,23,42,0.08);">
        <div style="background:linear-gradient(135deg,#1d4ed8,#38bdf8);padding:32px;color:#ffffff;text-align:center;">
            <h1 style="margin:0;font-size:30px;">SaveUp</h1>
            <p style="margin:10px 0 0;font-size:16px;opacity:.95;">Your login verification code</p>
        </div>

        <div style="padding:36px;text-align:center;color:#0f172a;">
            <p style="font-size:18px;margin:0 0 18px;">Hello {{ $name }},</p>
            <p style="font-size:16px;color:#475569;margin:0 0 24px;">
                Use the code below to finish signing in to your account.
            </p>

            <div style="display:inline-block;padding:18px 28px;background:#eff6ff;border:2px dashed #2563eb;border-radius:16px;font-size:36px;font-weight:800;letter-spacing:10px;color:#1d4ed8;">
                {{ $code }}
            </div>

            <p style="margin:24px 0 0;font-size:14px;color:#64748b;">
                This code expires in 10 minutes.
            </p>
        </div>
    </div>
</body>
</html>