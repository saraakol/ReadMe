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
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\User",inversedBy="quotes")
     * @ORM\JoinColumn(name="IdU",referencedColumnName="IdU")
     */
    private $user;

    /**
     * @var \App\Models\Entities\Book
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Book",inversedBy="quotes")
     * @ORM\JoinColumn(name="IdB",referencedColumnName="IdB")
     */
    private $book;
    


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
    /**
     * Set user.
     *
     * @param \App\Models\Entities\User|null $user
     *
     * @return Quote
     */
    public function setUser(\App\Models\Entities\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \App\Models\Entities\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    
    
    /**
     * Set book.
     *
     * @param \App\Models\Entities\Book|null $book
     *
     * @return Quote
     */
    public function setBook(\App\Models\Entities\Book $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book.
     *
     * @return \App\Models\Entities\Book|null
     */
    public function getBook()
    {
        return $this->book;
    }
}
