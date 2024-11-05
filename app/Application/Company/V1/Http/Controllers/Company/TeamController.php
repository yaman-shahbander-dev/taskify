<?php

namespace App\Application\Company\V1\Http\Controllers\Company;

use App\Application\Company\V1\Http\Requests\Client\CreateTeamRequest;
use App\Application\Company\V1\Http\Requests\Client\UpdateTeamRequest;
use App\Application\Company\V1\Http\Resources\Company\TeamPaginatedResource;
use App\Application\Company\V1\Http\Resources\Company\TeamResource;
use App\Domain\Company\Actions\GetTeamsAction;
use App\Domain\Company\Actions\LoadTeamAction;
use App\Domain\Company\CompanyAggregate;
use App\Domain\Company\DataTransferObjects\DepartmentTeamData;
use App\Domain\Company\Projections\DepartmentTeam;
use App\Support\Bases\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations\OpenApi AS OA;
use Exception;

class TeamController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/company/v1/teams",
     *     tags={"Teams"},
     *     summary="Get teams",
     *     description="Get teams",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="OK"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Company_TeamPaginatedResponse")
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
        Gate::authorize('viewAny', DepartmentTeam::class);

        $userId = auth()->user()->id;
        $teams = app(GetTeamsAction::class)($userId);

        return $this->okResponse(TeamPaginatedResource::collection($teams));
    }

    /**
     * @OA\Get(
     *     path="/company/v1/teams/{team}",
     *     tags={"Teams"},
     *     summary="Get a specific team",
     *     description="Retrieve details of a specific team by its ID",
     *     @OA\Parameter(
     *         name="team",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid"),
     *         description="The ID of the team"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="OK"),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Company_fullTeamResponse"
     *             ),
     *             @OA\Property(property="meta", type="object", example=null),
     *         ),
     *     )
     * )
     */
    public function show(DepartmentTeam $team): JsonResponse
    {
        Gate::authorize('view', $team);

        return $this->okResponse(TeamResource::make($team->load(['companyDepartment', 'company'])));
    }

    /**
     * @OA\Post(
     *     path="/company/v1/teams",
     *     tags={"Teams"},
     *     summary="Create team",
     *     description="This endpoint is used to create a new team",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="department_id", type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955a"),
     *             @OA\Property(property="name", type="string", example="mX"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="OK"),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Company_fullTeamResponse"
     *              ),
     *              @OA\Property(property="meta", type="object", example=null),
     *          ),
     *     )
     * )
     * */
    public function store(CreateTeamRequest $request): JsonResponse
    {
        Gate::authorize('create', DepartmentTeam::class);

        $validatedData = $request->validated();
        $id = $this->addUuid($validatedData);
        $data = DepartmentTeamData::from($validatedData);

        DB::beginTransaction();
        try {
            CompanyAggregate::retrieve($id)
                ->createTeam($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        $team = app(LoadTeamAction::class)($id);
        return $this->okResponse(TeamResource::make($team));
    }

    /**
     * @OA\Put(
     *     path="/company/v1/teams/{team}",
     *     tags={"Teams"},
     *     summary="Update team",
     *     description="This endpoint is used to update a team",
 *          @OA\Parameter(
     *          name="team",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="string", format="uuid"),
     *          description="The ID of the team"
     *      ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="mX"),
     *             @OA\Property(property="department_id", type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955a"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="OK"),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Company_fullTeamResponse"
     *              ),
     *              @OA\Property(property="meta", type="object", example=null),
     *          ),
     *     )
     * )
     * */
    public function update(UpdateTeamRequest $request, DepartmentTeam $team): JsonResponse
    {
        Gate::authorize('update', $team);

        $validatedData = $request->all();
        $data = DepartmentTeamData::from($validatedData);

        DB::beginTransaction();
        try {
            CompanyAggregate::retrieve($this->generateUuid())
                ->updateTeam($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        $team = app(LoadTeamAction::class)($data->id);
        return $this->okResponse(TeamResource::make($team));
    }

    /**
     * @OA\Delete(
     *     path="/company/v1/teams/{team}",
     *     tags={"Teams"},
     *     summary="Delete team",
     *     description="This endpoint is used to delete a team",
     *          @OA\Parameter(
     *          name="team",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="string", format="uuid"),
     *          description="The ID of the team"
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
    public function destroy(DepartmentTeam $team): JsonResponse
    {
        Gate::authorize('delete', $team);

        try {
            CompanyAggregate::retrieve($this->generateUuid())
                ->deleteTeam($team->id)
                ->persist();

        } catch (Exception $exception) {
            $this->failedResponse($exception->getMessage());
        }

        return $this->okResponse();
    }
}
