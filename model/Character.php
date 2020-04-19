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

    public function __construct($data)
    {
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setStrongCharacter($data['strongCharacter']);
        $this->setDamages($data['damages']);
        $this->setLevel($data['level']);
        $this->setExperience($data['experience']);
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


}