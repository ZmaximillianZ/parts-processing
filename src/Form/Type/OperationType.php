<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Process;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class OperationType extends AbstractType
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $processNames = array_column($this
            ->entityManager
            ->createQueryBuilder()
            ->select(['p.name'])
            ->from(Process::class, 'p')
            ->getQuery()
            ->getResult(),
        'name'
        );

        $builder
            ->add('apply', SubmitType::class)
            ->add(
            'Processes',
            ChoiceType::class,
            ['choices' => array_combine($processNames, $processNames)]
        );
    }
}
