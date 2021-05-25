<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review", indexes={@ORM\Index(name="IdB", columns={"IdB"}), @ORM\Index(name="IdU", columns={"IdU"})})
 * @ORM\Entity
 */
class Review
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdRev", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrev;

    /**
     * @var string
     *
     * @ORM\Column(name="Text", type="string", length=256, nullable=false)
     */
    private $text;

    /**
     * @var \App\Models\Entities\User
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\User",inversedBy="reviews")
     * @ORM\JoinColumn(name="IdU",referencedColumnName="IdU")
     */
    private $user;

    /**
     * @var \App\Models\Entities\Book
     *
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Book",inversedBy="reviews")
     * @ORM\JoinColumn(name="IdB",referencedColumnName="IdB")
     */
    private $book;



    /**
     * Get idrev.
     *
     * @return int
     */
    public function getIdrev()
    {
        return $this->idrev;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return Review
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
     * @return Review
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
     * @return Review
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
     * @return Review
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
     * @return Review
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
