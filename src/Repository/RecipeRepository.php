<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
use App\Entity\Quantity;
use App\Entity\QuantityType;
use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class RecipeRepository
 * @package App\Repository
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
     * @param $name
     * @param $preparationTime
     * @param $instruction
     * @param $recipeTypeId
     * @param $ingredients
     * @return Recipe
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Recipe $recipe, $name, $preparationTime, $instruction, $recipeTypeId, $ingredients)
    {
        $recipe->setName($name);
        $recipe->setPreparationTime($preparationTime);
        $recipe->setInstruction($instruction);

        foreach ($ingredients as $ingredient) {

            /** @var Quantity $quantity */
            $quantityData = $ingredient['quantity'];
            $quantity = $this->quantityRepository->find($quantityData['id']);
            $this->quantityRepository->remove($quantity);
            $newQuantity = new Quantity($quantityData['number']);

            /** @var QuantityType $quantityType */
            $quantityType = $this->quantityTypeRepository->find($quantityData['type_id']);
            $newQuantity->setQuantityType($quantityType);

            $this->quantityRepository->create($newQuantity);

            /** @var Ingredient $ingredient */
            $ingredient = $this->ingredientRepository->find($ingredient['id']);
            $ingredient->setQuantity($newQuantity);
        }
        $recipeType = $this->recipeTypeRepository->find($recipeTypeId);
        $recipe->setRecipeType($recipeType);

        $this->save($recipe);
        return $recipe;
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
