<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="Username", columns={"Username"})})
 * 
 * @ORM\Entity(repositoryClass="App\Models\Repositories\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdU", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idu;

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=64, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="Password", type="string", length=64, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="FirstName", type="string", length=64, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="LastName", type="string", length=64, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=64, nullable=false)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Image", type="string", length=256, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=64, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Status", type="string", length=64, nullable=false)
     */
    private $status;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PersonalGoal", type="integer", nullable=true)
     */
    private $personalgoal;

     
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Genre", inversedBy="users")
     * @ORM\JoinTable(name="subscription",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IdU", referencedColumnName="IdU")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="IdG", referencedColumnName="IdG")
     *   }
     * )
     */
    
    private $genres;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Userbooks", mappedBy="idu", orphanRemoval=true)
     */
    private $books;    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Review", mappedBy="user")
     */
    private $reviews;
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Quote", mappedBy="user")
     */
    private $quotes;
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Rate", mappedBy="idu")
     */
    private $rates;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reviews=new \Doctrine\Common\Collections\ArrayCollection();
        $this->quotes=new \Doctrine\Common\Collections\ArrayCollection();
        $this->rates=new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idu.
     *
     * @return int
     */
    public function getIdu()
    {
        return $this->idu;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set image.
     *
     * @param string|null $image
     *
     * @return User
     */
    public function setImage($image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return User
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
     * Set status.
     *
     * @param string $status
     *
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set personalgoal.
     *
     * @param int|null $personalgoal
     *
     * @return User
     */
    public function setPersonalgoal($personalgoal = null)
    {
        $this->personalgoal = $personalgoal;

        return $this;
    }

    /**
     * Get personalgoal.
     *
     * @return int|null
     */
    public function getPersonalgoal()
    {
        return $this->personalgoal;
    }

    /**
     * Add genre.
     *
     * @param \App\Models\Entities\Genre $genre
     *
     * @return User
     */
    public function addGenre(\App\Models\Entities\Genre $genre)
    {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * Remove genre.
     *
     * @param \App\Models\Entities\Genre $genre
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeGenre(\App\Models\Entities\Genre $genre)
    {
        return $this->genres->removeElement($genre);
    }

    /**
     * Get genres.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenres()
    {
        return $this->genres;
    }
    
    /**
     * Add books.
     *
     * @param \App\Models\Entities\Userbooks $book
     *
     * @return User
     */
    public function addBooks(\App\Models\Entities\Userbooks $book)
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setIdu($this);
        }
        return $this;
    }

    /**
     * Remove books.
     *
     * @param \App\Models\Entities\Userbooks $book
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBooks(\App\Models\Entities\Userbooks $book)
    {
        if ($this->books->contains($book)) {
            if ($book->getIdu() == $this) {
                $book->setIdu(null);
            }
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
     * Add book.
     *
     * @param \App\Models\Entities\Userbooks $book
     *
     * @return User
     */
    public function addBook(\App\Models\Entities\Userbooks $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book.
     *
     * @param \App\Models\Entities\Userbooks $book
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBook(\App\Models\Entities\Userbooks $book)
    {
        return $this->books->removeElement($book);
    }

    /**
     * Add review.
     *
     * @param \App\Models\Entities\Review $review
     *
     * @return User
     */
    public function addReview(\App\Models\Entities\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review.
     *
     * @param \App\Models\Entities\Review $review
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeReview(\App\Models\Entities\Review $review)
    {
        return $this->reviews->removeElement($review);
    }

    /**
     * Get reviews.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }
/**
     * Add quote.
     *
     * @param \App\Models\Entities\Quote $quote
     *
     * @return User
     */
    public function addQuote(\App\Models\Entities\Quote $quote)
    {
        $this->quotes[] = $quote;

        return $this;
    }

    /**
     * Remove quote.
     *
     * @param \App\Models\Entities\Quote $quote
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeQuote(\App\Models\Entities\Quote $quote)
    {
        return $this->quotes->removeElement($quote);
    }

    /**
     * Get quotes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getQuotes()
    {
        return $this->quotes;
    }
    
    /**
     * Add rate.
     *
     * @param \App\Models\Entities\Rate $rate
     *
     * @return User
     */
    public function addRate(\App\Models\Entities\Rate $rate)
    {
        $this->rates[] = $rate;

        return $this;
    }

    /**
     * Remove rate.
     *
     * @param \App\Models\Entities\Review $rate
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRates(\App\Models\Entities\Rate $rate)
    {
        return $this->rates->removeElement($rate);
    }

    /**
     * Get rates.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRates()
    {
        return $this->rates;
    }
}