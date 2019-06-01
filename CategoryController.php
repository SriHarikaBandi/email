<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CategoryCreatedMail;
use App\User;

class CategoryController extends Controller
{
    public function showAllCategories(Request $request)
    {
        $nameLike = $request->input('nameLike', "");
        $page = $request->input('page', "1");
        $limit = $request->input('limit', "9");
        return response()->json(Category::where([['name','LIKE',"%".$nameLike."%"]])->paginate($limit));
    }

    public function showOneCategory($id)
    {
        return response()->json(Category::with(['features', 'timeInfos', 'serviceTypes'])->find($id));
    }

    public function create(Request $request)
    {
        $category = Category::create($request->all());
        $user = User::find($category->admin);
        $isUpdated = 0;
        Mail::to('drughelp.carecsu@gmail.com')->send(new CategoryCreatedMail($category, $user, $isUpdated));
        return response()->json($category, 201);
    }

    public function update($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        $user = User::find($category->admin);
        $isUpdated = 1;
        Mail::to('drughelp.carecsu@gmail.com')->send(new CategoryCreatedMail($category, $user, $isUpdated));


        return response()->json($category, 200);
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
