<?php


namespace App\Services;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class EncryptService
{
    private $globalSalt;

    public function __construct()
    {
        $this->globalSalt = config('settings.global_salt');
    }

    public function encrypt($password, $passwordSalt, $serviceSalt): string
    {
        $encrypted = Crypt::encryptString($password);
        return $this->addSalt($encrypted, $passwordSalt, $serviceSalt);
    }

    public function decrypt($encrypted, $passwordSalt, $serviceSalt): string
    {
        $encrypted = $this->sift($encrypted, $passwordSalt, $serviceSalt);
        return Crypt::decryptString($encrypted);
    }

    public function generateSalt(int $length = 9): string
    {
        return base64_encode(Str::random($length));
    }

    private function addSalt(string $password, $passwordSalt, $serviceSalt): string
    {
        $step_1 = base64_encode($passwordSalt . $password);
        $step_2 = base64_encode($serviceSalt . $step_1);
        return base64_encode($this->globalSalt . $step_2);
    }

    private function sift(string $password, $passwordSalt, $serviceSalt): string
    {
        $step_1 = base64_decode($password);
        $step_2 = base64_decode(preg_replace('~'.$this->globalSalt.'~', '',$step_1));
        $step_3 = base64_decode(preg_replace('~'.$serviceSalt.'~', '',$step_2));
        return preg_replace('~'.$passwordSalt.'~', '',$step_3);
    }
}
