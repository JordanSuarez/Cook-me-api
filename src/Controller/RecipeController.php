<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\Ingredient;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipes", name="app_get_all_recipes", methods={"GET"})
     * @param RecipeRepository $recipeRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAll(RecipeRepository $recipeRepository, SerializerInterface $serializer)
    {
        $recipes = $recipeRepository->findAll();
        return new JsonResponse(json_decode($serializer->serialize($recipes, 'json', ['groups' => 'group_recipe'])));
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

