<?php

class CharacterManager extends Manager
{

private $_db;



    public function __construct($db)
    {
        $this->setdb($db);
    }
    public function add(Character $perso)
    {
        $q = $this->_db->prepare('INSERT INTO Characters(name, strongCharacter, damages, level, experience) VALUES(:name, :strongCharacter, :damages, :level, :experience)');

        $q->bindValue(':name', $perso->getName());
        $q->bindValue(':strongCharacter', $perso->getStrongCharacter(), PDO::PARAM_INT);
        $q->bindValue(':damages', $perso->getDamages(), PDO::PARAM_INT);
        $q->bindValue(':level', $perso->getLevel(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->getExperience(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(Character $perso)
    {
        $this->_db->exec('DELETE FROM Characters WHERE id = '.$perso->getid());
    }

    public function get($id)
    {
        $id = (int) $id;

        $q = $this->_db->query('SELECT id, id, name, strongcharacter, damages, level, experience FROM Characters WHERE id = '.$id);
        $data = $q->fetch(PDO::FETCH_ASSOC);

        return new Character($data);
    }

    public function getList()
    {
        $persos = [];

        $q = $this->_db->query('SELECT id, name, strongCharacter, damages, level, experience FROM Characters ORDER BY name');

        while ($data = $q->fetch(PDO::FETCH_ASSOC))
        {
            $persos[] = new Character($data);

        }
        return $persos;


    }

    public function update(Character $perso)
    {
        $q = $this->_db->prepare('UPDATE Characters SET strongCharacter = :strongCharacter, damages = :damages, level = :level, experience = :experience WHERE id = :id');

        $q->bindValue(':strongCharacter', $perso->getstrongCharacter(), PDO::PARAM_INT);
        $q->bindValue(':damages', $perso->getdamages(), PDO::PARAM_INT);
        $q->bindValue(':level', $perso->getlevel(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->getexperience(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->getid(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}