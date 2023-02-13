<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StrollerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strollers = Stroller::select()->get();

        return view('admin.stroller.list')->with(['strollers' => $strollers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stroller.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
//        dump($request); die;
        $request->validate([
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'model' => 'required|string',
            'type' => 'required|string',
            'year' => 'required|integer',
            'weight' => 'required|integer',
            'max_weight' => 'required|integer',
            'description' => 'required',
            'price' => 'required|numeric|between:0,9999999999.99',
        ]);
        try {
            DB::beginTransaction();

            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/images'), $imageName);

            $createStroller = Stroller::create([
                                                   'image' => $imageName,
                                                   'model' => $request->model,
                                                   'type' => $request->type,
                                                   'year' => $request->year,
                                                   'weight' => $request->weight,
                                                   'max_weight' => $request->max_weight,
                                                   'description' => $request->description,
                                                   'price' => $request->price
                                               ]);

            if (!$createStroller) {
                DB::rollBack();

                return back()->with('error', 'Something went wrong while saving data');
            }

            DB::commit();
            return redirect()->route('stroller')->with('success', 'Stroller Stored Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $model = Stroller::whereId($id)->delete();

            if (!$model) {
                DB::rollBack();
                return back()->with('error', 'There is an error while deleting stroller.');
            }

            DB::commit();
            return redirect()->route('stroller')->with('success', 'Stroller Deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stroller = Stroller::whereId($id)->first();

        return view('admin.stroller.edit')->with([
                                                     'stroller' => $stroller
                                                 ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stroller = Stroller::whereId($id)->first();
        $request->validate([
                               'image' => 'image|mimes:png,jpg,jpeg|max:2048',
                               'model' => 'required|string',
                               'type' => 'required|string',
                               'year' => 'required|integer',
                               'weight' => 'required|integer',
                               'max_weight' => 'required|integer',
                               'description' => 'required',
                               'price' => 'required|numeric|between:0,9999999999.99',
                           ]);

        try {
            DB::beginTransaction();

            if (!empty($request->image)) {
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/images'), $imageName);
            } else {
                $imageName = $stroller->image;
            }

            $update = $stroller->update([
                                  'images' => $imageName,
                                  'model' => $request->model,
                                  'type' => $request->type,
                                  'year' => $request->year,
                                  'weight' => $request->weight,
                                  'max_weight' => $request->max_weight,
                                  'description' => $request->description,
                                  'price' => $request->price,
                                  'updated_at' => now()
                              ]);

            if (!$update) {
                DB::rollBack();

                return back()->with('error', 'Something went wrong while saving data');
            }

            DB::commit();
            return redirect()->route('stroller')->with('success', 'Stroller Updated Successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }
}