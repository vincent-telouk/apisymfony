<?php

namespace App\Entity;


trait RessourceId {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;


    public function getId(): ?int
    {
        return $this->id;
    }

}