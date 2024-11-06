<?php

namespace App\Application\Company\V1\Http\Controllers\Project;

use App\Application\Company\V1\Http\Requests\Project\CreateSprintRequest;
use App\Application\Company\V1\Http\Requests\Project\UpdateSprintRequest;
use App\Application\Company\V1\Http\Resources\Project\SprintPaginatedResource;
use App\Application\Company\V1\Http\Resources\Project\SprintResource;
use App\Domain\Project\Actions\GetSprintsAction;
use App\Domain\Project\Actions\LoadSprintAction;
use App\Domain\Project\DataTransferObjects\SprintData;
use App\Domain\Project\ProjectAggregate;
use App\Domain\Project\Projections\Sprint;
use App\Support\Bases\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations\OpenApi AS OA;
use Exception;

class SprintController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/company/v1/sprints",
     *     tags={"Sprints"},
     *     summary="Get sprints",
     *     description="Get sprints",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="OK"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Company_SprintPaginatedResponse")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 ref="#/components/schemas/PaginationMeta"
     *             ),
     *         ),
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Sprint::class);

        $userId = auth()->user()->id;
        $sprints = app(GetSprintsAction::class)($userId);

        return $this->okResponse(SprintPaginatedResource::collection($sprints));
    }

    /**
     * @OA\Get(
     *     path="/company/v1/sprints/{sprint}",
     *     tags={"Sprints"},
     *     summary="Get a specific sprint",
     *     description="Retrieve details of a specific sprint by its ID",
     *     @OA\Parameter(
     *         name="sprint",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid"),
     *         description="The ID of the sprint"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="OK"),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Company_FullSprintResponse"
     *             ),
     *             @OA\Property(property="meta", type="object", example=null),
     *         ),
     *     )
     * )
     */
    public function show(Sprint $sprint): JsonResponse
    {
        Gate::authorize('view', $sprint);

        return $this->okResponse(SprintResource::make($sprint->load(['tasks'])));
    }

    /**
     * @OA\Post(
     *     path="/company/v1/sprints",
     *     tags={"Sprints"},
     *     summary="Create sprint",
     *     description="This endpoint is used to create a new sprint",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="project_id",
     *                 type="string",
     *                 format="uuid",
     *                 example="9d68cb84-f2a9-462f-aba7-ce35a68a955a"
     *             ),
     *             @OA\Property(property="number", type="integer", example="2"),
     *             @OA\Property(property="start", type="string", format="date-time", example="2024-11-10"),
     *             @OA\Property(property="end", type="string", format="date-time", example="2024-11-24"),
     *             @OA\Property(property="goal", type="string", example="sprint goal"),
     *             @OA\Property(property="status", type="string", example="pending"),
     *             @OA\Property(
     *                 property="tasks",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="priority_id", type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955c"),
     *                     @OA\Property(property="assigned_to", type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955d"),
     *                     @OA\Property(property="title", type="string", example="Create a login feature"),
     *                     @OA\Property(property="description", type="string", example="Develop the login module for the application")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="OK"),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Company_FullSprintResponse"
     *              ),
     *              @OA\Property(property="meta", type="object", example=null),
     *          )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Bad request")
     *          )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation failed",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unprocessable Content"),
     *              @OA\Property(property="errors", type="array",
     *                   @OA\Items(type="string", example="The goal field is required."),
     *              ),
     *          )
     *      )
     * )
     */
    public function store(CreateSprintRequest $request): JsonResponse
    {
        Gate::authorize('create', Sprint::class);

        $validatedData = $request->validated();
        $id = $this->addUuid($validatedData);
        $data = SprintData::from($validatedData);

        DB::beginTransaction();
        try {
            ProjectAggregate::retrieve($id)
                ->createSprint($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        $sprint = app(LoadSprintAction::class)($id);
        return $this->okResponse(SprintResource::make($sprint));
    }

    /**
     * @OA\Put(
     *     path="/company/v1/sprints/{sprint}",
     *     tags={"Sprints"},
     *     summary="Update sprint",
     *     description="This endpoint is used to update a sprint",
 *          @OA\Parameter(
     *          name="sprint",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="string", format="uuid"),
     *          description="The ID of the sprint"
     *      ),
     *
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="project_id",
     *                  type="string",
     *                  format="uuid",
     *                  example="9d68cb84-f2a9-462f-aba7-ce35a68a955a"
     *              ),
     *              @OA\Property(property="number", type="integer", example="2"),
     *              @OA\Property(property="start", type="string", format="date-time", example="2024-11-10"),
     *              @OA\Property(property="end", type="string", format="date-time", example="2024-11-24"),
     *              @OA\Property(property="goal", type="string", example="sprint goal"),
     *              @OA\Property(property="status", type="string", example="pending"),
     *              @OA\Property(
     *                  property="tasks",
     *                  type="array",
     *                  @OA\Items(
     *                      type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955c",
     *                  )
     *              )
     *          )
     *      ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="OK"),
     *               @OA\Property(
     *                   property="data",
     *                   ref="#/components/schemas/Company_FullSprintResponse"
     *               ),
     *               @OA\Property(property="meta", type="object", example=null),
     *           )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="Bad request")
     *           )
     *      ),
     *      @OA\Response(
     *           response=422,
     *           description="Validation failed",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="Unprocessable Content"),
     *               @OA\Property(property="errors", type="array",
     *                    @OA\Items(type="string", example="The goal field is required."),
     *               ),
     *           )
     *       )
     * )
     * */
    public function update(UpdateSprintRequest $request, Sprint $sprint): JsonResponse
    {
        Gate::authorize('update', $sprint);

        $validatedData = $request->all();
        $data = SprintData::from($validatedData);

        DB::beginTransaction();
        try {
            ProjectAggregate::retrieve($this->generateUuid())
                ->updateSprint($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        $sprint = app(LoadSprintAction::class)($sprint->id);
        return $this->okResponse(SprintResource::make($sprint));
    }

    /**
     * @OA\Delete(
     *     path="/company/v1/sprints/{sprint}",
     *     tags={"Sprints"},
     *     summary="Delete sprint",
     *     description="This endpoint is used to delete a sprint",
     *          @OA\Parameter(
     *          name="sprint",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="string", format="uuid"),
     *          description="The ID of the sprint"
     *      ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="OK"),
     *              @OA\Property(property="data", type="array", @OA\Items(type="object")),
     *              @OA\Property(property="meta", type="object", example=null),
     *          ),
     *     )
     * )
     * */
    public function destroy(Sprint $sprint): JsonResponse
    {
        Gate::authorize('delete', $sprint);

        DB::beginTransaction();
        try {
            ProjectAggregate::retrieve($this->generateUuid())
                ->deleteSprint($sprint->id)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        return $this->okResponse();
    }
}
