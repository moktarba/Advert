<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdvertSkill
 *
 * @ORM\Table(name="advert_skill")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AdvertSkillRepository")
 */
class AdvertSkill
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
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

    /**
    * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Advert")
    * @ORM\JoinColumn(nullable=false)
    */
    private $advert;

    /**
    * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Skill")
    * @ORM\JoinColumn(nullable=false)
    */
    private $skill;

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
     * Set level
     *
     * @param string $level
     *
     * @return AdvertSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->advert = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skill = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add advert
     *
     * @param \OC\PlatformBundle\Entity\Advert $advert
     *
     * @return AdvertSkill
     */
    public function addAdvert(\OC\PlatformBundle\Entity\Advert $advert)
    {
        $this->advert[] = $advert;

        return $this;
    }

    /**
     * Remove advert
     *
     * @param \OC\PlatformBundle\Entity\Advert $advert
     */
    public function removeAdvert(\OC\PlatformBundle\Entity\Advert $advert)
    {
        $this->advert->removeElement($advert);
    }

    /**
     * Get advert
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Add skill
     *
     * @param \OC\PlatformBundle\Entity\Skill $skill
     *
     * @return AdvertSkill
     */
    public function addSkill(\OC\PlatformBundle\Entity\Skill $skill)
    {
        $this->skill[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \OC\PlatformBundle\Entity\Skill $skill
     */
    public function removeSkill(\OC\PlatformBundle\Entity\Skill $skill)
    {
        $this->skill->removeElement($skill);
    }

    /**
     * Get skill
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
