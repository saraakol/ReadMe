<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quote
 *
 * @ORM\Table(name="quote", indexes={@ORM\Index(name="IdB", columns={"IdB"}), @ORM\Index(name="IdU", columns={"IdU"})})
 * @ORM\Entity
 */
class Quote
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdQ", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idq;

    /**
     * @var string
     *
     * @ORM\Column(name="Text", type="string", length=256, nullable=false)
     */
    private $text;

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
     * Get idq.
     *
     * @return int
     */
    public function getIdq()
    {
        return $this->idq;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return Quote
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set idu.
     *
     * @param \App\Models\Entities\User|null $idu
     *
     * @return Quote
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
     * @return Quote
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
