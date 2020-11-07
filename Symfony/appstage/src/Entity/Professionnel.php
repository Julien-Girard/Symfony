<?php

namespace App\Entity;

use App\Repository\ProfessionnelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfessionnelRepository::class)
 */
class Professionnel
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
    private $nomProfessionnel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenomProfessionnel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fonctionProfessionel;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $telProfessionnel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mailProfessionnel;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProfessionnel(): ?string
    {
        return $this->nomProfessionnel;
    }

    public function setNomProfessionnel(string $nomProfessionnel): self
    {
        $this->nomProfessionnel = $nomProfessionnel;

        return $this;
    }

    public function getPrenomProfessionnel(): ?string
    {
        return $this->prenomProfessionnel;
    }

    public function setPrenomProfessionnel(string $prenomProfessionnel): self
    {
        $this->prenomProfessionnel = $prenomProfessionnel;

        return $this;
    }

    public function getFonctionProfessionel(): ?string
    {
        return $this->fonctionProfessionel;
    }

    public function setFonctionProfessionel(string $fonctionProfessionel): self
    {
        $this->fonctionProfessionel = $fonctionProfessionel;

        return $this;
    }

    public function getTelProfessionnel(): ?string
    {
        return $this->telProfessionnel;
    }

    public function setTelProfessionnel(?string $telProfessionnel): self
    {
        $this->telProfessionnel = $telProfessionnel;

        return $this;
    }

    public function getMailProfessionnel(): ?string
    {
        return $this->mailProfessionnel;
    }

    public function setMailProfessionnel(?string $mailProfessionnel): self
    {
        $this->mailProfessionnel = $mailProfessionnel;

        return $this;
    }
}
