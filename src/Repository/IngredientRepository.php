<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class IngredientRepository
 * @package App\Repository
 */
class IngredientRepository extends ServiceEntityRepository
{
    /** @var QuantityRepository  */
    private QuantityRepository $quantityRepository;

    /** @var QuantityTypeRepository */
    private QuantityTypeRepository $quantityTypeRepository;

    /** @var RecipeTypeRepository  */
    private RecipeTypeRepository $recipeTypeRepository;

    /**
     * IngredientRepository constructor.
     * @param ManagerRegistry $registry
     * @param QuantityRepository $quantityRepository
     * @param RecipeTypeRepository $recipeTypeRepository
     * @param QuantityTypeRepository $quantityTypeRepository
     */
    public function __construct(ManagerRegistry $registry,
                                QuantityRepository $quantityRepository,
                                RecipeTypeRepository $recipeTypeRepository,
                                QuantityTypeRepository $quantityTypeRepository)
    {
        parent::__construct($registry, Ingredient::class);
        $this->quantityRepository = $quantityRepository;
        $this->recipeTypeRepository = $recipeTypeRepository;
        $this->quantityTypeRepository = $quantityTypeRepository;
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
     * @param string $ingredientName
     * @param string $ingredientDescription
     * @param array $ingredientQuantity
     * @return mixed
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Ingredient $ingredient,
                           string $ingredientName,
                           string $ingredientDescription,
                           array $ingredientQuantity): Ingredient
    {
        $quantityNumber = $ingredientQuantity['number'];
        $quantity = $this->quantityRepository->update($quantityNumber, $ingredientQuantity['type_id']);
        dump($quantity);
        $ingredient->setName($ingredientName);
        $ingredient->setDescription($ingredientDescription);
        $ingredient->setQuantity($quantity);

        $this->save($ingredient, false);

        return $ingredient;
    }

    /**
     * @param Ingredient $ingredient
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Ingredient $ingredient)
    {
        foreach ($ingredient->getRecipes() as $recipe) {
            $ingredient->removeRecipe($recipe);
        }
        $this->_em->remove($ingredient);
        $this->_em->flush();
    }
}
