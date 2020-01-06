<?php

namespace BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 */
class Category {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name = 'NULL';

    /**
     * @var string
     */
    private $description = 'NULL';
    protected $entry;

    public function __construct() {
        $this->entry = new ArrayCollection();
    }

    public function __toString() {
        return $this->name;
    }

    public function getEntries() {
        return $this->entry;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

}
