<?php

declare(strict_types=1);

namespace Tests\Unit\Worksites;

use App\Actions\Worksite\UpdateWorksiteAction;
use App\Dto\WorksiteDto;
use App\Enums\WorksitePriority;
use App\Enums\WorksiteStatus;
use App\Models\Client;
use App\Models\Worksite;
use Database\Factories\ClientFactory;
use Database\Factories\WorksiteFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\TestCase;

/**
 * @internal
 */
#[CoversClass(UpdateWorksiteAction::class)]
final class UpdateWorksiteActionTest extends TestCase
{
    use DatabaseTransactions;

    private Client $client;

    private Worksite $worksite;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = ClientFactory::new()->createOne();

        $this->worksite = WorksiteFactory::new()
            ->createOne([
                'name_worksite' => 'Un autre nouveau Chantier',
                'city' => 'Marseille',
                'code' => 'FR11111A',
                'zip_code' => 13001,
            ]);
    }

    private function makeUpdatedDto(array $overrides = []): WorksiteDto
    {
        return new WorksiteDto(
            client_id: $overrides['client_id'] ?? $this->client->id,
            code: $overrides['code'] ?? 'FR99999A',
            nameWorksite: $overrides['nameWorksite'] ?? 'Nouveau Chantier',
            description: $overrides['description'] ?? 'Description mise à jour',
            startDate: $overrides['startDate'] ?? Carbon::parse('2026-03-01'),
            endDate: $overrides['endDate'] ?? Carbon::parse('2026-11-30'),
            worksitePriority: $overrides['worksitePriority'] ?? WorksitePriority::Low,
            worksiteStatus: $overrides['worksiteStatus'] ?? WorksiteStatus::InProgress,
            street: $overrides['street'] ?? '5 avenue Victor Hugo',
            city: $overrides['city'] ?? 'Bordeaux',
            zip_code: $overrides['zip_code'] ?? 33000,
            country: $overrides['country'] ?? 'France',
        );
    }

    #[TestDox(
        'Given an existing Worksite and a valid WorksiteDto
        When I call UpdateWorksiteAction
        Then it should return a Worksite instance'
    )]
    public function test_should_return_a_worksite_instance(): void
    {
        $dto = $this->makeUpdatedDto();

        $result = (new UpdateWorksiteAction())($this->worksite, $dto);

        $this->assertNotNull($result->id);
        $this->assertNotNull($result->updated_at);
    }

    #[TestDox(
        'Given an existing Worksite and a WorksiteDto with new values
        When I call UpdateWorksiteAction
        Then the new values should be persisted in database'
    )]
    public function test_should_persist_updated_data_in_database(): void
    {
        $dto = $this->makeUpdatedDto([
            'nameWorksite' => 'Chantier Rénové',
            'city' => 'Nantes',
            'zip_code' => 44000,
        ]);

        (new UpdateWorksiteAction())($this->worksite, $dto);

        $this->assertDatabaseHas('worksites', [
            'id' => $this->worksite->id,
            'name_worksite' => 'Chantier Rénové',
            'city' => 'Nantes',
            'zip_code' => 44000,
        ]);

        $this->assertDatabaseMissing('worksites', [
            'id' => $this->worksite->id,
            'name_worksite' => 'Ancien Chantier',
            'city' => 'Marseille',
        ]);
    }

    #[TestDox(
        'Given an existing Worksite and a valid WorksiteDto
        When I call UpdateWorksiteAction
        Then the returned Worksite object should contain the updated values'
    )]
    public function test_should_return_worksite_with_refreshed_values(): void
    {
        $dto = $this->makeUpdatedDto([
            'nameWorksite' => 'Chantier Retourné',
            'city' => 'Toulouse',
        ]);

        $result = (new UpdateWorksiteAction())($this->worksite, $dto);

        $this->assertEquals('Chantier Retourné', $result->name_worksite);
        $this->assertEquals('Toulouse', $result->city);
    }

    #[TestDox(
        'Given an existing Worksite
        When I call UpdateWorksiteAction
        Then no new worksite should be created in database'
    )]
    public function test_should_not_create_new_worksite_on_update(): void
    {
        $dto = $this->makeUpdatedDto();

        (new UpdateWorksiteAction())($this->worksite, $dto);

        $this->assertDatabaseCount('worksites', 1);
    }

    #[TestDox(
        'Given an existing Worksite
        When I call UpdateWorksiteAction
        Then the worksite ID should remain unchanged'
    )]
    public function test_should_keep_same_worksite_id_after_update(): void
    {
        $originalId = $this->worksite->id;
        $dto = $this->makeUpdatedDto();

        $result = (new UpdateWorksiteAction())($this->worksite, $dto);

        $this->assertSame($originalId, $result->id);
    }

    #[TestDox(
        'Given an existing Worksite and a WorksiteDto without code
        When I call UpdateWorksiteAction
        Then a new code should be auto-generated with format FR{5digits}A'
    )]
    public function test_should_auto_generate_code_when_not_provided_on_update(): void
    {
        $dto = $this->makeUpdatedDto(['code' => null]);

        $result = (new UpdateWorksiteAction())($this->worksite, $dto);

        $this->assertMatchesRegularExpression(
            '/^FR\d{5}A$/',
            $result->code,
            "Le code généré [{$result->code}] ne respecte pas le format FR{5chiffres}A"
        );
    }
}
