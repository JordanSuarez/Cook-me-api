<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipeController extends BaseController
{
    /** @var RecipeRepository  */
    private RecipeRepository $recipeRepository;

    /**
     * RecipeController constructor.
     * @param RecipeRepository $recipeRepository
     * @param SerializerInterface $serialize
     */
    public function __construct(RecipeRepository $recipeRepository, SerializerInterface $serialize)
    {
        parent::__construct($serialize);
        $this->recipeRepository = $recipeRepository;
    }


    /**
     * @Route("/recipes", name="app_get_all_recipes", methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $recipes = $this->recipeRepository->findAll();

        return $this->response($recipes, Recipe::GROUP_RECIPE);
    }

    /**
     * @Route("/recipe", name="app_get_one_recipe", methods={"GET"})
     */
    public function getOne()
    {

    }

    /**
     * @Route("/recipes", name="app_post_recipe", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request)
    {
        /** @var Recipe $recipe */
        $recipe = $this->handleRequest(Recipe::class, Recipe::GROUP_RECIPE, $request);

        return $this->response($this->recipeRepository->create($recipe), Recipe::GROUP_RECIPE);
    }
}
