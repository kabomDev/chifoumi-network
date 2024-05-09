<?php

namespace App\Entity;

use App\Repository\GameRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gamesAsPlayerOne')]
    private ?User $playerOne = null;

    #[ORM\ManyToOne(inversedBy: 'gamesAsPlayerTwo')]
    private ?User $playerTwo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $playerOneChoice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $playerTwoChoice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $result = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerOne(): ?User
    {
        return $this->playerOne;
    }

    public function setPlayerOne(?User $playerOne): static
    {
        $this->playerOne = $playerOne;

        return $this;
    }

    public function getPlayerTwo(): ?User
    {
        return $this->playerTwo;
    }

    public function setPlayerTwo(?User $PlayerTwo): static
    {
        $this->playerTwo = $PlayerTwo;

        return $this;
    }

    public function getPlayerOneChoice(): ?string
    {
        return $this->playerOneChoice;
    }

    public function setPlayerOneChoice(?string $playerOneChoice): static
    {
        $this->playerOneChoice = $playerOneChoice;

        return $this;
    }

    public function getPlayerTwoChoice(): ?string
    {
        return $this->playerTwoChoice;
    }

    public function setPlayerTwoChoice(?string $playerTwoChoice): static
    {
        $this->playerTwoChoice = $playerTwoChoice;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
