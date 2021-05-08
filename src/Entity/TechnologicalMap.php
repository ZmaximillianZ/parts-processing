<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TechnologicalMapRepository")
 * @ORM\Table(name="technological_map")
 * @ORM\HasLifecycleCallbacks
 */
class TechnologicalMap
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(name="x", type="float", length=6, nullable=true)
     */
    private $x;

    /**
     * @ORM\Column(name="y", type="float", length=6, nullable=true)
     */
    private $y;

    /**
     * @ORM\Column(name="z", type="float", length=6, nullable=true)
     */
    private $z;

    /**
     * @ORM\Column(name="weight", type="float", length=6, nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(name="material_grade", type="string", length=128, nullable=true)
     */
    private $materialGrade;

    /**
     * допуск
     * @ORM\Column(name="tolerance", type="float", length=6, nullable=true)
     */
    private $tolerance;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Process", mappedBy="technologicalMap")
     */
    private $processes;

    /**
     * @ORM\OneToMany(targetEntity="Detail", mappedBy="technologicalMap")
     */
    private $details;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->id ?? '';
    }

    /**
     * Gets triggered only on insert.
     *
     * @ORM\PrePersist
     */
    public function onPrePersist(): void
    {
        $this->createdAt = new DateTime('now', (new \DateTimeZone('Europe/Moscow')));
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setX($x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY($y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getZ()
    {
        return $this->z;
    }

    public function setZ($z): self
    {
        $this->z = $z;

        return $this;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getMaterialGrade()
    {
        return $this->materialGrade;
    }

    public function setMaterialGrade($materialGrade): self
    {
        $this->materialGrade = $materialGrade;

        return $this;
    }

    public function getTolerance()
    {
        return $this->tolerance;
    }

    public function setTolerance($tolerance): self
    {
        $this->tolerance = $tolerance;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProcesses(): ?Collection
    {
        return $this->processes;
    }

    public function addProcess(Process $process): self
    {
        $this->processes[] = $process;

        return $this;
    }

    public function addProcesses(array $processes): self
    {
        foreach ($processes as $process) {
            $this->processes[] = $process;
        }

        return $this;
    }

    public function removeProcess(Process $process): self
    {
        $this->processes->remove($process);
        $process->setTechnologicalMap(null);

        return $this;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function addDetail(Detail $detail): self
    {
        $this->details[] = $detail;
        $detail->setTechnologicalMap($this);

        return $this;
    }

    public function removeDetail(Detail $detail): self
    {
        $this->details->remove($detail);
        $detail->setTechnologicalMap(null);

        return $this;
    }
}
