<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: HealthStatus::class)]
    private Collection $healthStatuses;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->healthStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, HealthStatus>
     */
    public function getHealthStatuses(): Collection
    {
        return $this->healthStatuses;
    }

    public function addHealthStatus(HealthStatus $healthStatus): self
    {
        if (!$this->healthStatuses->contains($healthStatus)) {
            $this->healthStatuses->add($healthStatus);
            $healthStatus->setStatus($this);
        }

        return $this;
    }

    public function removeHealthStatus(HealthStatus $healthStatus): self
    {
        if ($this->healthStatuses->removeElement($healthStatus)) {
            // set the owning side to null (unless already changed)
            if ($healthStatus->getStatus() === $this) {
                $healthStatus->setStatus(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->status;
    }
}
