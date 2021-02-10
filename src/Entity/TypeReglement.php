<?php

namespace App\Entity;

use App\Repository\TypeReglementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeReglementRepository::class)
 */
class TypeReglement
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
    private $typeReglement;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="typereglement")
     */
    private $achats;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeReglement(): ?string
    {
        return $this->typeReglement;
    }

    public function setTypeReglement(string $typeReglement): self
    {
        $this->typeReglement = $typeReglement;

        return $this;
    }

    /**
     * @return Collection|Achat[]
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setTypereglement($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getTypereglement() === $this) {
                $achat->setTypereglement(null);
            }
        }

        return $this;
    }

    
}
