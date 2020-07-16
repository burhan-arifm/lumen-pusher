<?php

use Carbon\Carbon;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * User Test
 * 
 * @author Burhan Arif M <burhan.arifm@hotmail.com>
 * @version 1.0
 */
class UserTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testItShouldCreateANewUser()
    {
        $this->expectsEvents('App\Events\UserCreated');
        $user = factory('App\Models\User')->make()->getAttributes();

        $response = $this->call('POST', '/user', $user);
        
        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('users', $user);
    }

    public function testItShouldGetAllSavedUser()
    {
        $users = factory('App\Models\User', 5)->create();

        $response = $this->call('GET', '/user');
        $response_content = json_decode($response->content());

        $this->assertEquals(200, $response->status());
        $this->assertCount(5, $response_content->users);
    }

    public function testItShouldGetASpecificUserByGivenId()
    {
        $users = factory('App\Models\User', 5)->create();

        $response = $this->call('GET', '/user/3');
        $response_content = json_decode($response->content());
        
        $this->assertEquals(200, $response->status());
        $this->assertStringContainsString($users[2]->name, $response_content->user->name);
        $this->assertStringContainsString($users[2]->date_of_birth, $response_content->user->date_of_birth);
        $this->assertStringContainsString($users[2]->job, $response_content->user->job);
    }

    public function testItShouldUpdateAUserDataByGivenId()
    {
        $this->expectsEvents('App\Events\UserUpdated');
        factory('App\Models\User')->create();
        $user['name'] = "Ujang Damin";
        $user['job'] = "Pegawai Kantoran";

        $response = $this->call('PUT', '/user/1', $user);
        $response_content = json_decode($response->content());

        $this->assertEquals(200, $response->status());
        $this->seeInDatabase('users', $user);
        $this->assertStringContainsString($user['name'], $response_content->user->name);
        $this->assertStringContainsString($user['job'], $response_content->user->job);
    }

    public function testItShouldDeleteAUserDataByGivenId()
    {
        $this->expectsEvents('App\Events\UserDeleted');
        $user = factory('App\Models\User')->create()->getAttributes();

        $response = $this->call('DELETE', '/user/1', $user);
        $response_content = json_decode($response->content());

        $this->assertEquals(200, $response->status());
        $this->notSeeInDatabase('users', $user);
        $this->assertEquals("User data with id=1 has been deleted.", $response_content->message);
    }
}