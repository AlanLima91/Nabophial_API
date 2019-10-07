<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RelationRepository")
 */
class Relation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idUser1;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idUser2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RelationStatus")
     */
    private $relationStatus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser1(): ?int
    {
        return $this->idUser1;
    }

    public function setIdUser1(?int $idUser1): self
    {
        $this->idUser1 = $idUser1;

        return $this;
    }

    public function getIdUser2(): ?int
    {
        return $this->idUser2;
    }

    public function setIdUser2(?int $idUser2): self
    {
        $this->idUser2 = $idUser2;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getRelationStatus(): ?RelationStatus
    {
        return $this->relationStatus;
    }

    public function setRelationStatus(?RelationStatus $relationStatus): self
    {
        $this->relationStatus = $relationStatus;

        return $this;
    }
}
