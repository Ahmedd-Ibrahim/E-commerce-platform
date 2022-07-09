<?php

namespace App\Cart\Payments;

use App\Models\User;

interface Getway
{
    public function withUser(User $user);
    public function createCustomer();
}
