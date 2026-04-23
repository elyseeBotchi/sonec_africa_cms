<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .content {
            padding: 40px;
        }
        .content h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 22px;
        }
        .content p {
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .credentials {
            background-color: #f9f9f9;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 30px 0;
            border-radius: 4px;
        }
        .credentials-title {
            font-weight: 600;
            color: #667eea;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .credential-item {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }
        .credential-label {
            font-weight: 600;
            color: #333;
            width: 80px;
            font-size: 14px;
        }
        .credential-value {
            color: #555;
            word-break: break-all;
            font-size: 14px;
        }
        .action-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            margin: 30px 0;
            font-weight: 600;
            transition: transform 0.3s ease;
        }
        .action-button:hover {
            transform: translateY(-2px);
        }
        .security-note {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 4px;
            padding: 15px;
            margin-top: 30px;
            font-size: 13px;
            color: #856404;
        }
        .security-note strong {
            display: block;
            margin-bottom: 8px;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #666;
        }
        .footer a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Bienvenue! 🎉</h1>
            <p>Votre compte a été créé avec succès</p>
        </div>

        <div class="content">
            <h2>Bonjour {{ $user['name'] }},</h2>
            
            <p>
                Merci de vous être inscrit sur notre plateforme. Nous sommes heureux de vous compter parmi nos utilisateurs.
            </p>

            <p>
                Ci-dessous, vous trouverez vos informations de connexion. Veuillez les conserver en lieu sûr.
            </p>

            <div class="credentials">
                <div class="credentials-title">📋 Vos identifiants de connexion</div>
                <div class="credential-item">
                    <span class="credential-label">Email:</span>
                    <span class="credential-value">{{ $user['email'] }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Mot de passe:</span>
                    <span class="credential-value">{{ $user['password'] }}</span>
                </div>
            </div>

            <p style="text-align: center;">
                <a href="{{ route('admin.dashboard') ?? '#' }}" class="action-button">Se connecter</a>
            </p>

            <div class="security-note">
                <strong>Recommandations de sécurité:</strong>
                <ul style="margin-left: 20px; margin-top: 8px;">
                    <li>Changez votre mot de passe après votre première connexion</li>
                    <li>Ne partagez jamais vos identifiants avec tiers</li>
                    <li>Utilisez un mot de passe fort et unique</li>
                    <li>Activez l'authentification à deux facteurs si disponible</li>
                </ul>
            </div>

            <p style="margin-top: 30px; font-style: italic; color: #666; font-size: 13px;">
                Si vous n'avez pas créé ce compte, veuillez ignorer cet email ou <a href="mailto:support@example.com" style="color: #667eea;">contacter notre support</a>.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Tous droits réservés. | <a href="#">Politique de confidentialité</a></p>
            <p>Vous avez des questions? <a href="#">Visitez notre aide</a></p>
        </div>
    </div>
</body>
</html>