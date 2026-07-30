<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\StopGraffiti\Enums\ReportStatus;
use Modules\StopGraffiti\Models\Report;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config(['services.stop_graffiti.integration_token' => 'integration-test-token']);
});

it('rejects an integration request without the shared token', function (): void {
    $this->postJson('/api/integrations/stop-graffiti/reports', reportPayload())
        ->assertUnauthorized();
});

it('stores an incoming report and its media', function (): void {
    $this->withToken('integration-test-token')
        ->postJson('/api/integrations/stop-graffiti/reports', reportPayload())
        ->assertCreated()
        ->assertJsonPath('external_id', 'KGN-20260729-TEST0001')
        ->assertJsonPath('status', ReportStatus::New->value);

    $report = Report::query()->where('external_id', 'KGN-20260729-TEST0001')->firstOrFail();

    expect($report->media)->toHaveCount(1)
        ->and($report->statusHistory)->toHaveCount(1);
});

it('accepts a retry without creating a duplicate', function (): void {
    $request = fn () => $this->withToken('integration-test-token')
        ->postJson('/api/integrations/stop-graffiti/reports', reportPayload());

    $request()->assertCreated();
    $request()->assertOk();

    expect(Report::query()->count())->toBe(1)
        ->and(Report::query()->firstOrFail()->media()->count())->toBe(1);
});

/**
 * @return array<string, mixed>
 */
function reportPayload(): array
{
    return [
        'id' => 'KGN-20260729-TEST0001',
        'createdAt' => '2026-07-29T12:47:56+00:00',
        'userId' => 1001,
        'recipientId' => 2002,
        'recipientIsChat' => true,
        'category' => 'Наркограффити',
        'address' => 'Курган, ул. Ленина, 10',
        'comment' => 'На фасаде',
        'media' => [
            [
                'type' => 'image',
                'payloadJson' => '{"url":"https://example.test/image.jpg"}',
            ],
        ],
    ];
}
