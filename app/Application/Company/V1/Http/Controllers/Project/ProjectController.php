<?php

namespace App\Application\Company\V1\Http\Controllers\Project;

use App\Application\Company\V1\Http\Requests\Project\CreateProjectRequest;
use App\Application\Company\V1\Http\Requests\Project\UpdateProjectRequest;
use App\Application\Company\V1\Http\Resources\Company\TeamPaginatedResource;
use App\Application\Company\V1\Http\Resources\Project\ProjectPaginatedResource;
use App\Application\Company\V1\Http\Resources\Project\ProjectResource;
use App\Domain\Project\Actions\GetProjectsAction;
use App\Domain\Project\Actions\LoadProjectAction;
use App\Domain\Project\DataTransferObjects\ProjectData;
use App\Domain\Project\ProjectAggregate;
use App\Domain\Project\Projections\Project;
use App\Support\Bases\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations\OpenApi AS OA;
use Exception;

class ProjectController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/company/v1/projects",
     *     tags={"Projects"},
     *     summary="Get projects",
     *     description="Get projects",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="OK"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Company_ProjectPaginatedResponse")
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 ref="#/components/schemas/PaginationMeta"
     *             )
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        Gate::authorize('viewAny', Project::class);

        $userId = auth()->user()->id;
        $projects = app(GetProjectsAction::class)($userId);

        return $this->okResponse(ProjectPaginatedResource::collection($projects));
    }

    /**
     * @OA\Get(
     *     path="/company/v1/projects/{project}",
     *     tags={"Projects"},
     *     summary="Get a specific project",
     *     description="Retrieve details of a specific project by its ID",
     *     @OA\Parameter(
     *         name="project",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid"),
     *         description="The ID of the project"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="OK"),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Company_FullProjectResponse"
     *             ),
     *             @OA\Property(property="meta", type="object", example=null),
     *         ),
     *     )
     * )
     */
    public function show(Project $project): JsonResponse
    {
        Gate::authorize('view', $project);

        return $this->okResponse(ProjectResource::make($project->load(['companies', 'departments', 'sprints', 'tasks'])));
    }

    /**
     * @OA\Post(
     *     path="/company/v1/projects",
     *     tags={"Projects"},
     *     summary="Create project",
     *     description="This endpoint is used to create a new project",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="mX"),
     *             @OA\Property(property="description", type="string", example="A project description"),
     *             @OA\Property(
     *                 property="companies",
     *                 type="array",
     *                 @OA\Items(type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955a")
     *             ),
     *             @OA\Property(
     *                 property="departments",
     *                 type="array",
     *                 @OA\Items(type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955b")
     *             ),
     *             @OA\Property(
     *                 property="sprint",
     *                 type="object",
     *                 required={"number", "start", "end", "goal"},
     *                 @OA\Property(property="number", type="integer", example=1),
     *                 @OA\Property(property="start", type="string", format="date", example="2024-11-04"),
     *                 @OA\Property(property="end", type="string", format="date", example="2024-12-04"),
     *                 @OA\Property(property="goal", type="string", example="Complete feature X")
     *             ),
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
     *                  ref="#/components/schemas/Company_FullProjectResponse"
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
     *                   @OA\Items(type="string", example="The name field is required."),
     *              ),
     *          )
     *      )
     * )
     */
    public function store(CreateProjectRequest $request): JsonResponse
    {
        Gate::authorize('create', Project::class);

        $validatedData = $request->validated();
        $id = $this->addUuid($validatedData);
        $data = ProjectData::from($validatedData);

        DB::beginTransaction();
        try {
            ProjectAggregate::retrieve($id)
                ->createProject($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        $project = app(LoadProjectAction::class)($id);
        return $this->okResponse(ProjectResource::make($project));
    }

    /**
     * @OA\Put(
     *     path="/company/v1/projects/{project}",
     *     tags={"Projects"},
     *     summary="Update project",
     *     description="This endpoint is used to update a project",
 *          @OA\Parameter(
     *          name="project",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="string", format="uuid"),
     *          description="The ID of the project"
     *      ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="mX"),
     *             @OA\Property(property="description", type="string", example="mX"),
     *             @OA\Property(property="companies", type="array",
     *                  @OA\Items(type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955a")
     *             ),
     *              @OA\Property(property="departments", type="array",
     *                   @OA\Items(type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955a")
     *              ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="OK"),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Company_FullProjectResponse"
     *              ),
     *              @OA\Property(property="meta", type="object", example=null),
     *          ),
     *     )
     * )
     * */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        Gate::authorize('update', $project);

        $validatedData = $request->all();
        $data = ProjectData::from($validatedData);

        DB::beginTransaction();
        try {
            ProjectAggregate::retrieve($this->generateUuid())
                ->updateProject($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        $project = app(LoadProjectAction::class)($project->id);
        return $this->okResponse(ProjectResource::make($project));
    }

    /**
     * @OA\Delete(
     *     path="/company/v1/projects/{project}",
     *     tags={"Projects"},
     *     summary="Delete project",
     *     description="This endpoint is used to delete a project",
     *          @OA\Parameter(
     *          name="project",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="string", format="uuid"),
     *          description="The ID of the project"
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
    public function destroy(Project $project): JsonResponse
    {
        Gate::authorize('delete', $project);

        DB::beginTransaction();
        try {
            ProjectAggregate::retrieve($this->generateUuid())
                ->deleteProject($project->id)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        return $this->okResponse();
    }
}
