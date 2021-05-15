<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity
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
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Book", inversedBy="genres")
     * @ORM\JoinTable(name="bookgenres",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IdG", referencedColumnName="IdG")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="IdB", referencedColumnName="IdB")
     *   }
     * )
     */
    private $books;

    
    
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\User", inversedBy="genres")
     * @ORM\JoinTable(name="subscription",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IdG", referencedColumnName="IdG")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="IdU", referencedColumnName="IdU")
     *   }
     * )
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

}
