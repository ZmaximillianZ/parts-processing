<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkerEquipmentRepository")
 * @ORM\Table(name="worker_equipment")
 * @ORM\HasLifecycleCallbacks
 */
class WorkerEquipment
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="qualification", type="float", length=6, nullable=true)
     */
    private $qualification;

    /**
     * @ORM\ManyToOne(targetEntity="Worker", inversedBy="workerEquipments", cascade={"persist"})
     */
    private $worker;

    /**
     * @ORM\ManyToOne(targetEntity="Equipment", inversedBy="workerEquipments", cascade={"persist"})
     */
    private $equipment;

    public function __toString()
    {
        return (string) sprintf('%s(qualification: %s)', $this->worker->getUser()->getFirstName(), (string) $this->qualification) ?? '';
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

    public function getQualification()
    {
        return $this->qualification;
    }

    public function setQualification($qualification): self
    {
        $this->qualification = $qualification;

        return $this;
    }

    public function getWorker()
    {
        return $this->worker;
    }

    public function setWorker($worker): self
    {
        $this->worker = $worker;

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
}
