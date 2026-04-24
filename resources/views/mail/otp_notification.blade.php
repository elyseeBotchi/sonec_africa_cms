<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"></head>
<body style="margin:0; padding:40px 20px; background:#f4f4f4; font-family:Arial,sans-serif;">
<div style="max-width:600px; margin:auto; background:#fff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">

    <div style="background:#064e3b; padding:28px 40px;">
        <p style="color:rgba(255,255,255,0.6); font-size:11px; letter-spacing:0.1em; margin:0 0 8px; text-transform:uppercase;">SONEC Africa</p>
        <h1 style="color:#fff; font-size:20px; font-weight:400; margin:0;">Connexion au tableau de bord</h1>
    </div>

    <div style="padding:28px 40px 40px; text-align:center;">
        <h1 style="color:#fff; font-size:20px; font-weight:400; margin:0;">Votre code de vérification OTP</h1>

        <p style="color:#0d3136; font-size:16px; margin:16px 0 24px;">Utilisez le code ci-dessous pour vous connecter à votre compte. Ce code est valide pendant 10 minutes.</p>
        <div style="display:inline-block; background:#f9fafb; border:1px solid #e5e7eb; border-radius:8px; padding:12px 24px; font-size:24px; font-weight:600; letter-spacing:0.05em; color:#0d3136;">
            {{ $otpCode }}
        </div>
    </div>   

</div>
</body>
</html>