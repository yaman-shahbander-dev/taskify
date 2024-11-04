<?php

namespace App\Application\Company\V1\Http\Controllers\Company;

use App\Application\Company\V1\Http\Requests\Client\CreateDepartmentRequest;
use App\Application\Company\V1\Http\Requests\Client\UpdateDepartmentRequest;
use App\Application\Company\V1\Http\Resources\Company\CompanyDepartmentPaginatedResource;
use App\Application\Company\V1\Http\Resources\Company\CompanyDepartmentResource;
use App\Domain\Company\Actions\GetCompanyDepartmentsAction;
use App\Domain\Company\Actions\LoadDepartmentAction;
use App\Domain\Company\Aggregates\DepartmentAggregate;
use App\Domain\Company\DataTransferObjects\CreateDepartmentData;
use App\Domain\Company\DataTransferObjects\UpdateDepartmentData;
use App\Domain\Company\Projections\CompanyDepartment;
use App\Support\Bases\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use OpenApi\Annotations\OpenApi AS OA;
use Exception;

class DepartmentController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/company/v1/departments",
     *     tags={"Departments"},
     *     summary="Get departments",
     *     description="Get departments",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="OK"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Company_CompanyDepartmentPaginatedResponse")
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
        Gate::authorize('viewAny', CompanyDepartment::class);

        $userId = auth()->user()->id;
        $departments = app(GetCompanyDepartmentsAction::class)($userId);

        return $this->okResponse(CompanyDepartmentPaginatedResource::collection($departments));
    }

    /**
     * @OA\Get(
     *     path="/company/v1/departments/{department}",
     *     tags={"Departments"},
     *     summary="Get a specific department",
     *     description="Retrieve details of a specific department by its ID",
     *     @OA\Parameter(
     *         name="department",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid"),
     *         description="The ID of the department"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="OK"),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Company_fullCompanyDepartmentResponse"
     *             ),
     *             @OA\Property(property="meta", type="object", example=null),
     *         ),
     *     )
     * )
     */
    public function show(CompanyDepartment $department): JsonResponse
    {
        Gate::authorize('view', $department);

        return $this->okResponse(CompanyDepartmentResource::make($department->load(['company', 'departmentTeams'])));
    }

    /**
     * @OA\Post(
     *     path="/company/v1/departments",
     *     tags={"Departments"},
     *     summary="Create department",
     *     description="This endpoint is used to create a new department",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="company_id", type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955a"),
     *             @OA\Property(property="name", type="string", example="mX"),
     *             @OA\Property(property="team_name", type="string", nullable=true, example="team Z"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="OK"),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Company_fullCompanyDepartmentResponse"
     *              ),
     *              @OA\Property(property="meta", type="object", example=null),
     *          ),
     *     )
     * )
     * */
    public function store(CreateDepartmentRequest $request): JsonResponse
    {
        Gate::authorize('create', CompanyDepartment::class);

        $validatedData = $request->validated();
        $id = $this->addUuid($validatedData);
        $data = CreateDepartmentData::from($validatedData);

        DB::beginTransaction();
        try {
            DepartmentAggregate::retrieve($id)
                ->createDepartment($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        $department = app(LoadDepartmentAction::class)($id);
        return $this->okResponse(CompanyDepartmentResource::make($department));
    }

    /**
     * @OA\Put(
     *     path="/company/v1/departments/{department}",
     *     tags={"Departments"},
     *     summary="Update department",
     *     description="This endpoint is used to update a department",
 *          @OA\Parameter(
     *          name="department",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="string", format="uuid"),
     *          description="The ID of the department"
     *      ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="mX"),
     *             @OA\Property(property="team_name", type="string", nullable=true, example="team X"),
     *             @OA\Property(property="team_id", type="string", format="uuid", example="9d68cb84-f2a9-462f-aba7-ce35a68a955a"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="OK"),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Company_fullCompanyDepartmentResponse"
     *              ),
     *              @OA\Property(property="meta", type="object", example=null),
     *          ),
     *     )
     * )
     * */
    public function update(UpdateDepartmentRequest $request, CompanyDepartment $department): JsonResponse
    {
        Gate::authorize('update', $department);

        $validatedData = $request->all();
        $data = UpdateDepartmentData::from($validatedData);

        DB::beginTransaction();
        try {
            DepartmentAggregate::retrieve($this->generateUuid())
                ->updateDepartment($data)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        $department = app(LoadDepartmentAction::class)($data->id);
        return $this->okResponse(CompanyDepartmentResource::make($department));
    }

    /**
     * @OA\Delete(
     *     path="/company/v1/departments/{department}",
     *     tags={"Departments"},
     *     summary="Delete department",
     *     description="This endpoint is used to delete a department",
     *          @OA\Parameter(
     *          name="department",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="string", format="uuid"),
     *          description="The ID of the department"
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
    public function destroy(CompanyDepartment $department): JsonResponse
    {
        Gate::authorize('delete', $department);

        DB::beginTransaction();
        try {
            DepartmentAggregate::retrieve($this->generateUuid())
                ->deleteDepartment($department->id)
                ->persist();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            $this->failedResponse($exception->getMessage());
        }

        return $this->okResponse();
    }
}
