<?php

namespace App\Entity;

use App\Repository\CareSummaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CareSummaryRepository::class)]
class CareSummary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column]
    private ?int $number_ss = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\OneToOne(inversedBy: 'careSummary', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'careSummaries')]
    private ?User $doctor_referring = null;

    #[ORM\ManyToOne(inversedBy: 'careSummaries')]
    private ?Gender $gender = null;

    #[ORM\OneToMany(mappedBy: 'care_summary', targetEntity: HealthStatus::class)]
    private Collection $healthStatuses;

    #[ORM\OneToMany(mappedBy: 'care_summary', targetEntity: Prescription::class)]
    private Collection $prescriptions;

    #[ORM\ManyToMany(targetEntity: Allergenic::class, inversedBy: 'careSummaries',  cascade: ['persist'])]
    private Collection $allergenic;

    #[ORM\OneToMany(mappedBy: 'care_summary', targetEntity: TestResults::class)]
    private Collection $testResults;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->healthStatuses = new ArrayCollection();
        $this->prescriptions = new ArrayCollection();
        $this->allergenic = new ArrayCollection();
        $this->testResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getNumberSs(): ?int
    {
        return $this->number_ss;
    }

    public function setNumberSs(int $number_ss): self
    {
        $this->number_ss = $number_ss;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDoctorReferring(): ?User
    {
        return $this->doctor_referring;
    }

    public function setDoctorReferring(?User $doctor_referring): self
    {
        $this->doctor_referring = $doctor_referring;

        return $this;
    }

    public function getGender(): ?Gender
    {
        return $this->gender;
    }

    public function setGender(?Gender $gender): self
    {
        $this->gender = $gender;

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
            $healthStatus->setCareSummary($this);
        }

        return $this;
    }

    public function removeHealthStatus(HealthStatus $healthStatus): self
    {
        if ($this->healthStatuses->removeElement($healthStatus)) {
            // set the owning side to null (unless already changed)
            if ($healthStatus->getCareSummary() === $this) {
                $healthStatus->setCareSummary(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Prescription>
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    public function addPrescription(Prescription $prescription): self
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions->add($prescription);
            $prescription->setCareSummary($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): self
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getCareSummary() === $this) {
                $prescription->setCareSummary(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, allergenic>
     */
    public function getAllergenic(): Collection
    {
        return $this->allergenic;
    }

    public function addAllergenic(allergenic $allergenic): self
    {
        if (!$this->allergenic->contains($allergenic)) {
            $this->allergenic->add($allergenic);
        }

        return $this;
    }

    public function removeAllergenic(allergenic $allergenic): self
    {
        $this->allergenic->removeElement($allergenic);

        return $this;
    }

    /**
     * @return Collection<int, TestResults>
     */
    public function getTestResults(): Collection
    {
        return $this->testResults;
    }

    public function addTestResult(TestResults $testResult): self
    {
        if (!$this->testResults->contains($testResult)) {
            $this->testResults->add($testResult);
            $testResult->setCareSummary($this);
        }

        return $this;
    }

    public function removeTestResult(TestResults $testResult): self
    {
        if ($this->testResults->removeElement($testResult)) {
            // set the owning side to null (unless already changed)
            if ($testResult->getCareSummary() === $this) {
                $testResult->setCareSummary(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
