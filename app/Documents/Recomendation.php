<?php

namespace Nuvem\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Nuvem\Documents\Item;

/**
 * @ODM\QueryResultDocument
*/
class Recomendation
{
    /**
     * @ODM\EmbedOne(targetDocument=\Nuvem\Documents\Item::class, name="_id")
    */
    private $item;

    /**
     * @ODM\Field(type="int")
    */
    private $count;

    public function getItem(): Item
    {
        return $this->item;
    }

    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }
}
