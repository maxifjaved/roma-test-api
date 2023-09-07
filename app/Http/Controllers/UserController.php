<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInstall;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function saveUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'role' => 'required',
            'status' => 'required|boolean',
        ]);

        UserInstall::updateOrCreate(
            [
                'user_ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ],
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'address' => $request->input('address'),
                'role' => $request->input('role'),
                'status' => !!$request->input('status'),
            ]
        );

        return response()->json(['message' => 'User saved successfully']);
    }

    public function sendEvent(Request $request)
    {

        $request->validate([
            'event_name' => 'required',
        ]);

        $ip = $request->ip();
        $userAgent = $request->userAgent();

        $userInstall = UserInstall::where('user_ip', $ip)
            ->where('user_agent', $userAgent)
            ->first();

        if (!$userInstall) {
            return response()->json(['message' => 'User install not found'], 404);
        }

        $client = new Client();
        $thirdPartyUrl = config('app.user_install_3rd_party_url');

        try {
            $response = $client->post($thirdPartyUrl, [
                'form_params' => [
                    'event_name' => $request->input('event_name'),
                    'name' => $userInstall->name,
                    'email' => $userInstall->email,
                    'mobile' => $userInstall->mobile,
                    'address' => $userInstall->address,
                    'role' => $userInstall->role,
                    'status' => $userInstall->status,
                ],
            ]);
            
            if ($response->getStatusCode() === 200) {
                return response()->json(['message' => 'Event sent successfully']);
            } else {
                return response()->json(['message' => 'Event sending failed'], $response->getStatusCode());
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred while sending event'], 500);
        }
    }
}
