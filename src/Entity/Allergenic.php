<?php

namespace App\Entity;

use App\Repository\AllergenicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AllergenicRepository::class)]
class Allergenic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: CareSummary::class, mappedBy: 'Allergenic')]
    private Collection $careSummaries;

    public function __construct()
    {
        $this->careSummaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, CareSummary>
     */
    public function getCareSummaries(): Collection
    {
        return $this->careSummaries;
    }

    public function addCareSummary(CareSummary $careSummary): self
    {
        if (!$this->careSummaries->contains($careSummary)) {
            $this->careSummaries->add($careSummary);
            $careSummary->addAllergenic($this);
        }

        return $this;
    }

    public function removeCareSummary(CareSummary $careSummary): self
    {
        if ($this->careSummaries->removeElement($careSummary)) {
            $careSummary->removeAllergenic($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }
}
