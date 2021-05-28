<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity(repositoryClass="App\Models\Repositories\GenreRepository")
 */
class Genre
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdG", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idg;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=64, nullable=false)
     */
    private $name;

   
    
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Book", mappedBy="genres")
     */
    private $books;
    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\User", mappedBy="genres")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }


    
    

    /**
     * Get idg.
     *
     * @return int
     */
    public function getIdg()
    {
        return $this->idg;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add book.
     *
     * @param \App\Models\Entities\Book $book
     *
     * @return Genre
     */
    public function addBook(\App\Models\Entities\Book $book)
    {
        if(!$this->books->contains($book)){
            
        
        $this->books[] = $book;
        $book->addGenre($this);
        }
        return $this;
    }

    /**
     * Remove book.
     *
     * @param \App\Models\Entities\Book $book
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBook(\App\Models\Entities\Book $book)
    {
        if($this->books->contains($book))
        {
            if($book->getGenres()->contains($this))
            $book->removeGenre($this);
            return $this->books->removeElement($book);
        }
        return false;
    }

    /**
     * Get books.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * Add user.
     *
     * @param \App\Models\Entities\User $user
     *
     * @return Genre
     */
    public function addUser(\App\Models\Entities\User $user)
    {
        if(!$this->users->contains($user)){
            $this->users[] = $user;
            $user->addGenre($this);
        }
        return $this;
    }

    /**
     * Remove user.
     *
     * @param \App\Models\Entities\User $user
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUser(\App\Models\Entities\User $user)
    {
        
        if($this->users->contains($user))
        {
            if($user->getGenres()->contains($this))
            $user->removeGenre($this);
            return $this->users->removeElement($user);
        }
        return false;
    }

    /**
     * Get users.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
