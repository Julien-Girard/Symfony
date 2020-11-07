<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
class Promotion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateLibelle;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DocumentModele")
     */
    private $doc1;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DocumentModele")
     */
    private $doc2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLibelle(): ?string
    {
        return $this->dateLibelle;
    }

    public function setDateLibelle(string $dateLibelle): self
    {
        $this->dateLibelle = $dateLibelle;

        return $this;
    }

}
