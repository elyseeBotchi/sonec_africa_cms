<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: auto; padding: 20px;">

    <h2 style="color: #16a34a;">Merci pour votre candidature, {{ $candidate->prenom }} !</h2>
    <hr>

    <p>Nous avons bien reçu votre candidature spontanée et nous vous en remercions.</p>
    <p>Votre profil sera ajouté à notre vivier de talents.</p>

    <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; padding:16px; margin:24px 0;">
        <p style="margin:0;"><strong>Récapitulatif :</strong></p>
        <p style="margin:4px 0;">Nom : {{ $candidate->prenom }} {{ $candidate->nom }}</p>
        <p style="margin:4px 0;">Email : {{ $candidate->email }}</p>
    </div>

    <p>Cordialement,<br><strong>L'équipe SONEC Africa</strong></p>
    <hr>
    <p style="font-size:12px; color:#999;">SONEC Africa</p>

</body>
</html>