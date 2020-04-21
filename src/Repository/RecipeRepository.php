<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class RecipeRepository
 * @package App\Repository
 * @method removeEntity(Recipe $recipe)
 */
class RecipeRepository extends ServiceEntityRepository
{
    /**
     * RecipeRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    /**
     * @param $entity
     * @param bool $persist
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function save($entity, $persist = true) {
        if($persist) $this->_em->persist($entity);
        $this->_em->flush();
    }

    /**
     * @param Recipe $recipe
     * @return Recipe
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Recipe $recipe): Recipe
    {
        $this->save($recipe);
        return $recipe;
    }

    /**
     * @param Recipe $recipe
     */
    public function update(Recipe $recipe)
    {
        try {
            $this->save($recipe, false);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    /**
     * @param Recipe $recipe
     */
    public function remove(Recipe $recipe)
    {
        $this->removeEntity($recipe);
    }


}
