<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkerEquipmentDetailProcessRepository")
 * @ORM\Table(name="worker_quipment_detail_process")
 * @ORM\HasLifecycleCallbacks
 */
class WorkerEquipmentDetailProcess
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="WorkerEquipment", inversedBy="workerEquipmentDetailProcesses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workerEquipment;

    /**
     * @ORM\ManyToOne(targetEntity="Detail", inversedBy="workerEquipmentDetailProcesses")
     */
    private $detail;

    /**
     * @ORM\Column(name="time", type="integer", length=10, nullable=true)
     */
    private $time;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    public function __toString()
    {
        return sprintf('%s, (%s)', $this->workerEquipment->getWorker()->getUser(), $this->detail) ?? '';
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

    public function getWorkerEquipment()
    {
        return $this->workerEquipment;
    }

    public function setWorkerEquipment($workerEquipment): self
    {
        $this->workerEquipment = $workerEquipment;

        return $this;
    }

    public function getEquipment()
    {
        $we = $this->getWorkerEquipment();

        return $we->getEquipment();
    }

    public function setEquipment(Equipment $equipment): self
    {
        /** @var WorkerEquipment $we */
        $we = $this->getWorkerEquipment()->getEquipment();
        $we->setEquipment($equipment);

        return $this;
    }

    public function getWorker()
    {
        $we = $this->getWorkerEquipment();

        return $we->getWorker();
    }

    public function setWorker(Worker $worker): self
    {
        /** @var WorkerEquipment $workerEquipment */
        $workerEquipment = $this->getWorkerEquipment();
        $workerEquipment->setWorker($worker);

        return $this;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function setDetail($detail): self
    {
        $this->detail = $detail;

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

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
