<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/calendar.css">
    <title><?= isset($title) ? h($title) :'Mon calendrier' ; ?></title>
    </head>
    <body>
    <nav class="navbar navbar-dark bg-primary mb-3">
    <a href="/index.php" class="navbar-brand">Mon calendrier</a>
    </nav>
</body>
</html>