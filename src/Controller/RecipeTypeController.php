<?php


namespace App\Controller;


use App\Entity\RecipeType;
use App\Repository\RecipeTypeRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipeTypeController extends BaseController
{
    /**
     * @Route("/recipe-types", name="app_get_all_recipe_types", methods={"GET"})
     * @param RecipeTypeRepository $recipeTypeRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function getAllRecipeType(RecipeTypeRepository $recipeTypeRepository, SerializerInterface $serializer)
    {
        $recipeTypes = $recipeTypeRepository->findAll();
        return new JsonResponse(json_decode($serializer->serialize($recipeTypes, 'json', ['groups' => 'group_recipe_type'])));
    }

    /**
     * @Route("/recipe-types", name="app_post_recipe_types", methods={"POST"})
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param RecipeTypeRepository $recipeTypeRepository
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request, SerializerInterface $serializer, RecipeTypeRepository $recipeTypeRepository)
    {
        $content = $request->getContent();
        /** @var RecipeType $recipeType */
        $recipeType = $serializer->deserialize($content, RecipeType::Class, 'json', ['groups' => 'group_recipe_type']);
        $recipeTypeRepository->create($recipeType);
        return new JsonResponse(json_decode($serializer->serialize($recipeType, 'json', ['groups' => 'group_recipe_type'])));
    }
}