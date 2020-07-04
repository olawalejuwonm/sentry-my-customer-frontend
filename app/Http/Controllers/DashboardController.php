<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Customer;
use DateTime;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $analytics['revenue'] = $this->todayRevenue();
        $analytics['products'] = $this->productsSold();
        $analytics['customers'] = $this->newCustomers();
        $analytics['transactions'] = $this->recentTransactions();
        return view('backend.dashboard.index')->with('analytics', $analytics);
    }

    public function todayRevenue(){
        return Transaction::where('createdAt', new DateTime('today'))
                            ->sum('total_amount');
    }

    public function productsSold(){
        return Transaction::count();
    }

    public function newCustomers(){
        return Customer::where('createdAt', '>', new DateTime('last week'))
                        ->count();
    }

    public function recentTransactions(){
        return Transaction::where('createdAt', '>', new DateTime('last week'))
                            ->limit(6)->get();
    }
}
