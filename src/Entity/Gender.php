<?php

namespace App\Entity;

use App\Repository\GenderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenderRepository::class)]
class Gender
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'gender', targetEntity: CareSummary::class)]
    private Collection $careSummaries;

    public function __construct()
    {
        $this->careSummaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $careSummary->setGender($this);
        }

        return $this;
    }

    public function removeCareSummary(CareSummary $careSummary): self
    {
        if ($this->careSummaries->removeElement($careSummary)) {
            // set the owning side to null (unless already changed)
            if ($careSummary->getGender() === $this) {
                $careSummary->setGender(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->type;
    }
}
