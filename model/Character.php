<?php

require_once('Manager.php');

class Character
{

    private $_id;
    private $_name;
    private $_strongCharacter;
    private $_damages;
    private $_level;
    private $_experience;

    const ITS_ME = 1;
    const CHARACTER_DIE = 2;
    const CHARACTER_HIT = 3;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }

    }

    //les getters
    public function getId(){return $this->_id;}
    public function getName(){return $this->_name;}
    public function getStrongCharacter(){return $this->_strongCharacter;}
    public function getDamages(){return $this->_damages;}
    public function getLevel(){return $this->_level;}
    function getExperience(){return $this->_experience;}


    // les setters
    public function setId($id){
        $id = (int)$id;
        if($id > 0){
            $this->_id = $id;
        }
    }

    public function setName($name){
        if(is_string($name)){
            $this->_name = $name;
        }
    }

    public function setStrongCharacter($strongCharacter){
        $strongCharacter = (int)$strongCharacter;
        if($strongCharacter>= 1 && $strongCharacter <=100){
            $this->_strongCharacter = $strongCharacter;
        }
    }

    public function setDamages($damages){
        $damages = (int)$damages;

        if($damages >=0 && $damages <=100){
            $this->_damages = $damages;
        }
    }

    public function setExperience($experience){
        $experience = (int) $experience;
        if($experience >=1 && $experience<=100){
            $this->_experience = $experience;
        }
    }

    public function setLevel($level){
        $level = (int)$level;
        if($level >= 1 && $level <=100){
            $this->_level = $level;
        }
    }

    public function hit (Character $character){
        if ($character->getid() == $this->_id)
        {
            return self::ITS_ME;
        }

        return $character->receiveDamages();
    }


    public function receiveDamages(){
        $this->_damages += 5 ;

        if($this->_damages >= 100){
            return self::CHARACTER_DIE;
        }
        return self::CHARACTER_HIT;

    }
    public function nameTrue()
    {
        return !empty($this->_name);
    }


}