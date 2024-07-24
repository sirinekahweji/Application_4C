<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat</title>
    <style>
        /* Styles CSS en ligne pour assurer une bonne présentation dans les clients de messagerie */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .certificat {
            margin-bottom: 20px;
        }
        .certificat .header {
            margin-bottom: 10px;
        }
        .certificat .header h1 {
            color: #333;
            font-size: 24px;
            margin: 0;
        }
        .certificat .header .subtitle {
            color: #888;
            font-size: 14px;
            margin-top: 5px;
        }
        .certificat .details {
            margin-bottom: 20px;
        }
        .certificat .details p {
            margin: 0;
            line-height: 1.5;
        }
        .certificat .image img {
            max-width: 100%;
            margin-bottom: 20px;
        }
        .certificat .actions {
            margin-top: 10px;
        }
        .certificat .actions a {
            margin-right: 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
        .certificat .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="certificat">
            <div class="header">
                <h1>Certificat de {{ $certif->nom }}</h1>
                <div class="subtitle">{{ $certif->organisation }}</div>
            </div>
            <div class="details">
                <p>Lieu: {{ $certif->lieu }}</p>
                <p>Date: {{ $certif->date }}</p>
                <p>Capacité: {{ $certif->capacite }}</p>
                <!-- Ajoutez d'autres détails du certificat ici -->
            </div>
            <div class="image">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5uoCTwDY557z4hT0K_pIY0gA3LyeNEprGmASpFupdXA&s" alt="Affiche du certificat">
            </div>
            <div class="actions">
                <a href="#" target="_blank">Voir le certificat</a>
                <!-- Ajoutez d'autres actions ici -->
            </div>
        </div>
    </div>
</body>
</html>
