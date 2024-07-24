<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau Mot de Passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007BFF;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nouveau Mot de Passe</h1>
        <p>Bonjour,</p>
        <p>Votre demande de réinitialisation de mot de passe a été traitée avec succès. Voici votre nouveau mot de passe :</p>
        <p><strong>Mot de passe:</strong> {{$newPassword}}</p>
        <p>Nous vous recommandons de changer ce mot de passe dès que possible après votre prochaine connexion.</p>
        <p>Merci,</p>
        <p>L'équipe de 4C Iset Bizerte</p>
    </div>
</body>
</html>
