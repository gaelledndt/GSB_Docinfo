<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Role $role = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?CareSummary $careSummary = null;

    #[ORM\OneToMany(mappedBy: 'doctor_referring', targetEntity: CareSummary::class)]
    private Collection $careSummaries;


    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->careSummaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getCareSummary(): ?CareSummary
    {
        return $this->careSummary;
    }

    public function setCareSummary(CareSummary $careSummary): self
    {
        // set the owning side of the relation if necessary
        if ($careSummary->getUser() !== $this) {
            $careSummary->setUser($this);
        }

        $this->careSummary = $careSummary;

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
            $careSummary->setDoctorReferring($this);
        }

        return $this;
    }

    public function removeCareSummary(CareSummary $careSummary): self
    {
        if ($this->careSummaries->removeElement($careSummary)) {
            // set the owning side to null (unless already changed)
            if ($careSummary->getDoctorReferring() === $this) {
                $careSummary->setDoctorReferring(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->email;
    }
}
