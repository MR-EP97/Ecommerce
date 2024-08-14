<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Models\Feature;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_feature(): void
    {
        $param = ['name' => fake()->word];

        $response = $this->postJson(route('features.store'), $param);

        $response->assertStatus(HttpResponse::HTTP_CREATED)
            ->assertJsonStructure([
                'status',
                'message',
                'feature',
            ]);

        $this->assertDatabaseHas('features', [
            'name' => $param['name'],
        ]);
    }

    public function test_update_feature(): void
    {

        $feature = Feature::factory()->create();
        $latest_name = $feature->name;
        $name = fake()->unique()->word;
        $updatedFeature = [
            'name' => $name,
        ];

        $response = $this->putJson(route('features.update', $feature->id), $updatedFeature);

        $response->assertStatus(HttpResponse::HTTP_OK)
            ->assertJsonStructure([
                'status',
                'message',
                'feature',
            ]);

        $this->assertDatabaseMissing('features', [
            'name' => $latest_name,
        ]);

        $this->assertDatabaseHas('features', [
            'name' => $name,
        ]);
    }

    public function test_delete_feature(): void
    {
        $feature = Feature::factory()->create();
        $deleted_name = $feature->name;


        $response = $this->deleteJson(route('features.destroy', $feature->id));

        $response->assertStatus(204);

        $this->assertDatabaseMissing('features', [
            'name' => $deleted_name,
        ]);

    }
}
