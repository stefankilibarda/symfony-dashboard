<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $avatarPath;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientName;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientEmail;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: UserClient::class)]
    private $userClients;

    public function __construct()
    {
        $this->userClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatarPath;
    }

    public function setAvatarPath(string $avatarPath): self
    {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): self
    {
        $this->clientName = $clientName;

        return $this;
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): self
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    /**
     * @return Collection<int, UserClient>
     */
    public function getUserClients(): Collection
    {
        return $this->userClients;
    }

    public function addUserClient(UserClient $userClient): self
    {
        if (!$this->userClients->contains($userClient)) {
            $this->userClients[] = $userClient;
            $userClient->setClient($this);
        }

        return $this;
    }

    public function removeUserClient(UserClient $userClient): self
    {
        if ($this->userClients->removeElement($userClient)) {
            // set the owning side to null (unless already changed)
            if ($userClient->getClient() === $this) {
                $userClient->setClient(null);
            }
        }

        return $this;
    }
}
