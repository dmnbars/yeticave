<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Пожалуйста, введите Ваше имя.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=2,
     *     max=255,
     *     minMessage="Имя слишком короткое.",
     *     maxMessage="Имя слишком длинное.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank(message="Пожалуйста, введите Ваши контактные данные.", groups={"Registration", "Profile"})
     */
    protected $contactDetails;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Пожалуйста, добавьте аватар (в формате jpg).")
     * @Assert\File(mimeTypes={"image/jpeg"})
     */
    protected $avatar;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lot", mappedBy="user")
     */
    private $lots;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lot", mappedBy="winner")
     */
    private $win_lots;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
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
     * @inheritdoc
     */
    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * Set contact details
     *
     * @param string $contactDetails
     *
     * @return User
     */
    public function setContactDetails($contactDetails)
    {
        $this->contactDetails = $contactDetails;

        return $this;
    }

    /**
     * Get contact details
     *
     * @return string
     */
    public function getContactDetails()
    {
        return $this->contactDetails;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Add lot
     *
     * @param \AppBundle\Entity\Lot $lot
     *
     * @return User
     */
    public function addLot(\AppBundle\Entity\Lot $lot)
    {
        $this->lots[] = $lot;

        return $this;
    }

    /**
     * Remove lot
     *
     * @param \AppBundle\Entity\Lot $lot
     */
    public function removeLot(\AppBundle\Entity\Lot $lot)
    {
        $this->lots->removeElement($lot);
    }

    /**
     * Get lots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLots()
    {
        return $this->lots;
    }

    /**
     * Add winLot
     *
     * @param \AppBundle\Entity\Lot $winLot
     *
     * @return User
     */
    public function addWinLot(\AppBundle\Entity\Lot $winLot)
    {
        $this->win_lots[] = $winLot;

        return $this;
    }

    /**
     * Remove winLot
     *
     * @param \AppBundle\Entity\Lot $winLot
     */
    public function removeWinLot(\AppBundle\Entity\Lot $winLot)
    {
        $this->win_lots->removeElement($winLot);
    }

    /**
     * Get winLots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWinLots()
    {
        return $this->win_lots;
    }
}
