<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use App\Services\EncryptService;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function index()
    {
        return AccountResource::collection(Auth::user()->accounts);
    }

    public function store(AccountStoreRequest $request, EncryptService $encryptService)
    {
        $data = $request->validated();
        $data['salt'] = $encryptService->generateSalt();
        $data['login'] = $encryptService->encrypt($data['login'], $data['salt'], Auth::user()->services()
            ->find($data['service_id'])->salt);
        $data['password'] = $encryptService->encrypt($data['password'], $data['salt'], Auth::user()->services()
            ->find($data['service_id'])->salt);
        $account = Auth::user()->accounts()->create($data);
        if ($account){
            return new AccountResource($account);
        }
        abort(500);
    }

    public function update(AccountUpdateRequest $request, Account $account, EncryptService $encryptService)
    {
        $data = $request->validated();
        $data['password'] = $encryptService->encrypt($data['password'], $account->salt, $account->service->salt);
        $data['login'] = $encryptService->encrypt($data['login'], $account->salt, $account->service->salt);
        if ($account->update($data)){
            return new AccountResource($account);
        }
        abort(500);
    }

    public function destroy(Account $account)
    {
        if (Auth::id() === $account->user_id){
            if ($account->delete()){
                return new AccountResource($account);
            }
        }
        abort(500);
    }
}
