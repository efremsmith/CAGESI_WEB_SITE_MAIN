<?php

namespace App\Entity;

use App\Repository\TypeSolutionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeSolutionsRepository::class)
 */
class TypeSolutions
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
    private $libelle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Solutions::class, mappedBy="TypeSolutions")
     */
    private $solutions;

    public function __construct()
    {
        $this->solutions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Solutions[]
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(Solutions $solution): self
    {
        if (!$this->solutions->contains($solution)) {
            $this->solutions[] = $solution;
            $solution->setTypeSolutions($this);
        }

        return $this;
    }

    public function removeSolution(Solutions $solution): self
    {
        if ($this->solutions->removeElement($solution)) {
            // set the owning side to null (unless already changed)
            if ($solution->getTypeSolutions() === $this) {
                $solution->setTypeSolutions(null);
            }
        }

        return $this;
    }
}
