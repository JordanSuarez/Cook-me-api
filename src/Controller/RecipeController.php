<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipeController extends BaseController
{
    const STARTERS = 'starters';
    const DISH = 'dish';
    const DESERTS = 'deserts';

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
     * @Route("/recipes/types", name="app_get_all_recipes_types", methods={"GET"})
     * @return JsonResponse
     */
    public function getAllTypes()
    {
        return $this->response(
            [
                ['id' => Recipe::STARTERS, 'name' => self::STARTERS],
                ['id' => Recipe::DISH, 'name' => self::DISH],
                ['id' => Recipe::DESERTS, 'name' => self::DESERTS]

            ], Recipe::GROUP_RECIPE);
    }

    /**
     * @Route("/recipes/{recipe_id}", name="app_get_one_recipe", requirements={"recipe_id": "\d+"}, methods={"GET"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @param Recipe $recipe
     * @return JsonResponse
     */
    public function getOne(Recipe $recipe)
    {
        return $this->response($recipe, Recipe::GROUP_RECIPE);
    }

    /**
     * @Route("/recipes/types/{type_id}", name="app_get_all_recipes_by_type", requirements={"type_id": "\d+"}, methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllByRecipeType(Request $request)
    {
        /** @var Recipe $recipe */
        $id = $request->attributes->get('type_id');
        $recipes = $this->recipeRepository->findBy(['type' => $id]);
        return $this->response($recipes, Recipe::GROUP_RECIPE);
    }

    /**
     * @Route("/recipes", name="app_post_recipe", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        /** @var Recipe $recipe */
        $recipe = $this->handleRequest(Recipe::class, Recipe::GROUP_RECIPE, $request);
        try {
            $data = $this->decodeContent($request);
            $recipe = $this->recipeRepository->create($recipe, $data['ingredients']);
            return $this->response($recipe, Recipe::GROUP_RECIPE, Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/recipes/{recipe_id}", name="app_patch_recipe", requirements={"recipe_id": "\d+"}, methods={"PATCH"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @param Recipe $recipe
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Recipe $recipe, Request $request)
    {
        // This controller method does not handle adding ingredient. To add ingredient use method addIngredient()
        try {
            $data = $this->decodeContent($request);
            $recipe = $this->recipeRepository->update($recipe, $data['name'], $data['preparationTime'], $data['instruction'], $data['ingredients']);
            return $this->response($recipe,Recipe::GROUP_RECIPE,  Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function addIngredient()
    {
        // TODO implement this method
    }

    /**
     * @Route("/recipes/{recipe_id}", name="app_remove_recipe", requirements={"recipe_id": "\d+"}, methods={"DELETE"})
     * @ParamConverter("recipe", options={"id" = "recipe_id"})
     * @param Recipe $recipe
     * @return JsonResponse
     */
    public function delete(Recipe $recipe)
    {
        try {
            return $this->response($this->recipeRepository->remove($recipe),Recipe::GROUP_RECIPE, Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
