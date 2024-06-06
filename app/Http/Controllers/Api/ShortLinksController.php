<?php

namespace App\Http\Controllers\Api;

use App\Models\LinkRedirect;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Validator;

class ShortLinksController extends Controller
{

     /**
     * Generates a token for the first user in the database and returns it as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the access token and token type.
     */
    public function generate() {

        $user = User::all()->first();
        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer'], 200);
    }

    /**
     * Retrieves all the links from the database and returns them as a JSON response.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status and links.
     */
    public function index()
    {
        $links = LinkRedirect::all();

        if($links->count() > 0) {
            return response()->json([
                'status' => 200,
                'links' => $links
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No links found'
            ], 404);
        }
    }

    /**
     * Store a new link in the database.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status and message.
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'originalLink' => 'required|url',
            'redirectString' => 'required|string|max:25'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $link = LinkRedirect::create([
                'redirect_from' => request('originalLink'),
                'redirect_to' => request('redirectString')
            ]);

            if(!$link) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'Link created successfully'
                ], 200);
            }

        }
    }

     /**
     * Retrieves a link from the database based on the provided code and returns it as a JSON response.
     *
     * @param string $code The code of the link to be retrieved.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the link if found, or an error message if not found.
     */
    public function show($code)
    {
        $link = LinkRedirect::where('redirect_to', $code)->first();

        if ($link) {
            return response()->json([
                'status' => 200,
                'link' => $link
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Link not found'
            ], 404);
        }
    }

     /**
     * Deletes a link from the database based on the provided code.
     *
     * @param string $code The code of the link to be deleted.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating the success or failure of the deletion.
     */
    public function delete($code) {
        $link = LinkRedirect::where('redirect_to', $code)->first();
        if ($link) {
            $link->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Link deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Link not found'
            ], 404);
        }
    }

     /**
     * Update a link with the given code.
     *
     * @param string $code The code of the link to update.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the status and message.
     */
    public function update($code) {
        $validator = Validator::make(request()->all(), [
            'originalLink' => 'required|url',
            'redirectString' => 'required|string|max:25'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {

            $link = LinkRedirect::where('redirect_to', $code)->first();

            if(!$link) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            } else {
                $link = LinkRedirect::where('redirect_to', $code)->first();

                $link->update([
                   'redirect_from' => request('originalLink'),
                    'redirect_to' => request('redirectString')
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Link updated successfully'
                ], 200);
            }

        }
    }

}
