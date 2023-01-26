<?php

namespace App\Entity;

use App\Repository\PrescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescriptionRepository::class)]
class Prescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'prescriptions')]
    private ?CareSummary $care_summary = null;

    #[ORM\OneToMany(mappedBy: 'prescription', targetEntity: PrescriptionMedication::class)]
    private Collection $prescriptionMedications;

    public function __construct()
    {
        $this->prescriptionMedications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

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

    public function getCareSummary(): ?CareSummary
    {
        return $this->care_summary;
    }

    public function setCareSummary(?CareSummary $care_summary): self
    {
        $this->care_summary = $care_summary;

        return $this;
    }

    /**
     * @return Collection<int, PrescriptionMedication>
     */
    public function getPrescriptionMedications(): Collection
    {
        return $this->prescriptionMedications;
    }

    public function addPrescriptionMedication(PrescriptionMedication $prescriptionMedication): self
    {
        if (!$this->prescriptionMedications->contains($prescriptionMedication)) {
            $this->prescriptionMedications->add($prescriptionMedication);
            $prescriptionMedication->setPrescription($this);
        }

        return $this;
    }

    public function removePrescriptionMedication(PrescriptionMedication $prescriptionMedication): self
    {
        if ($this->prescriptionMedications->removeElement($prescriptionMedication)) {
            // set the owning side to null (unless already changed)
            if ($prescriptionMedication->getPrescription() === $this) {
                $prescriptionMedication->setPrescription(null);
            }
        }

        return $this;
    }
}
