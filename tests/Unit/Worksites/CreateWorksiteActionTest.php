<?php

declare(strict_types=1);

namespace Tests\Unit\Worksites;

use App\Actions\Worksite\CreateWorksiteAction;
use App\Dto\WorksiteDto;
use App\Enums\WorksitePriority;
use App\Enums\WorksiteStatus;
use App\Models\Client;
use App\Models\Worksite;
use Database\Factories\ClientFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestDox;
use Tests\TestCase;

/**
 * @internal
 */
#[CoversClass(CreateWorksiteAction::class)]
final class CreateWorksiteActionTest extends TestCase
{
    use DatabaseTransactions;

    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = ClientFactory::new()->createOne();

    }

    private function makeWorksiteDto(array $overrides = []): WorksiteDto
    {
        return new WorksiteDto(
            client_id: $overrides['client_id'] ?? $this->client->id,
            code: $overrides['code'] ?? null,
            nameWorksite: $overrides['nameWorksite'] ?? 'Chantier Test',
            description: $overrides['description'] ?? 'Une description test',
            startDate: $overrides['startDate'] ?? Carbon::parse('2026-01-01'),
            endDate: $overrides['endDate'] ?? Carbon::parse('2026-12-31'),
            worksitePriority: $overrides['worksitePriority'] ?? WorksitePriority::High,
            worksiteStatus: $overrides['worksiteStatus'] ?? WorksiteStatus::Pending,
            street: $overrides['street'] ?? '12 rue de la Paix',
            city: $overrides['city'] ?? 'Paris',
            zip_code: $overrides['zip_code'] ?? 75001,
            country: $overrides['country'] ?? 'France',
        );
    }

    #[TestDox(
        'Given Worksite and a valid WorksiteDto
        When I call CreateWorksiteAction
        Then it should return a Worksite instance'
    )]
    public function test_should_return_a_worksite_instance(): void
    {
        $dto = $this->makeWorksiteDto();

        $result = (new CreateWorksiteAction())($dto);

        $this->assertNotNull($result->id);
        $this->assertNotNull($result->created_at);
    }

    #[TestDox(
        'Given a valid WorksiteDto with all fields
        When I call CreateWorksiteAction
        Then the worksite should be persisted in database with correct data'
    )]
    public function test_should_persist_worksite_in_database_with_correct_data(): void
    {
        $dto = $this->makeWorksiteDto([
            'nameWorksite' => 'Mon Chantier Marseille',
            'city' => 'Marseille',
            'zip_code' => 13001,
        ]);

        (new CreateWorksiteAction())($dto);

        $this->assertDatabaseHas('worksites', [
            'client_id' => $this->client->id,
            'name_worksite' => 'Mon Chantier Marseille',
            'city' => 'Marseille',
            'zip_code' => 13001,
            'country' => 'France',
        ]);
    }

    #[TestDox(
        'Given a WorksiteDto without code
        When I call CreateWorksiteAction
        Then the action should auto-generate a code matching format FR{5digits}A'
    )]
    public function test_should_auto_generate_code_when_not_provided(): void
    {
        // On force code = null pour déclencher la génération automatique
        $dto = $this->makeWorksiteDto(['code' => null]);

        /** @var Worksite $result */
        $result = (new CreateWorksiteAction())($dto);

        // assertMatchesRegularExpression : vérifie le format FR + 5 chiffres + A
        $this->assertMatchesRegularExpression(
            '/^FR\d{5}A$/',
            $result->code,
            "Le code généré [{$result->code}] ne respecte pas le format FR{5chiffres}A"
        );
    }

    #[TestDox(
        'Given a WorksiteDto with a specific code
        When I call CreateWorksiteAction
        Then the worksite should use the provided code without modification'
    )]
    public function test_should_use_provided_code_without_modification(): void
    {
        $dto = $this->makeWorksiteDto(['code' => 'FR12345A']);

        $result = (new CreateWorksiteAction())($dto);

        $this->assertEquals('FR12345A', $result->code);
    }

    #[TestDox(
        'Given a valid WorksiteDto
        When I call CreateWorksiteAction
        Then exactly one worksite should exist in database'
    )]
    public function test_should_create_exactly_one_worksite_in_database(): void
    {
        $dto = $this->makeWorksiteDto();

        (new CreateWorksiteAction())($dto);

        $this->assertDatabaseCount('worksites', 1);
    }
}
