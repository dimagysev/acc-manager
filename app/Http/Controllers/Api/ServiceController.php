<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\EncryptService;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{

    public function index()
    {
        return ServiceResource::collection(Auth::user()->services);
    }

    public function store(ServiceStoreRequest $request, EncryptService $encryptService)
    {
        $data = $request->validated();
        $data['salt'] = $encryptService->generateSalt();
        $service = Auth::user()->services()->create($data);
        if ($service){
            return new ServiceResource($service);
        }
        abort(500);
    }

    public function update(ServiceUpdateRequest $request, Service $service)
    {
        if ($service->update($request->validated())){
            return new ServiceResource($service);
        }
        abort(500);
    }

    public function destroy(Service $service)
    {
        if (Auth::id() === $service->user_id){
            if ($service->delete()){
                return response()->json(['id' => $service->id]);
            }
            abort(500);
        }
    }
}
