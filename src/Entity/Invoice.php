<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client_id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Quote $quote_id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_created = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $due_date = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?float $total_ht = null;

    #[ORM\Column]
    private ?float $total_ttc = null;

    #[ORM\Column]
    private ?float $total_tva = null;

    public function __construct()
    {
        $this->date_created = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientId(): ?Client
    {
        return $this->client_id;
    }

    public function setClientId(?Client $client_id): static
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getQuoteId(): ?Quote
    {
        return $this->quote_id;
    }

    public function setQuoteId(?Quote $quote_id): static
    {
        $this->quote_id = $quote_id;

        return $this;
    }

    public function getDateCreated(): ?\DateTime
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTime $date_created): static
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDueDate(): ?\DateTime
    {
        return $this->due_date;
    }

    public function setDueDate(\DateTime $due_date): static
    {
        $this->due_date = $due_date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getTotalHt(): ?float
    {
        return $this->total_ht;
    }

    public function setTotalHt(float $total_ht): static
    {
        $this->total_ht = $total_ht;

        return $this;
    }

    public function getTotalTtc(): ?float
    {
        return $this->total_ttc;
    }

    public function setTotalTtc(float $total_ttc): static
    {
        $this->total_ttc = $total_ttc;

        return $this;
    }

    public function getTotalTva(): ?float
    {
        return $this->total_tva;
    }

    public function setTotalTva(float $total_tva): static
    {
        $this->total_tva = $total_tva;

        return $this;
    }
}
