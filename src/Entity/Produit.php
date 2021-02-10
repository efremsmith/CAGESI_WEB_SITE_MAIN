<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
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
    private $nomProduit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Caracteristiques;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieProduit::class, inversedBy="produits")
     */
    private $categorieproduit;

    

    public function __construct()
    {
        $this->ligneAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getCaracteristiques(): ?string
    {
        return $this->Caracteristiques;
    }

    public function setCaracteristiques(string $Caracteristiques): self
    {
        $this->Caracteristiques = $Caracteristiques;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategorieproduit(): ?CategorieProduit
    {
        return $this->categorieproduit;
    }

    public function setCategorieproduit(?CategorieProduit $categorieproduit): self
    {
        $this->categorieproduit = $categorieproduit;

        return $this;
    }

    
}
