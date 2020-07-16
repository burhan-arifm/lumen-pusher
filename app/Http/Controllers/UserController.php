<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * User Controller
 * 
 * Controller that has functions for create, read, update,
 * and delete User.
 * 
 * @author Burhan Arif M <burhan.arifm@hotmail.com>
 * @version 1.0
 */
class UserController extends Controller
{
    /**
     * add new User and save it to database.
     *
     * @param Request $request data that got from client side
     * @return String HTTP status code
     **/
    public function create(Request $request)
    {
        try {
            $user = User::create([
                'name'          => $request->name,
                'date_of_birth' => $request->date_of_birth,
                'gender'        => $request->gender,
                'address'       => $request->address,
                'email'         => $request->email,
                'job'           => $request->job
            ]);
    
            event(new \App\Events\UserCreated($user));
    
            return response([
                "status" => Response::HTTP_CREATED,
                "message" => "User created.",
                $user
            ], Response::HTTP_CREATED)->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            $http_status_code = get_class($th) == "Illuminate\Broadcasting\BroadcastException" ? Response::HTTP_INTERNAL_SERVER_ERROR : Response::HTTP_BAD_REQUEST;

            return response([
                'status' => $http_status_code,
                'message' => get_class($th) == "Illuminate\Broadcasting\BroadcastException" ? $th->getMessage() : "Incomplete required data.",
            ], $http_status_code);
        }
    }

    /**
     *
     * get User data that saved in database. if id is not null,
     * then it returns User data with given id. else, it 
     * retrieve all User data that saved in database.
     *
     * @param  $id User id that saved in databases.
     * @return JSON User data
     **/
    public function read($id = null)
    {
        try {
            return $id != null
                ? response([
                    "user" => User::findOrFail($id)
                    ])->header('Content-Type', 'application/json')
                : response([
                    "users" => User::all()
                    ])->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            $http_status_code = is_numeric($id) ? Response::HTTP_NOT_FOUND : Response::HTTP_BAD_REQUEST;

            return response([
                'status' => $http_status_code,
                'message' => $th->getMessage()
            ], $http_status_code);
        }
    }

    /**
     *
     * update User data based on given id.
     *
     * @param $id User id
     * @param Request $request new data from client side
     * @return JSON updated user data
     **/
    public function update($id, Request $request)
    {
        try {
            User::findOrFail($id)->update($request->all());

            event(new \App\Events\UserUpdated($id, $request->all()));

            return response([
                "status" => Response::HTTP_OK,
                "message" => "User updated.",
                "user" => User::findOrFail($id)
                ])->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            return response([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => $th->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     *
     * delete a User data from database based on given id.
     *
     * @param $id User id
     * @return String HTTP status code
     **/
    public function delete($id)
    {
        try {
            User::findOrFail($id)->delete();

            event(new \App\Events\UserDeleted($id));
    
            return response([
                "status" => Response::HTTP_OK,
                "message" => "User data with id=$id has been deleted."
                ])->header('Content-Type', 'application/json');
        } catch (\Throwable $th) {
            return response([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "User data not found."
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
