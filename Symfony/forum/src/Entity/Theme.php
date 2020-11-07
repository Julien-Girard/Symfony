<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $sujet;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
    * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $createur;
    
    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Message",mappedBy="Theme")
    * @ORM\JoinColumn(nullable=false)
    */
    private $message;

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCreateur()
    {
        return $this->createur;
    }

    public function setCreateur(Utilisateur $createur): self
    {
        $this->createur = $createur;

        return $this;
    }
}
