<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkerRepository")
 * @ORM\Table(name="worker")
 * @ORM\HasLifecycleCallbacks
 */
class Worker
{
    public const EMPLOYED = 1;
    public const ON_HOLIDAY = 2;
    public const ON_SICK_LEAVE = 3;
    public const FIRED = 4;

    public const STATUSES = [
        self::EMPLOYED,
        self::ON_HOLIDAY,
        self::ON_SICK_LEAVE,
        self::FIRED
    ];

    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="position", type="string", length=64, nullable=true)
     */
    private $position;

    /**
     * @ORM\Column(name="qualification", type="float", length=6, nullable=true)
     */
    private $qualification;

    /**
     * прошел ли квалификацию
     * @ORM\Column(name="is_quilification", type="boolean", length=6, nullable=true)
     */
    private $isQualification;

    /**
     * трудоустроен, в отпуске, уволен, больничный
     * @ORM\Column(name="status", type="integer", length=6, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="WorkerEquipment", mappedBy="worker")
     */
    private $workerEquipments;

    /**
     * @ORM\ManyToOne(targetEntity="Brigade", inversedBy="workers", cascade={"persist"})
     */
    private $brigade;

    public function __construct()
    {
        $this->workerEquipments = new ArrayCollection();
    }

    public function __toString()
    {
        return sprintf('%s (%s)', $this->user->getFirstName(), $this->position)  ?? '';
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

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position): self
    {
        $this->position = $position;

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

    public function getIsQualification()
    {
        return $this->isQualification;
    }

    public function setIsQualification($isQualification): self
    {
        $this->isQualification = $isQualification;

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

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getWorkerEquipments(): ?Collection
    {
        return $this->workerEquipments;
    }

    public function addWorkerEquipments(WorkerEquipment $workerEquipment): self
    {
        $this->workerEquipments[] = $workerEquipment;

        return $this;
    }

    public function removeWorkerEquipments(WorkerEquipment $workerEquipment): self
    {
        $this->workerEquipments->remove($workerEquipment);
        $workerEquipment->setWorker(null);

        return $this;
    }

    public function getBrigade()
    {
        return $this->brigade;
    }

    public function setBrigade($brigade): self
    {
        $this->brigade = $brigade;

        return $this;
    }
}
