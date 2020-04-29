<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Recipe;
use App\Entity\RecipeType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class RecipeTypeRepository
 * @package App\Repository
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
        if($persist) {
            $this->_em->persist($entity);
        }
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
        $this->save($recipeType, true);
        return $recipeType;
    }

    /**
     * @param RecipeType $recipeType
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(RecipeType $recipeType)
    {
        $this->save($recipeType, false);
    }

    /**
     * @param RecipeType $recipeType
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(RecipeType $recipeType)
    {
        foreach ($recipeType->getRecipes() as $recipe) {
            $recipeType->removeRecipe($recipe);
        }
        $this->_em->remove($recipeType);
        $this->_em->flush();
    }
}
