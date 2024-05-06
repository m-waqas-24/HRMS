<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\AccountCategory;
use App\Models\Account\AccountCategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        if(\Auth::user()->can('manage categories')){
            $categories = AccountCategory::where('created_by', \Auth::user()->creatorId())->orderBy('id', "DESC")->get();
            $types = AccountCategoryType::all();
            return view('accounts.categories.index', compact('types', 'categories'));
        }
        else
        {
        return back()->withError('Permission Denied');
        }
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        AccountCategory::create([
            'name' => $request->name,
            'cat_type_id' => $request->type,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Category added successfully!');
    }

    public function edit(Request $request){
        $id = $request->categoryId;

        $category = AccountCategory::with('type')->find($id);

        return response()->json(['category' => $category]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $category = AccountCategory::find($id);

        $category->update([
            'name' => $request->name,
            'cat_type_id' => $request->type,
        ]);

        return back()->withSuccess('Category updated successfully!');
    }

    public function destroy($id){
        if(Auth::user()->can('delete categories')){
            $category = AccountCategory::find($id);

            if($category){
                $category->delete();
            }
    
            return back()->withSuccess('Category deleted successfully!');
        }
        else
        {
        return back()->withError('Permission Denied');
        }
    }

}
