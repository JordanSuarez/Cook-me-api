<?php


namespace App\Controller;

use App\Entity\RecipeType;
use App\Repository\RecipeTypeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RecipeTypeController extends BaseController
{
    /** @var RecipeTypeRepository */
    private RecipeTypeRepository $recipeTypeRepository;

    /**
     * RecipeTypeController constructor.
     * @param RecipeTypeRepository $recipeTypeRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(RecipeTypeRepository $recipeTypeRepository, SerializerInterface $serializer)
    {
        parent::__construct($serializer);
        $this->recipeTypeRepository = $recipeTypeRepository;
    }

    /**
     * @Route("/recipe-types", name="app_get_all_recipe_types", methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $recipeTypes = $this->recipeTypeRepository->findAll();

        return $this->response($recipeTypes, RecipeType::GROUP_RECIPE_TYPE);
    }

    /**
     * @Route("/recipe-types/{recipe_type_id}", name="app_get_one_recipe_type", requirements={"recipe_type_id": "\d+"}, methods={"GET"})
     * @ParamConverter("recipeType", options={"id" = "recipe_type_id"})
     * @param RecipeType $recipeType
     * @return JsonResponse
     */
    public function getOne(RecipeType $recipeType)
    {
        return $this->response($recipeType, RecipeType::GROUP_RECIPE_TYPE);
    }

    /**
     * @Route("/recipe-types", name="app_post_recipe_type", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        /** @var RecipeType $recipeType */
        $recipeType = $this->handleRequest(RecipeType::class, RecipeType::GROUP_RECIPE_TYPE, $request);
        try {
            return $this->response($this->recipeTypeRepository->create($recipeType),RecipeType::GROUP_RECIPE_TYPE, Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/recipe-types/{recipe_type_id}", name="app_patch_recipe_type", requirements={"recipe_type_id": "\d+"}, methods={"PATCH"})
     * @ParamConverter("recipeType", options={"id" = "recipe_type_id"})
     * @param RecipeType $recipeType
     * @param Request $request
     * @return JsonResponse
     */
    public function update(RecipeType $recipeType, Request $request)
    {
        try {
            $data = $this->decodeContent($request);
            $recipeType = $this->recipeTypeRepository->update($recipeType, $data['name']);
            return $this->response($recipeType,RecipeType::GROUP_RECIPE_TYPE,  Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Route("/recipe-types/{recipe_type_id}", name="app_remove_recipe_type", requirements={"recipe_type_id": "\d+"}, methods={"DELETE"})
     * @ParamConverter("recipeType", options={"id" = "recipe_type_id"})
     * @param RecipeType $recipeType
     * @return JsonResponse
     */
    public function delete(RecipeType $recipeType)
    {
        try {
            return $this->response($this->recipeTypeRepository->remove($recipeType),RecipeType::GROUP_RECIPE_TYPE);
        } catch (\Exception $exception) {
            return $this->response(null, null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}