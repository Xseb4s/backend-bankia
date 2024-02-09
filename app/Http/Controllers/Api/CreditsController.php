<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Credits;

class CreditsController extends Controller
{
    
    public function index()
    {
        $credits = Credits::select(
            'credits.id AS Id_credit',
            'credits.account_number',
            'credits.amount',
            'credits.dues',
            'credits.fee_value',
            'credits.status',
            'credits.created_at',
            'credits.updated_at',
            'credits.type_credit AS typeid',
            DB::raw('(SELECT type FROM type_credit WHERE id = credits.type_credit) AS type_credit'),
            DB::raw('(SELECT interest FROM type_credit WHERE id = credits.type_credit) AS interest'),
            'credits.fk_user AS client_id',
            DB::raw('(SELECT users.name FROM users WHERE users.id = credits.fk_user) AS client_name'),
            DB::raw('(SELECT users.surname FROM users WHERE users.id = credits.fk_user) AS client_surname'),
            DB::raw('(SELECT users.email FROM users WHERE users.id = credits.fk_user) AS client_email'),
            'credits.approver_id',
            DB::raw('(SELECT users.name FROM users WHERE users.id = credits.approver_id) AS approver_name'),
            DB::raw('(SELECT users.email FROM users WHERE users.id = credits.approver_id) AS approver_email'),
            DB::raw('(SELECT roles.role FROM users INNER JOIN roles ON users.fk_role = roles.id WHERE users.id = credits.approver_id) AS approver_role')
        )
        ->join('users', 'credits.fk_user', '=', 'users.id')
        ->get();

        return $credits;
    }

    public function store(Request $request)
    {
        $account_number = $this->generateAccountNumber();
        $fee_value = $this->feeValueCalc($request->amount, $request->dues, $request->type_credit);

        $credit = new Credits();
        $credit->account_number = $account_number;
        $credit->amount = $request->amount;
        $credit->dues = $request->dues;
        $credit->type_credit = $request->type_credit;
        $credit->fee_value = $fee_value;
        $credit->status = $request->status;
        $credit->approver_id = $request->approver_id;
        $credit->fk_user = $request->fk_user;

        $credit->save();
    }

    public function show($id)
    {
        $credit = Credits::select(
            'credits.id',
            'credits.account_number',
            'credits.amount',
            'credits.dues',
            'credits.fee_value',
            'credits.status',
            'credits.created_at',
            'credits.updated_at',
            'credits.type_credit AS typeid',
            DB::raw('(SELECT type FROM type_credit WHERE id = credits.type_credit) AS type_credit'),
            DB::raw('(SELECT interest FROM type_credit WHERE id = credits.type_credit) AS interest'),
            'credits.fk_user AS client_id',
            DB::raw('(SELECT name FROM users WHERE id = credits.fk_user) AS client_name'),
            DB::raw('(SELECT surname FROM users WHERE id = credits.fk_user) AS client_surname'),
            DB::raw('(SELECT email FROM users WHERE id = credits.fk_user) AS client_email'),
            'credits.approver_id',
            DB::raw('(SELECT name FROM users WHERE id = credits.approver_id) AS approver_name'),
            DB::raw('(SELECT email FROM users WHERE id = credits.approver_id) AS approver_email'),
            DB::raw('(SELECT roles.role FROM users INNER JOIN roles ON users.fk_role = roles.id WHERE users.id = credits.approver_id) AS approver_role')
        )
        ->where('credits.id', $id)
        ->get();
        
        return $credit;        
    }
    public function read($id)
    {
        $credit = Credits::select(
            'credits.id AS Id_credit',
            'credits.account_number',
            'credits.amount',
            'credits.dues',
            'credits.fee_value',
            'credits.status',
            'credits.created_at',
            'credits.updated_at',
            'credits.type_credit AS typeid',
            DB::raw('(SELECT type FROM type_credit WHERE id = credits.type_credit) AS type_credit'),
            DB::raw('(SELECT interest FROM type_credit WHERE id = credits.type_credit) AS interest'),
            'credits.fk_user AS client_id',
            DB::raw('(SELECT name FROM users WHERE id = credits.fk_user) AS client_name'),
            DB::raw('(SELECT surname FROM users WHERE id = credits.fk_user) AS client_surname'),
            DB::raw('(SELECT email FROM users WHERE id = credits.fk_user) AS client_email'),
            'credits.approver_id',
            DB::raw('(SELECT name FROM users WHERE id = credits.approver_id) AS approver_name'),
            DB::raw('(SELECT email FROM users WHERE id = credits.approver_id) AS approver_email'),
            DB::raw('(SELECT roles.role FROM users INNER JOIN roles ON users.fk_role = roles.id WHERE users.id = credits.approver_id) AS approver_role')
        )
        ->where('credits.fk_user', $id)
        ->get();

        return $credit;
    }

    public function update(Request $request, $id)
    {
        $credit = Credits::findOrFail($id);
        $credit->status = $request->status;

        $credit->save();
        return $credit;
    }

    private function generateAccountNumber()
    {
        $account_number = mt_rand(1000000000, 9999999999);
        
        while (Credits::where('account_number', $account_number)->exists()) {
            $account_number = mt_rand(1000000000, 9999999999);
        }
        return $account_number;
    }

    private function feeValueCalc($amount, $dues, $type_credit)
    {
        $type_credit = $type_credit === 1 ? 0.025 : 0.013;

        $calc = ($amount / $dues);
        $fee_value = $calc + ($calc * $type_credit);
 
        $fee_value = round($fee_value, 2);

        return $fee_value;
    }

}
