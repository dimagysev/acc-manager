<?php

namespace App\Http\Resources;

use App\Services\EncryptService;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $crypter = new EncryptService();
        return [
            'id'         => $this->id,
            'login'      => $crypter->decrypt($this->login, $this->salt, $this->service->salt),
            'password'   => $crypter->decrypt($this->password, $this->salt, $this->service->salt),
            'service_id' => $this->service_id,
        ];
    }
}
