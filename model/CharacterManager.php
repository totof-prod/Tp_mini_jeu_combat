<?php

class CharacterManager extends Manager
{

private $_db;


    public function __construct($db)
    {
        $this->setdb($db);
    }



    public function add(Character $character)
    {
        $q = $this->_db->prepare('INSERT INTO Characters(name) VALUES(:name)');
        $q->bindValue(':name', $character->getName());
        $q->execute();

        $character->hydrate([
            'id' => $this->_db->lastInsertId(),
            'degats' => 0,
        ]);
    }
    public function count(){
        return $this->_db->query('SELECT COUNT(*) FROM Characters')->fetchColumn();
    }

    public function delete(Character $character)
    {
        $this->_db->exec('DELETE FROM Characters WHERE id = '.$character->getid());
    }
    public function exists($info){

        if (is_int($info))
        {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM Characters WHERE id = '.$info)->fetchColumn();
        }
        $q = $this->_db->prepare('SELECT COUNT(*) FROM Characters WHERE name = :name');
        $q->execute([':name' => $info]);

        return (bool) $q->fetchColumn();
    }

    public function get($info)
    {
        if (is_int($info))
        {
            $q = $this->_db->query('SELECT id, name, damages FROM Characters WHERE id = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);

            return new Character($donnees);
        }
        else
        {
            $q = $this->_db->prepare('SELECT id, name, damages FROM Characters WHERE name = :name');
            $q->execute([':name' => $info]);

            return new Character($q->fetch(PDO::FETCH_ASSOC));
        }
    }

    public function getList()
    {
        $character = [];

        $q = $this->_db->query('SELECT id, name, damages FROM Characters  ORDER BY name');

        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $character[] = new Character($data);
        }

        return $character;


    }

    public function update(Character $character)
    {
        $q = $this->_db->prepare('UPDATE Characters SET damages = :damages WHERE id = :id');
        $q->bindValue(':damages', $character->getdamages(), PDO::PARAM_INT);
        $q->bindValue(':id', $character->getid(), PDO::PARAM_INT);
        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}