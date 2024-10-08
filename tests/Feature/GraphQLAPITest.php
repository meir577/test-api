<?php

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

it('executes send message mutation successfully', function () {
    // Arrange
    $query = 'mutation { 
                sendMessage (message: "test 15") 
                { message, sent } 
              }';
    $requestBody = [
        'query' => $query,
    ];

    // Act
    $response = $this->postJson('/user', $requestBody);

    // Assert
    assertTrue($response->json('data.sendMessage.sent'));
    assertEquals($response->getStatusCode(), Response::HTTP_OK);
 });

 it('executes create user mutation successfully', function () {
    // Arrange
    $query = 'mutation { 
                createUser (name: "New test user", email: "newtestuser@gmail.com", password: "testpassword") 
                { id, name, email } 
              }';
    $requestBody = [
        'query' => $query,
    ];

    // Act
    $response = $this->postJson('/user', $requestBody);

    // Assert
    assertNotNull($response->json('data.createUser.id'));
    assertEquals($response->getStatusCode(), Response::HTTP_OK);
 });

 it('executes get user query successfully', function() {
    // Arrange
    $query = 'query { user(id: 1) { id, name, email } }';
    $requestBody = [
        'query' => $query,
    ];
    $user = User::factory()->create();

    // Act
    $response = $this->postJson('/user', $requestBody);

    // Assert
    assertNotNull($response->json('data.user'));
    assertEquals($response->getStatusCode(), Response::HTTP_OK);
    assertSame($response->json('data.user'), $user->only('id', 'name', 'email'));
 });