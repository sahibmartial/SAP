<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    
    public function __construct($tva)
    {
        $this->tva=$tva;
    }
  
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $désignation;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prixHT;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTTC;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="factures",cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $emmetteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDésignation(): ?string
    {
        return $this->désignation;
    }

    public function setDésignation(string $désignation): self
    {
        $this->désignation = $désignation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixHT(): ?float
    {
        return $this->prixHT;
    }

    public function setPrixHT(float $prixHT): self
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    public function getPrixTTC(): ?float
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(float $prixTTC): self
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }

    public function getEmmetteur(): ?User
    {
        return $this->emmetteur;
    }

    public function setEmmetteur(?User $emmetteur): self
    {
        $this->emmetteur = $emmetteur;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        
        $this->tva = $tva;

        return $this;
    }
}
