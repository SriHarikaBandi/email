<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AgencyCreatedMail;
use App\User;

class AgencyController extends Controller
{
    public function showAllAgencies(Request $request)
    {
        $nameLike = $request->input('nameLike', "");
        $page = $request->input('page', "1");
        $limit = $request->input('limit', "9");
        $sortBy = $request->input('sortBy', "updated_at");
        return response()->json(Agency::where([['name','LIKE',"%".$nameLike."%"]])->orderBy($sortBy)->paginate($limit));
    }

    public function showOneAgency($id)
    {
        return response()->json(Agency::with(['admin'])->find($id));
    }

    public function create(Request $request)
    {
        
        $agency = Agency::create($request->all());
        $user = User::find($agency->admin);
        Mail::to($user->email)->send(new AgencyCreatedMail($user, $agency));
        return response()->json($agency, 201);
    }

    public function update($id, Request $request)
    {
        $user = Agency::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete($id)
    {
        Agency::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
