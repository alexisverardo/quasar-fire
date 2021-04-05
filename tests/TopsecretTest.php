<?php
namespace Tests;

use Tests\TestCase;

class TopsecretTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_topsecret_request()
    {
        $response = $this->postJson("/topsecret",
            ["satelites" =>
                [
                    [
                        "name" => "kenobi",
                        "distance" => 100.0,
                        "message" => ["este", "", "", "mensaje", ""]
                    ],
                    [
                        "name" => "skywalker",
                        "distance" => 115.5,
                        "message" => ["", "es", "", "", "secreto"]
                    ],
                    [
                        "name" => "sato",
                        "distance" => 142.7,
                        "message" => ["este", "", "un", "", ""]
                    ],
                ]
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson([
                "position" => ["x" => -202.78354166666668, "y" => 608.672988888889],
                "message" => "este es un mensaje secreto"
            ]);
    }

    public function test_topsecret_request_error()
    {
        $response = $this->postJson("/topsecret",
            ["satelites" =>
                [
                    [
                        "name" => "kenobi",
                        "message" => ["este", "", "", "mensaje", ""]
                    ],
                    [
                        "name" => "skywalker",
                        "distance" => 115.5
                    ],
                    [
                        "name" => "sato",
                        "distance" => 142.7,
                        "message" => ["este", "", "un", "", ""]
                    ],
                ]
            ]
        );

        $response
            ->assertStatus(404)
            ->assertJson(["message" => "No se pudo determinar la posición o el mensaje"]);
    }
}
