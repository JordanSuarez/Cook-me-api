<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipes", name="app_get_all_recipes")
     * @param RecipeRepository $recipeRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllRecipes(RecipeRepository $recipeRepository, SerializerInterface $serializer)
    {
        $recipes = $recipeRepository->findAll();
        return new JsonResponse(json_decode($serializer->serialize($recipes, 'json', ['groups' => 'group_recipe'])));
    }
}


