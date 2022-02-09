<?php 
        require '../src/Calendar/bootstrap.php';
        require '../src/Calendar/events.php';
        require '../src/Calendar/EventValidator.php';
        
        $pdo = pdo_connect_mysql();
        $events=new App\events($pdo);
        $errors=[];
        
        try{
        $event=$events->find($_GET['id']?? null);
        
        }catch(\Exception $e){
            e404();
        }
        $data = [
            'name'           => $event->getName(),
            'date'           => $event->getStart()->format('Y-m-d'),
            'start'          => $event->getStart()->format('H:i'),
            'end'            => $event->getEnd()->format('H:i'),
            'description'    => $event->getDescription()
        ];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data=$_POST;
            $errors=[];
            $validator = new App\EventValidator;
            $errors = $validator->validates($_POST);
            if (empty($errors)){
                $event = new App\Event();
                //var_dump()
                $events->hydrate($event,$data);
                $events->update($event);
                header('Location: /index?succes=1');
                exit();
            }
        }
        
    
        render('header',['title'=>$event->getName()]);
?>
    
    <div class="container">
    <h1>Editer l'évènement<small> <?= h($event->getName());?></small></h1>
    <form action="" method="post" class="form">
        <?php render('calendar/form',['data'=>$data,'errors'=>$errors]); ?>
        
        <div class="form-group">
            <br>
            <button class="btn btn-primary">Modifier l'évènement</button>
        </div>
    </form>
    </div>
<?php render('footer') ; ?>
    
   
    
<?php require '../views/footer.php'; ?>