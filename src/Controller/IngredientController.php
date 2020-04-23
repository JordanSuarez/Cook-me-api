<?php


namespace App\Controller;


use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class IngredientController extends BaseController
{
    /** @var IngredientRepository  */
    private IngredientRepository $ingredientRepository;

    /**
     * RecipeController constructor.
     * @param IngredientRepository $ingredientRepository
     * @param SerializerInterface $serialize
     */
    public function __construct(IngredientRepository $ingredientRepository, SerializerInterface $serialize)
    {
        parent::__construct($serialize);
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @Route("/ingredients", name="app_get_all_ingredients", methods={"GET"})
     * @param IngredientRepository $ingredientRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAll(IngredientRepository $ingredientRepository, SerializerInterface $serializer)
    {
        $ingredients = $ingredientRepository->findAll();

        return $this->response($ingredients, Ingredient::GROUP_INGREDIENT);
    }

    /**
     * @Route("/ingredients", name="app_post_ingredient", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request)
    {
        /** @var Ingredient $ingredient */
        $ingredient = $this->handleRequest(Ingredient::class, Ingredient::GROUP_INGREDIENT, $request);

        return $this->response($this->ingredientRepository->create($ingredient), Ingredient::GROUP_INGREDIENT);
    }
}