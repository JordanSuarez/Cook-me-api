<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\QuantityType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class QuantityTypeRepository
 * @package App\Repository
 * @method removeEntity(QuantityType $quantityType)
 */
class QuantityTypeRepository extends ServiceEntityRepository
{
    /** @var QuantityRepository  */
    private QuantityRepository $quantityRepository;

    /**
     * QuantityTypeRepository constructor
     * @param ManagerRegistry $registry
     * @param QuantityRepository $quantityRepository
     */
    public function __construct(ManagerRegistry $registry, QuantityRepository $quantityRepository)
    {
        parent::__construct($registry, QuantityType::class);
        $this->quantityRepository = $quantityRepository;
    }

    /**
     * @param $entity
     * @param bool $persist
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function save($entity, $persist = true) {
        if($persist) $this->_em->persist($entity);
        $this->_em->flush();
    }

    /**
     * @param QuantityType $quantityType
     * @return QuantityType
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(QuantityType $quantityType): QuantityType
    {
        $this->save($quantityType);
        return $quantityType;
    }

    /**
     * @param QuantityType $quantityType
     */
    public function update(QuantityType $quantityType)
    {
        try {
            $this->save($quantityType, false);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    /**
     * @param QuantityType $quantityType
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(QuantityType $quantityType)
    {
        foreach ($quantityType->getQuantities() as $quantity) {
            // jutilise ma methode remove de quantityRepository pour supprimer le lien avec son ingredient
            // pour pouvoir supprimer cette quantity et enfin supprimer ma quantityType
            $this->quantityRepository->remove($quantity);
        }
        $this->_em->remove($quantityType);
        $this->_em->flush();
    }
}
