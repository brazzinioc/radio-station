<?php

namespace Tests\Feature\Http\Controller\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /***********************************
    *          LOGIN USER
    ************************************/


    /**
     * Test if the Login answer back with error message if the email invalid format
     *
     * @return void
    */
    public function test_login_answer_back_with_error_with_invalid_email_format()
    {
        $response = $this->postJson(route('login'), [ 'email' => 'my_email**000', 'password' => 'myP@ssw0rd01', 'name' => 'spa' ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'email',
                    ]
                ])
                ->assertJson([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'email' => [ 'Type a valid email address.' ],
                    ]
                ]);

    }



    /**
     * Test if the Login answer back with error message if the user is not found.
     *
     * @return void
     */
    public function test_login_answer_back_with_error_with_invalid_credentials()
    {
        $response = $this->postJson(route('login'), ['email' => $this->faker->email, 'password' => 'password', 'name' => 'spa']);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
                ->assertJsonStructure([
                    'message'
                ])
                ->assertJson([
                    'message' => 'unauthorized'
                ]);
    }


    /**
     * Test if the Login answer back with error message if the credentials are empty.
     *
     * @return void
     */
    public function test_login_answer_back_with_error_with_empty_credentials()
    {
        $response = $this->postJson(route('login'), ['email' => '', 'password' => '', 'name' => '']);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'email',
                    'password',
                    'name',
                ]
            ])
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email address is required.'],
                    'password' => ['The password is required.'],
                    'name' => ['The client name is required.'],
                ]
            ]);
    }


    /**
     * Test if the Login route answer back with error message if the email is unverified.
     *
     * @return void
     */
    public function test_login_answer_back_with_error_with_email_unverified()
    {
        // Create a User with unverified email
        $user = User::factory()->create(['email_verified_at' => null, 'password' => 'myp@ssw0rd123']);

        $response = $this->postJson(route('login'), ['email' => $user->email, 'password' => 'myp@ssw0rd123', 'name' => 'spa']);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)
            ->assertJsonStructure([
                'message'
            ])
            ->assertJson([
                'message' => 'unauthorized'
            ]);
    }


    /**
     * Test if the Login route is working with a email verified
     *
     * @return void
     */
    public function test_login_with_email_verified()
    {
        //Create a User with email verified
        $user = User::factory()->create(['email_verified_at' => now()]);

        $response = $this->postJson(route('login'), ['email' => $user->email, 'password' => 'password', 'name' => 'spa']);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'token',
                'message'
            ])
            ->assertJson([
                'message' => 'success'
            ]);
    }


    /***********************************
    *          REGISTER USER
    ************************************/


    /**
     * Test if the Login answer back with error message if the parameters are invalid.
     *
     * @return void
     */
    public function test_register_answer_back_with_error_with_invalid_parameters()
    {
        $response = $this->postJson(route('register'), [ 'name' => 'm', 'lastName' => 'l', 'email' => 'my_email', 'password' => 'myp@2*', 'password_confirmation' => 'myp@2*' ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'name',
                        'lastName',
                        'email',
                        'password',
                        'password_confirmation'
                    ]
                ])
                ->assertJson([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'name' => ['The name must be at least 2 characters.'],
                        'lastName' => ['The last name must be at least 2 characters.'],
                        'email' => ['Type a valid email address.'],
                        'password' => ['The password must be at least 8 characters.'],
                        'password_confirmation' => ['The password confirmation must be at least 8 characters.']
                    ]
                ]);
    }


    /**
     * Test if the Register route answer back with error with empty parameters.
     *
     * @return void
     */
    public function test_register_answer_back_with_error_with_empty_parameters()
    {
        $response = $this->postJson( route('register'), [ 'name' => '', 'lastName' => '', 'email' => '', 'password' => '', 'password_confirmation'] );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'name',
                        'lastName',
                        'email',
                        'password',
                    ]
                ])
                ->assertJson([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'name' => ['The name is required.'],
                        'lastName' => ['The last name is required.'],
                        'email' => ['The email address is required.'],
                        'password' => ['The password is required.'],
                        'password_confirmation' => [ 'The password confirmation is required.' ]
                    ]
                ]);
    }


    /**
     * Test if the Register route answer back with error with invalid email format
     *
     * @return void
     */
    public function test_register_answer_back_with_error_with_invalid_email_format()
    {

        $response = $this->postJson( route('register'), [ 'name' => $this->faker->name, 'lastName' => $this->faker->lastName, 'email' => 'my_e$email*001', 'password' => 'myP@ssw0rd345', 'password_confirmation' => 'myP@ssw0rd345' ] );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'email',
                    ]
                ])
                ->assertJson([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'email' => ['Type a valid email address.'],
                    ]
                ]);
    }


    /**
     * Test if the Register route answer back with error with email taked
     *
     * @return void
     */
    public function test_register_answer_back_with_error_with_email_taked()
    {
        $password = $this->faker->password(8, 255);

        $user = User::factory()->create( [ 'password' => bcrypt($password) ]);

        $response = $this->postJson( route('register'), [ 'name' => $this->faker->name, 'lastName' => $this->faker->lastName, 'email' => $user->email, 'password' => $password, 'password_confirmation' => $password ] );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
                ->assertJsonStructure([
                    'message',
                    'errors' => [
                        'email',
                    ]
                ])
                ->assertJson([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'email' => ['The email address is already in use.'],
                    ]
                ]);
    }



    /**
     * Test if the Register route is working with valid parameters
     *
     * @return void
    */
    public function test_register_is_working_with_valid_parameters()
    {
        // Run the DatabaseSeeder because User creation use Role table.
        $this->seed();

        $password = $this->faker->password(8, 255);

        $user =  [ 'name' => $this->faker->name,
                    'lastName' => $this->faker->lastName(),
                    'email' => $this->faker->email(),
                    'password' => $password,
                    'password_confirmation' => $password
                ];

        $response = $this->postJson( route('register'), $user );

        $response->assertStatus(Response::HTTP_CREATED)
                ->assertJsonStructure([
                    'data' => [ 'id', 'name', 'lastName', 'email']
                ])
                ->assertJson([
                    'data' => [
                        'name' => $user['name'],
                        'lastName' => $user['lastName'],
                        'email' => $user['email'],
                    ]
                ]);

        $this->assertDatabaseHas('users', [ 'id' => $response['data']['id'] , 'name' => $user['name'], 'last_name' => $user['lastName'] , 'email' => $user['email'] ]);
        $this->assertDatabaseHas('model_has_roles', [ 'model_id' => $response['data']['id'], 'model_type' => 'App\Models\User', 'role_id' => 4 ]); // validate if user has Listener role.
    }

}
