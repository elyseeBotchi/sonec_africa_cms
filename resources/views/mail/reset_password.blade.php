<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px;
            color: #333333;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin: 15px 0;
        }
        .password-box {
            background-color: #f9f9f9;
            border: 2px solid #007bff;
            border-radius: 5px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }
        .password-label {
            font-size: 14px;
            color: #666666;
            margin-bottom: 10px;
        }
        .password-value {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            letter-spacing: 2px;
            font-family: 'Courier New', monospace;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
            font-size: 14px;
            color: #856404;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #999999;
            border-top: 1px solid #eeeeee;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Réinitialisation de mot de passe</h1>
        </div>
        
        <div class="content">
            <p>Bonjour {{ $data['name'] }},</p>
            
            <p>Vous avez demandé une réinitialisation de mot de passe pour votre compte. Voici votre nouveau mot de passe :</p>
            
            <div class="password-box">
                <div class="password-label">Votre nouveau mot de passe :</div>
                <div class="password-value">{{ $data['password'] }}</div>
            </div>
            
            <div class="warning">
                <strong>⚠️ Important :</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Conservez ce mot de passe dans un endroit sûr</li>
                    <li>Ne le partagez avec personne</li>
                    <li>Connectez-vous dès que possible et changez-le par un mot de passe personnel</li>
                </ul>
            </div>
            
            <p>Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email et contacter notre support immédiatement.</p>
            
            <p>
                <a href="{{ route('admin.dashboard') }}" class="button">Se connecter</a>
            </p>
        </div>
        
        <div class="footer">
            <p>© {{ now()->year }} {{ config('app.name') }}. Tous droits réservés.</p>
            <p>Si vous avez besoin d'aide, <a href="{{ route('web.contact') }}" style="color: #007bff; text-decoration: none;">contactez-nous</a></p>
        </div>
    </div>
</body>
</html>