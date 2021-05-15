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


}
