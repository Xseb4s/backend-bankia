<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit_requests;


class Credit_requestsController extends Controller
{

    public function index()
    {
        $solicitations = Credit_requests::select(
            'credit_requests.id AS Id_credit_request',
            'credit_requests.amount',
            'credit_requests.dues',
            'credit_requests.description',
            'credit_requests.status',
            'credit_requests.created_at',
            'credit_requests.updated_at',
            'credit_requests.observation',
            'credit_requests.fk_type_credit AS typeid',
            'type_credit.type',
            'type_credit.interest',
            'credit_requests.fk_user AS client_id',
            'users.name AS client_name',
            'users.surname AS client_surname'
        )
        ->join('users', 'users.id', '=', 'credit_requests.fk_user')
        ->join('type_credit', 'type_credit.id', '=', 'credit_requests.fk_type_credit')
        ->get();

        return $solicitations;
    }

    public function read()
    {
        $solicitation = Credit_requests::select(
            'credit_requests.id',
            'credit_requests.amount',
            'credit_requests.dues',
            'credit_requests.description',
            'credit_requests.status',
            'credit_requests.created_at',
            'credit_requests.updated_at',
            'credit_requests.observation',
            'credit_requests.fk_type_credit AS typeid',
            'type_credit.type',
            'type_credit.interest',
            'credit_requests.fk_user AS client_id',
            'users.name AS client_name',
            'users.surname AS client_surname'
        )
        ->join('users', 'users.id', '=', 'credit_requests.fk_user')
        ->join('type_credit', 'type_credit.id', '=', 'credit_requests.fk_type_credit')
        ->where('credit_requests.status', '=', 1)
        ->get();

        return $solicitation;
    }

    public function pendient()
    {
        $solicitations = Credit_requests::select(
            'credit_requests.id AS Id_credit_request',
            'credit_requests.amount',
            'credit_requests.dues',
            'credit_requests.description',
            'credit_requests.status',
            'credit_requests.created_at',
            'credit_requests.updated_at',
            'credit_requests.observation',
            'credit_requests.fk_type_credit AS typeid',
            'type_credit.type',
            'type_credit.interest',
            'credit_requests.fk_user AS client_id',
            'users.name AS client_name',
            'users.surname AS client_surname'
        )
        ->join('users', 'users.id', '=', 'credit_requests.fk_user')
        ->join('type_credit', 'type_credit.id', '=', 'credit_requests.fk_type_credit')
        ->where('credit_requests.status', '=', 0)
        ->get();

        return $solicitations;
    }

    public function store(Request $request)
    {
        $solicitation = new Credit_requests();
        $solicitation->amount = $request->amount;
        $solicitation->dues = $request->dues;
        $solicitation->description = $request->description;
        $solicitation->status = $request->status;
        $solicitation->observation = $request->observation;
        $solicitation->fk_type_credit = $request->typeid;
        $solicitation->fk_user = $request->client_id;

        $solicitation->save();

    }

    public function show($id)
    {
        $solicitation = Credit_requests::select(
            'credit_requests.id',
            'credit_requests.amount',
            'credit_requests.dues',
            'credit_requests.description',
            'credit_requests.status',
            'credit_requests.created_at',
            'credit_requests.updated_at',
            'credit_requests.observation',
            'credit_requests.fk_type_credit AS typeid',
            'type_credit.type',
            'type_credit.interest',
            'credit_requests.fk_user AS client_id',
            'users.name AS client_name',
            'users.surname AS client_surname'
        )
        ->join('users', 'users.id', '=', 'credit_requests.fk_user')
        ->join('type_credit', 'type_credit.id', '=', 'credit_requests.fk_type_credit')
        ->where('credit_requests.id', '=', $id)
        ->get();

        return $solicitation;
    }

    public function update(Request $request, $id)
    {
        $solicitation = Credit_requests::findOrFail($id);
        $solicitation->amount = $request->amount;
        $solicitation->dues = $request->dues;
        $solicitation->description = $request->description;
        $solicitation->status = $request->status;
        $solicitation->observation = $request->observation;
        $solicitation->fk_type_credit = $request->typeid;
        $solicitation->fk_user = $request->client_id;

        $solicitation->save();
    }

}
