<?php

namespace Nuvem\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

/**
 * @ODM\EmbeddedDocument
 * @ODM\HasLifecycleCallbacks
*/
class Item
{
    /**
     * @ODM\Field(type="string")
     * @ODM\Index(unique=false, name="sku_idx")
    */
    private $sku;

    /**
     * @ODM\Field(type="string")
    */
    private $name;

    /**
     * @ODM\Field(type="int")
    */
    private $quantity;

    /**
     * @ODM\Field(type="float")
    */
    private $unitValue;

    /**
     * @ODM\Field(type="float")
    */
    private $totalValue;

    /**
     * @ODM\Field(type="date")
    */
    private $createdAt;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity = 1): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitValue(): ?float
    {
        return $this->unitValue;
    }

    public function setUnitValue(?float $unitValue): self
    {
        $this->unitValue = $unitValue;

        return $this;
    }

    public function getTotalValue(): ?float
    {
        return $this->totalValue;
    }

    public function setTotalValue(?float $totalValue): self
    {
        $this->totalValue = $totalValue;

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @ODM\PrePersist
    */
    public function prePersist(): void
    {
        $totalValue = ($this->getUnitValue() * $this->getQuantity());
        $this->setTotalValue($totalValue);
    }
}
