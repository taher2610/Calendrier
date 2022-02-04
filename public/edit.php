<?php 
        require '../src/Calendar/bootstrap.php';
        
        $pdo=get_pdo();
        $events=new Calendar\events($pdo);
        $errors=[];
        if(!isset($_GET['id'])){
            e404();
        }
        try{
        $event=$events->find($_GET['id']);
        }catch(\Exception $e){
            e404();
        }
        $data = [
            'name'           => $event->getName(),
            'date'           => $event->getStart()->format('Y-m-d'),
            'start'          => $event->getStart()->format('H:i'),
            'end'            => $event->getEnd()->format('H:i'),
            'description'    => $event->getDescription();
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data=$_POST;
            $errors=[];
            $validator = new Calendar\EventValidator();
            $errors = $validator->validates($_POST);
            if (empty($errors)){
                $event = new \Calendar\Event();
                $events->hydrate($event,$data);
                $events->update($event);
                header('Location: /index?succes=1');
                exit();
            }

        render('header',['title'=>$event->getName()]);
    ?>
    
    <div class="container">
    <h1>Editer l'évènement<small><?= h($event['name']);?></small></h1>
    <form action="" method="post" class="form">
    <?php render('calendar/form',['data'=>$data,'errors'=>$errors]); ?>

        <div class="form-group">
            <button class="btn btn-primary">Modifierl'évènement</button>
        </div>
    </form>
    </div>
  <?php render('footer') ; ?>
    
   
    
<?php require '../views/footer.php'; ?>
    