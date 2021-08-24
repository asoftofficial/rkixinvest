<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class transactionController extends Controller
{
    public function index()
    {
           dd("hello");
      $transactions = User::find(Auth::user()->transactions);

      return view('users.transactions.transactions');
    }
}
