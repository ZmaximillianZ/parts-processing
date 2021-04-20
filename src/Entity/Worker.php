<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkerRepository")
 * @ORM\Table(name="worker")
 * @ORM\HasLifecycleCallbacks
 */
class Worker
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * todo: make as enum
     * @ORM\Column(name="position", type="string", length=6, nullable=true)
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
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="WorkerEquipment", mappedBy="worker")
     */
    private $workerEquipments;

    /**
     * @ORM\ManyToOne(targetEntity="Brigade", inversedBy="workers")
     */
    private $brigade;

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
