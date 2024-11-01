<?php

namespace App\Domain\Client\DataTransferObjects;

use App\Domain\Client\Contracts\UserDataBuilderContract;
use App\Domain\Company\DataTransferObjects\CompanyData;
use App\Domain\Company\DataTransferObjects\CompanyDepartmentData;
use App\Domain\Company\DataTransferObjects\DepartmentTeamData;
use App\Support\Bases\BaseData;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class UserData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public ?string $email,
        public ?string $password,
        public ?string $bearerToken,
        #[DataCollectionOf(CompanyData::class)]
        public ?array $companies,
        public ?CompanyDepartmentData $departments,
        public ?DepartmentTeamData $teams,
//        public ?CarbonImmutable $createdAt,
//        public ?CarbonImmutable $updatedAt,
    ) {
    }

    protected static function builder(): UserDataBuilderContract
    {
        return app(UserDataBuilderContract::class);
    }

    public static function fromUserRegister(array $data): UserData
    {
        return self::builder()
            ->setId($data['id'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setBearerToken(null)
            ->setCompaniesData([
                'address' => $data['address'],
                'contact_number' => $data['contact_number']
            ])
            ->setDepartmentsData([])
            ->setTeamsData([])
            ->build();
    }

    public static function fromUserLogin(array $data): UserData
    {
        return self::builder()
            ->setId(null)
            ->setName(null)
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setBearerToken(null)
            ->setDepartmentsData([])
            ->setTeamsData([])
            ->build();
    }

    public static function fromResponse(array $data): UserData
    {
        return self::builder()
            ->setId($data['id'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setBearerToken($data['bearer_token'] ?? null)
            ->setCompaniesData($data['companies'])
            ->setDepartmentsData($data['departments'])
            ->setTeamsData($data['teams'])
            ->build();
    }
}
