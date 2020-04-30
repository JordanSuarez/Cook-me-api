<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
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
        try {
            return $this->response($recipes, Recipe::GROUP_RECIPE, Response::HTTP_OK);
        } catch (ORMInvalidArgumentException $exception){

        }
    }

    /**
     * @Route("/recipes/{recipe_id}", name="app_get_one_recipe", requirements={"recipe_id": "\d+"}, methods={"GET"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @param Recipe $recipe
     * @return JsonResponse
     */
    public function getOne(Recipe $recipe)
    {
        try {
            return $this->response($recipe, Recipe::GROUP_RECIPE, Response::HTTP_OK);
        } catch (ORMException $exception) {

        }
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
        $data = $this->decodeContent($request);
        try {
            $recipe = $this->recipeRepository->create($recipe, $data['ingredients'], $data['recipeType']);
            return $this->response($recipe, Recipe::GROUP_RECIPE, Response::HTTP_CREATED);
        } catch (ORMInvalidArgumentException $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/recipes/{recipe_id}", name="app_remove_recipe", requirements={"recipe_id": "\d+"}, methods={"DELETE"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @param Recipe $recipe
     * @return JsonResponse
     * @throws ORMException
     */
    public function delete(Recipe $recipe)
    {
        return $this->response($this->recipeRepository->remove($recipe),Recipe::GROUP_RECIPE);
    }
}
