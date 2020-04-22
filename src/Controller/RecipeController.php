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
    /**
     * @Route("/recipes", name="app_get_all_recipes", methods={"GET"})
     * @param RecipeRepository $recipeRepository
     * @return JsonResponse
     */
    public function getAll(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->findAll();
        return $this->recipeJson();

//      return new JsonResponse(json_decode($serializer->serialize($recipes, 'json', ['groups' => 'group_recipe'])));
    }

    /**
     * @Route("/recipe", name="app_get_one_recipe", methods={"GET"})
     * @param RecipeRepository $recipeRepository
     */
    public function getOne(RecipeRepository $recipeRepository)
    {

    }

    /**
     * @Route("/recipes", name="app_post_recipe", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param RecipeRepository $recipeRepository
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request, SerializerInterface $serializer, RecipeRepository $recipeRepository)
    {
        $content = $request->getContent();
        /** @var Recipe $recipe */
        $recipe = $serializer->deserialize($content, Recipe::Class, 'json', ['groups' => 'group_recipe']);
        $recipeRepository->create($recipe);
        return new JsonResponse(json_decode($serializer->serialize($recipe, 'json', ['groups' => 'group_recipe'])));
    }
}
