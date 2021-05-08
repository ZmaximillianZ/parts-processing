<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailRepository")
 * @ORM\Table(name="detail")
 * @ORM\HasLifecycleCallbacks
 */
class Detail
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
     * @ORM\Column(name="status", type="integer", length=6, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="TechnologicalMap", inversedBy="details")
     */
    private $technologicalMap;

    /**
     * @ORM\OneToMany(targetEntity="WorkerEquipmentDetailProcess", mappedBy="detail")
     */
    private $workerEquipmentDetailProcesses;

    public function __toString()
    {
        return (string) $this->name ?? '';
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

    public function getWorkerEquipmentDetailProcesses(): ?Collection
    {
        return $this->workerEquipmentDetailProcesses;
    }

    public function addWorkerEquipmentDetailProcesses(WorkerEquipmentDetailProcess $process): self
    {
        $this->workerEquipmentDetailProcesses[] = $process;

        return $this;
    }

    public function removeWorkerEquipmentDetailProcesses(WorkerEquipmentDetailProcess $process): self
    {
        $this->workerEquipmentDetailProcesses->remove($process);
        $process->setWorkerEquipment(null);

        return $this;
    }
}
