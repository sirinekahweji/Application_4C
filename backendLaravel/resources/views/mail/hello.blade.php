<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Publication</title>
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
        .post {
            margin-bottom: 20px;
        }
        .post .header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .post .author {
            font-weight: bold;
            margin-right: 10px;
        }
        .post .timestamp {
            color: #888;
            font-size: 12px;
        }
        .post .content {
            margin-bottom: 10px;
            line-height: 1.5;
        }
        .post .image {
            margin-bottom: 10px;
        }
        .post .actions {
            margin-top: 10px;
        }
        .post .actions a {
            margin-right: 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
        .post .actions a:hover {
            text-decoration: underline;
        }
        .post .actions a.like {
            color: #4267B2; /* Facebook Blue */
        }
        .post .actions a.comment {
            color: #777;
        }
        .post .actions a.share {
            color: #4caf50; /* Material Green */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="post">
            <div class="header">
                <div class="author">John Doe</div>
                <div class="timestamp">Il y a 1 heure</div>
            </div>
            <div class="content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </div>
            <div class="image">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5uoCTwDY557z4hT0K_pIY0gA3LyeNEprGmASpFupdXA&s" alt="Image de la publication" style="max-width: 100%;">
            </div>
            <div class="actions">
                <a href="#" class="like">J'aime</a>
                <a href="#" class="comment">Commenter</a>
                <a href="#" class="share">Partager</a>
            </div>
        </div>
    </div>
</body>
</html>
