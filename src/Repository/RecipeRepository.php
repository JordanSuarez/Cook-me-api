<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
use App\Entity\Quantity;
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
    /** @var QuantityRepository  */
    private QuantityRepository $quantityRepository;

    /** @var IngredientRepository  */
    private IngredientRepository $ingredientRepository;

    /** @var RecipeTypeRepository  */
    private RecipeTypeRepository $recipeTypeRepository;

    /** @var QuantityTypeRepository */
    private QuantityTypeRepository $quantityTypeRepository;

    /**
     * RecipeRepository constructor.
     * @param ManagerRegistry $registry
     * @param QuantityRepository $quantityRepository
     * @param IngredientRepository $ingredientRepository
     * @param RecipeTypeRepository $recipeTypeRepository
     * @param QuantityTypeRepository $quantityTypeRepository
     */
    public function __construct(ManagerRegistry $registry,
                                QuantityRepository $quantityRepository,
                                IngredientRepository $ingredientRepository,
                                RecipeTypeRepository $recipeTypeRepository,
                                QuantityTypeRepository $quantityTypeRepository)
    {
        parent::__construct($registry, Recipe::class);
        $this->quantityRepository = $quantityRepository;
        $this->ingredientRepository = $ingredientRepository;
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
     * @param Recipe $recipe
     * @param array $ingredientsData
     * @param int $recipeTypeData
     * @return Recipe
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Recipe $recipe, array $ingredientsData, int $recipeTypeData): Recipe
    {
        foreach ($ingredientsData as $ingredientData) {
            // Handle Quantity
            $quantityData = $ingredientData['quantity'];
            $quantity = new Quantity($quantityData['number']);
            $quantityType = $this->quantityTypeRepository->find($quantityData['type_id']);
            $quantity->setQuantityType($quantityType);
            $this->quantityRepository->create($quantity);

            // Handle Ingredient
            /** @var Ingredient $ingredient */
            $ingredient = $this->ingredientRepository->find($ingredientData['id']);
            $recipe->addIngredient($ingredient);
        }
        // Handle RecipeType
        $recipeType = $this->recipeTypeRepository->find($recipeTypeData);
        $recipe->setRecipeType($recipeType);

        $this->save($recipe);
        return $recipe;
    }

    /**
     * @param Recipe $recipe
     */
    // quels arguments mettre dans ma signature car je peux avoir une requete qui ne change qu'un element de ma recipe.
    // faire une method pour chaque key de ma recipe?
    // faire des "if ingredient = do.." "if recipeType = do .." ?
    // utiliser directement les method "set" de Recipe entity pour chaque key dans ma requete?
    public function update(Recipe $recipe)
    {

    }

    /**
     * @param Recipe $recipe
     * @throws ORMException
     */
    public function remove(Recipe $recipe)
    {
        foreach ($recipe->getIngredients() as $ingredient) {
            $recipe->removeIngredient($ingredient);
        }
        $this->_em->remove($recipe);
        $this->_em->flush();
    }


}
