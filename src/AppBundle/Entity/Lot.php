<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lot
 *
 * @ORM\Table(name="lot")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LotRepository")
 */
class Lot
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_create", type="datetime")
     */
    private $dateCreate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_complete", type="datetime")
     */
    private $dateComplete;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var float
     *
     * @ORM\Column(name="start_price", type="float")
     */
    private $startPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="bet_step", type="float")
     */
    private $betStep;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="lots")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="win_lots")
     * @ORM\JoinColumn(name="winner_id", referencedColumnName="id")
     */
    private $winner;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="lots")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bet", mappedBy="lot")
     */
    private $bets;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Lot
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set dateComplete
     *
     * @param \DateTime $dateComplete
     *
     * @return Lot
     */
    public function setDateComplete($dateComplete)
    {
        $this->dateComplete = $dateComplete;

        return $this;
    }

    /**
     * Get dateComplete
     *
     * @return \DateTime
     */
    public function getDateComplete()
    {
        return $this->dateComplete;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Lot
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Lot
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Lot
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set startPrice
     *
     * @param float $startPrice
     *
     * @return Lot
     */
    public function setStartPrice($startPrice)
    {
        $this->startPrice = $startPrice;

        return $this;
    }

    /**
     * Get startPrice
     *
     * @return float
     */
    public function getStartPrice()
    {
        return $this->startPrice;
    }

    /**
     * Set betStep
     *
     * @param float $betStep
     *
     * @return Lot
     */
    public function setBetStep($betStep)
    {
        $this->betStep = $betStep;

        return $this;
    }

    /**
     * Get betStep
     *
     * @return float
     */
    public function getBetStep()
    {
        return $this->betStep;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Lot
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set winner
     *
     * @param \AppBundle\Entity\User $winner
     *
     * @return Lot
     */
    public function setWinner(\AppBundle\Entity\User $winner = null)
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Get winner
     *
     * @return \AppBundle\Entity\User
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Lot
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function getTimeLeft()
    {
        $now = new \DateTime();
        $end = $this->getDateComplete();

        $diff = $now->diff($end);

        return $diff;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bet
     *
     * @param \AppBundle\Entity\Bet $bet
     *
     * @return Lot
     */
    public function addBet(\AppBundle\Entity\Bet $bet)
    {
        $this->bets[] = $bet;

        return $this;
    }

    /**
     * Remove bet
     *
     * @param \AppBundle\Entity\Bet $bet
     */
    public function removeBet(\AppBundle\Entity\Bet $bet)
    {
        $this->bets->removeElement($bet);
    }

    /**
     * Get bets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBets()
    {
        return $this->bets;
    }
}
