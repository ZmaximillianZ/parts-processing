<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProcessRepository")
 * @ORM\Table(name="process")
 * @ORM\HasLifecycleCallbacks
 */
class Process
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="time", type="integer", length=10, nullable=true)
     */
    private $time;

    /**
     * @ORM\Column(name="qualification", type="float", length=6, nullable=true)
     */
    private $qualification;

    /**
     * @ORM\Column(name="type", type="integer", length=6, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(name="status", type="integer", length=6, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="TechnologicalMap", inversedBy="processes")
     */
    private $technologicalMap;

    /**
     * @ORM\OneToOne(targetEntity="Equipment", inversedBy="process")
     */
    private $equipment;

    /**
     * @ORM\ManyToMany(targetEntity="Tool", cascade={"persist"})
     * @ORM\JoinTable(
     *  name="process_tool",
     *  joinColumns={@ORM\JoinColumn(name="process_id", referencedColumnName="id")},
     *  inverseJoinColumns={@ORM\JoinColumn(name="tool_id", referencedColumnName="id")},
     * )
     */
    private $tools;

    /**
     * @ORM\OneToMany(targetEntity="Detail", mappedBy="process")
     */
    private $details;

    public function __construct()
    {
        $this->tools = new ArrayCollection();
    }

// todo: make relation
//    private $parentId;

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
        $this->createdAt = new DateTime('now');
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

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getQualification()
    {
        return $this->qualification;
    }

    public function setQualification($qualification): self
    {
        $this->qualification = $qualification;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

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

    public function getTechnologicalMap()
    {
        return $this->technologicalMap;
    }

    public function setTechnologicalMap($technologicalMap): self
    {
        $this->technologicalMap = $technologicalMap;

        return $this;
    }

    public function getEquipment()
    {
        return $this->equipment;
    }

    public function setEquipment($equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getTools(): ?Collection
    {
        return $this->tools;
    }

    public function addTool(Tool $tool): self
    {
        $this->tools[] = $tool;

        return $this;
    }

    public function removeTool(Tool $tool): self
    {
        $this->tools->remove($tool);
        $tool->removeProcess($this);

        return $this;
    }

    public function getDetails(): ?Collection
    {
        return $this->details;
    }

    public function addDetail(Detail $detail): self
    {
        $this->details[] = $detail;

        return $this;
    }

    public function removeDetail(Detail $detail): self
    {
        $this->details->remove($detail);
        $detail->setProcess(null);

        return $this;
    }
}
