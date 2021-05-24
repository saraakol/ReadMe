<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity
 */
class Book
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdB", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idb;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Authors", type="string", length=256, nullable=false)
     */
    private $authors;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=1024, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Image", type="string", length=256, nullable=true)
     */
    private $image;

    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Genre", inversedBy="books")
     * @ORM\JoinTable(name="bookgenres",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IdB", referencedColumnName="IdB")
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
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Review", mappedBy="book")
     */
    private $reviews;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->genres = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reviews = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Get idb.
     *
     * @return int
     */
    public function getIdb()
    {
        return $this->idb;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Book
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
     * Set authors.
     *
     * @param string $authors
     *
     * @return Book
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Get authors.
     *
     * @return string
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Book
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image.
     *
     * @param string|null $image
     *
     * @return Book
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
     * Add genre.
     *
     * @param \App\Models\Entities\Genre $genre
     *
     * @return Book
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
     * Add review.
     *
     * @param \App\Models\Entities\Review $review
     *
     * @return Book
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
}
