<?php


namespace App\Controller;


use App\Repository\RecipeTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipeTypeController extends AbstractController
{
    /**
     * @Route("/recipe-types", name="app_get_all_recipe_types")
     * @param RecipeTypeRepository $recipeTypeRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllRecipeType(RecipeTypeRepository $recipeTypeRepository, SerializerInterface $serializer)
    {
        $recipeTypes = $recipeTypeRepository->findAll();
        return new JsonResponse(json_decode($serializer->serialize($recipeTypes, 'json', ['groups' => 'group_recipe_type'])));
    }
}