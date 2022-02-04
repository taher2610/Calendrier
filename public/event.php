<?php 
        require '../src/Calendar/bootstrap.php';
        require '../src/Calendar/events.php';
        
        $pdo=get_pdo();
        $events=new Calendar\events($pdo);
        if(!isset($_GET['id'])){
            header('Location: 404.php');
        }
        try{
        $event=$events->find($_GET['id']);
        }catch(\Exception $e){
            e404();
        }
        require '../views/header.php';
    ?>
    
    <h1><?= h($event['name']);?></h1>
<ul>
    <li>Date : <?= (new DateTime($event['start']))->format('d/m/Y');  ?></li>
    <li>Heure de démarrage : <?= (new DateTime($event['start']))->format('H:i'); ?></li>
    <li>Heure de fin :<?= (new DateTime($event['end']))->format('H:i');  ?></li>
    <li>Description :<br> <?= h($event['description']);  ?></li>


</ul>
    
<?php require '../views/footer.php'; ?>
    
