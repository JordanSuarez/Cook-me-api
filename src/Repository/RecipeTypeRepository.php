<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\RecipeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class RecipeTypeRepository
 * @package App\Repository
 * @method removeEntity(RecipeType $recipeType)
 */
class RecipeTypeRepository extends ServiceEntityRepository
{
    /**
     * RecipeTypeRepository constructor
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipeType::class);
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
     * @param RecipeType $recipeType
     * @return RecipeType
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(RecipeType $recipeType): RecipeType
    {
        $this->save($recipeType);
        return $recipeType;
    }

    /**
     * @param RecipeType $recipeType
     */
    public function update(RecipeType $recipeType)
    {
        try {
            $this->save($recipeType, false);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    /**
     * @param RecipeType $recipeType
     */
    public function remove(RecipeType $recipeType)
    {
        $this->removeEntity($recipeType);
    }
}
