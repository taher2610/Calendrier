<?php

require '../src/Calendar/bootstrap.php';
//require '../src/App/Validator.php';
require '../src/Calendar/EventValidator.php';
//require '../src/Calendar/Event.php';
require '../src/Calendar/events.php';

$events=new App\Events(get_pdo());
$start=new DateTimeImmutable('first day of january');
$end=$start->modify('last day of december')->modify('+ 1 day');
$events=$events->getEventsBetween($start,$end);

?>

id;nom;start;end

<?php foreach($events as $event): ?>
<?= $event->getId(); ?>;
"<?= addslashes($event->getName()) ?>";
"<?= $event->getStart()->format('Y-m-d'); ?>";
"<?= $event->getEnd()->format('Y-m-d'); ?>"
<?php endforeach; ?>    