<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipmentRepository")
 * @ORM\Table(name="equipment")
 * @ORM\HasLifecycleCallbacks
 */
class Equipment
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * точность выполнения
     * @ORM\Column(name="accurancy", type="float", length=6, nullable=true)
     */
    private $accuracy;

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
     * @ORM\OneToOne(targetEntity="Process", inversedBy="equipment")
     */
    private $process;

    /**
     * @ORM\OneToMany(targetEntity="WorkerEquipment", mappedBy="equipment")
     */
    private $workerEquipments;

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

    public function getAccuracy()
    {
        return $this->accuracy;
    }

    public function setAccuracy($accuracy): self
    {
        $this->accuracy = $accuracy;

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

    public function getProcess()
    {
        return $this->process;
    }

    public function setProcess($process): self
    {
        $this->process = $process;

        return $this;
    }

    public function getWorkerEquipments(): ?Collection
    {
        return $this->workerEquipments;
    }

    public function addWorkerEquipment(WorkerEquipment $workerEquipment): self
    {
        $this->workerEquipments[] = $workerEquipment;
        $workerEquipment->setEquipment($this);

        return $this;
    }

    public function removeWorkerEquipment(WorkerEquipment $workerEquipment): self
    {
        $this->workerEquipments->remove($workerEquipment);
        $workerEquipment->setEquipment(null);

        return $this;
    }
}
