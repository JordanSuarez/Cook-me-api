<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
use App\Entity\Quantity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class IngredientRepository
 * @package App\Repository
 * @method removeEntity(Ingredient $ingredient)
 */
class IngredientRepository extends ServiceEntityRepository
{
    /**
     * IngredientRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredient::class);
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
     * @param Ingredient $ingredient
     * @return Ingredient
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Ingredient $ingredient):Ingredient
    {
        $this->save($ingredient);
        return $ingredient;
    }

    /**
     * @param Ingredient $ingredient
     */
    public function update(Ingredient $ingredient)
    {
        try {
            $this->save($ingredient, false);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    /**
     * @param Ingredient $ingredient
     */
    public function remove(Ingredient $ingredient)
    {
        $this->removeEntity($ingredient);
    }
}
