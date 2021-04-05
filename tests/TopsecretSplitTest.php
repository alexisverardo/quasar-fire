<?php
namespace Tests;

use Tests\TestCase;

class TopsecretSplitTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_topsecret_split_request()
    {
        $response = $this->postJson("/topsecret_split/kenobi",
            [
                "distance" => 100.0,
                "message" => ["este", "", "", "mensaje", ""]
            ]
        );
        $response
            ->assertStatus(200)
            ->assertJson(["message" => "satelite store"]);

        $response = $this->postJson("/topsecret_split/skywalker",
            [
                "distance" => 115.5,
                "message" => ["", "es", "", "", "secreto"]
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(["message" => "satelite store"]);

        $response = $this->postJson("/topsecret_split/sato",
            [
                "distance" => 142.7,
                "message" => ["este", "", "un", "", ""]
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(["message" => "satelite store"]);

        $response = $this->getJson("/topsecret_split");

        $response
            ->assertStatus(200)
            ->assertJson([
                "position" => ["x" => -202.78354166666668, "y" => 608.672988888889],
                "message" => "este es un mensaje secreto"
            ]);
    }

    public function test_topsecret_split_request_error()
    {
        $response = $this->postJson("/topsecret_split/sato",
            [
                "distance" => 142.7,
                "message" => ["este", "", "un", "", ""]
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(["message" => "satelite store"]);

        $response = $this->getJson("/topsecret_split");

        $response
            ->assertStatus(404)
            ->assertJson(["message" => "No existe suficiente información"]);
    }
}
