<?php
//namespace App;
require '../src/Calendar/bootstrap.php';
//require '../src/App/Validator.php';
require '../src/Calendar/EventValidator.php';
//require '../src/Calendar/Event.php';
require '../src/Calendar/events.php';



$data=[
    'date'=>$_GET['date']?? date ('Y-m-d'),
    'start'=>date('H:i'),
    'end'=>date('H:i')
];
$validator=new \App\Validator($data);
if(!$validator->validate('date','date')){
$data['date']=date('Y-m-d');
}
$errors=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data=$_POST;
  
    $validator = new App\EventValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)){
       
        $event = new \App\Event();
        $events = new App\Events(get_pdo());
        $event = $events->hydrate(new \App\Event(),$data);
        
        $events->create($event);
        header('Location: /index?succes=1');
        exit();
    }
}
render('header',['title'=>'Ajouter un évènement']);
?>
 
 

<div class="container">
<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    Merci de corrigés vos erreurs
</div>
 <?php endif; ?>  

<h1>Ajouter un évènement</h1>
<form action="" method="post" class="form">
        <?php render('calendar/form',['data'=>$data,'errors'=>$errors]); ?>
        
        <div class="form-group">
            <br>
            <button class="btn btn-primary">Ajouter l'évènement</button>
        </div>
   

</div>
