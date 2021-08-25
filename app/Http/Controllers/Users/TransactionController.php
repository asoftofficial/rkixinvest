<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()->paginate(25);
        return view('users.transactions.transactions',compact('transactions'));
    }
}
