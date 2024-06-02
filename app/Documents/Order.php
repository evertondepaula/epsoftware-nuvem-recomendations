<?php

namespace Nuvem\Documents;

use Doctrine\ODM\MongoDB\PersistentCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Nuvem\Documents\Item;
use DateTime;

/**
 * @ODM\Document(repositoryClass="\Nuvem\Repositories\OrderRepository")
 * @ODM\UniqueIndex(keys={"number"="desc"})
 * @ODM\HasLifecycleCallbacks
*/
class Order
{
    /**
     * @ODM\Id
    */
    private $id;

    /**
     * @ODM\Field(type="int")
    */
    private $number;

    /**
     * @ODM\Field(type="float")
    */
    private $totalValue;

    /**
     * @ODM\Field(type="date")
    */
    private $createdAt;

    /**
     * @ODM\EmbedMany(targetDocument=\Nuvem\Documents\Item::class)
    */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection;
        $this->totalValue = 0.00;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNumber():int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
        }

        return $this;
    }

    public function getItems(): ?PersistentCollection
    {
        return $this->items;
    }

    /**
     * @ODM\PrePersist
    */
    public function prePersist(): void
    {
        $sum = 0.00;

        $this->items->map(function ($item) use (&$sum) {
            $sum += $item->getTotalValue();
        });

        $this->totalValue = $sum;
    }
}
