<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userbooks
 *
 * @ORM\Table(name="userbooks", indexes={@ORM\Index(name="IdB", columns={"IdB"}), @ORM\Index(name="IdU", columns={"IdU"})})
 * @ORM\Entity
 */
class Userbooks
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdUB", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idub;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var \App\Models\Entities\User
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdU", referencedColumnName="IdU")
     * })
     */
    private $idu;

    /**
     * @var \App\Models\Entities\Book
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdB", referencedColumnName="IdB")
     * })
     */
    private $idb;



    /**
     * Get idub.
     *
     * @return int
     */
    public function getIdub()
    {
        return $this->idub;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Userbooks
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set idu.
     *
     * @param \App\Models\Entities\User|null $idu
     *
     * @return Userbooks
     */
    public function setIdu(\App\Models\Entities\User $idu = null)
    {
        $this->idu = $idu;

        return $this;
    }

    /**
     * Get idu.
     *
     * @return \App\Models\Entities\User|null
     */
    public function getIdu()
    {
        return $this->idu;
    }

    /**
     * Set idb.
     *
     * @param \App\Models\Entities\Book|null $idb
     *
     * @return Userbooks
     */
    public function setIdb(\App\Models\Entities\Book $idb = null)
    {
        $this->idb = $idb;

        return $this;
    }

    /**
     * Get idb.
     *
     * @return \App\Models\Entities\Book|null
     */
    public function getIdb()
    {
        return $this->idb;
    }
}
