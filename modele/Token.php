<?php
Class Token
{
    public function tokenGeneration()
    {
        return base_convert(hash('sha256', time() . mt_rand()), 16, 36);
    }
    public function tokenVerification($token)
    {
        $ok = false;
        if(isset($_SESSION['token']) && $_SESSION['token'] == $token)
            $ok = true;
        return $ok;
    }
}