<?php
require '../src/bootstrap.php';

$data=[
    'date'=>$_GET['date']?? date ('Y-m-d')
];
$validator=new \App\Validator($data);
if(!$validator->validate('date','date')){
$data['date']=date('Y-m-d');
}
$errors=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data=$_POST;
  
    $validator = new Calendar\EventValidator();
    $errors = $validator->validates($_POST);
    if (empty($errors)){
        $event = $events->hydrate(new \Calendar\Event(),$data);
       
        $events = new\Calendar\Events(get_pdo());
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

   
</form>
</div>
<?php render('footer');  ?>