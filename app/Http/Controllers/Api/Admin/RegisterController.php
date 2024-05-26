<?php

namespace App\Http\Controllers\Api\Admin;

use Throwable;
use App\Models\User;
use App\Models\GeneralImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function index()
    {
        $users = User::orderBy('updated_at', 'desc')->get();
        return response()->json(['status' => 200, 'data' => $users], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $validationResult = $this->validateCreateData($request, null);
        if ($validationResult !== null) {
            return $validationResult;
        }

        try {
            $data = $this->getCreateData($request);
            $data->fill($data->toArray());
            $data->save();
            $tokens = $data->createToken('User')->plainTextToken;
            DB::commit();
            return response()->json(['status' => 201, 'Token' => $tokens, 'message' => 'Admin account created successfully', 'data' => $data], 201);
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return response()->json(['status' => 400, 'message' => 'Admin account created fail'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        // $decryptId = decrypt($id);
        $validationResult = $this->validateUpdateData($request, $id);
        if ($validationResult !== null) {
            return $validationResult;
        }
        try {
            $data = $this->getCreateData($request);
            $users = User::findOrFail($id);
            $users->fill($data->toArray());
            $users->update();

            $imageFileName = $this->base64($request, 'image');// use trait to upload image
            $images = GeneralImage::where('user_id', $id)->get();

            if ($images->isNotEmpty()) {
                foreach ($images as $image) {
                    $image->update([
                        'user_id' => $users->id,
                        'file_path' => $imageFileName,
                    ]);
                }
            } else {
                GeneralImage::create([
                    'user_id' => $users->id,
                    'file_path' => $imageFileName,
                ]);
            }
            DB::commit();
            return response()->json(['status' => 200, 'message' => 'Admin updated successfully', 'data' => $data, 'image' => $image], 200);
        } catch (Throwable $e) {
            report($e);
            DB::rollBack();
            return response()->json(['status' => 400, 'message' => 'Admin updated fail'], 400);
        }
    }

    protected function getCreateData(Request $request)
    {
        $data = [];

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = $request->role_id;
        $data['dob'] = $request->dob;

        return new User($data);
    }

    protected function validateCreateData($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'phone' => [
                'required',
                'regex:/^09\d{9}$/',
                Rule::unique('users')->ignore($id),
            ],
            'dob' => 'required|date|before:today',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
                    ->symbols(),
            ],
            'confirm_password' => 'same:password',
        ], [
            'name.required' => 'Admin Name is required',
            'email.required' => 'email is required',
            'email.unique' => 'Email is already taken',
            'phone.unique' => 'Phone Number is already taken',
            'phone' => 'The phone format is invalid',
            'passsword.required' => 'Password is required',
            'password.min' => 'Password must be at least 8',
            'confirm_password' => 'Confirm password must be the same as password',
            'dob.required' => 'Date of Birth is required' 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return null;
    }

    protected function validateUpdateData($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id)->whereNull('deleted_at'),
            ],
            'phone' => [
                'required',
                'regex:/^09\d{9}$/',
                Rule::unique('users')->ignore($id)->whereNull('deleted_at'),
            ],
            'dob' => 'required|date|before:today',
        ], [
            'name.required' => 'User Name is required',
            'email.required' => 'email is required',
            'email.unique' => 'Email is already taken',
            'phone.unique' => 'Phone Number is already taken',
            'phone' => 'The phone format is invalid',
            'dob.required' => 'Date of Birth is required' 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return null;
    }
}
