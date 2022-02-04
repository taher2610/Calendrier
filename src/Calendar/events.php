<?php
namespace Calendar;

class events {
    private $pdo;
    public function __construct(\PDO $pdo){
        $this->pdo=$pdo;
    }

    public function getEventsBetween (\DateTime $start,\DateTime $end): array {
       
        $sql="select * from events where start between '{$start->format('Y-m-d 00:00:00')}' and '{$end->format('Y-m-d 23:59:59')} order by start asc';";
        $statement=$this->pdo->query($sql);
        $res=$statement->fetchAll();
        return $res;
    }

    public function getEventsBetweenByDay (\DateTime $start,\DateTime $end): array {
        $events = $this->getEventsBetween($start,$end);
        $days = [];
        foreach ($events as $event ) {
            $date=explode(' ', $event['start'])[0];
            if (!isset ($days[$date])) {
                $days[$date]=[$event];
            } else {
                $days[$date][]=$event;
            }
        }
        return $days;

    }

    public function find (int $id):Event{
        require 'Event.php';
        $statement = $this->pdo->query("select * from events where id=$id limit 1 ");
        $statement->setFetchMode(\PDO::FETCH_CLASS,\Calendar\Event::class);
        $res=$statement->fetch();
    if ($res === false){
        throw new \Exception('Aucun résultat n\'a été trouvée');
    }
    return $res;
    }

    public hydrate (Event $event,array $data){
    $event->setName($data['name']);
    $event->setDescription($data['description']);
    $event->setStart(\DateTime::createFormFormat('Y-m-d H:i', $data['date'] . ' ' . $data['start'])->format('Y-m-d H:i:s'));
    $event->setEnd(\DateTime::createFormFormat('Y-m-d H:i', $data['date'] . ' ' . $data['end'])->format('Y-m-d H:i:s'));
        return $event;
    }

public function create (Event $event):bool{
    $statement=$this->pdo->prepare('insert into events (name,description,start,end) values (?,?,?,?);');
    $statement->execute([
        $event->getName(),
        $event->getDescription();
        $event->getStart()->format('Y-m-d H:i:s'),
        $event->getEnd()->format('Y-m-d H:i:s'),

    ]);
}

public function update (Event $event):bool{
    $statement=$this->pdo->prepare('update events set name = ?,description = ?,start = ?,end = ? where id = ?;');
    $statement->execute([
        $event->getName(),
        $event->getDescription();
        $event->getStart()->format('Y-m-d H:i:s'),
        $event->getEnd()->format('Y-m-d H:i:s'),
        $event->getId()

    ]);
}

public function delete(Event $event):bool{

}
}



?>