<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AchatRepository::class)
 */
class Achat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $PrixAchat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreatedAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $WithAuthentificated;

    /**
     * @ORM\ManyToOne(targetEntity=TypeReglement::class, inversedBy="achats")
     */
    private $typereglement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="achats")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=LigneAchat::class, mappedBy="achat")
     */
    private $ligneAchats;

    public function __construct()
    {
        $this->ligneAchats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixAchat(): ?int
    {
        return $this->PrixAchat;
    }

    public function setPrixAchat(int $PrixAchat): self
    {
        $this->PrixAchat = $PrixAchat;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getWithAuthentificated(): ?bool
    {
        return $this->WithAuthentificated;
    }

    public function setWithAuthentificated(?bool $WithAuthentificated): self
    {
        $this->WithAuthentificated = $WithAuthentificated;

        return $this;
    }

    public function getTypereglement(): ?TypeReglement
    {
        return $this->typereglement;
    }

    public function setTypereglement(?TypeReglement $typereglement): self
    {
        $this->typereglement = $typereglement;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|LigneAchat[]
     */
    public function getLigneAchats(): Collection
    {
        return $this->ligneAchats;
    }

    public function addLigneAchat(LigneAchat $ligneAchat): self
    {
        if (!$this->ligneAchats->contains($ligneAchat)) {
            $this->ligneAchats[] = $ligneAchat;
            $ligneAchat->setAchat($this);
        }

        return $this;
    }

    public function removeLigneAchat(LigneAchat $ligneAchat): self
    {
        if ($this->ligneAchats->removeElement($ligneAchat)) {
            // set the owning side to null (unless already changed)
            if ($ligneAchat->getAchat() === $this) {
                $ligneAchat->setAchat(null);
            }
        }

        return $this;
    }
}
