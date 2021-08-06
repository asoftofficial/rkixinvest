<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Http\Requests\CollectionRequest;
use Exception;
class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::withCount('issues')->paginate(10);
        return view('admin.collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionRequest $request)
    {
        try{
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "collection_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/collections/');
            $full_path = '/uploads/collections/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $collection = Collection::create([
                'collectionId'  => '123',
                'name'          => $request->name,
                'description'   => $request->description,
                'image'         => $full_path,
                'status'        => $request->status
            ]);
        }catch (Exception $ex) {
           return redirect()->back()->with("error", $ex->getMessage());
        }
       return redirect()->back()->with("success", "Collection Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "collection_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/collections/');
            $full_path = '/uploads/collections/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $collection->image = $full_path;
        }
        $collection->name        = $request->name;
        $collection->description = $request->description;
        $collection->status      = $request->status;
        $collection->update();
        return redirect()->back()->with("success", "Collection Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);
        $collection->issues()->delete();
        $collection->delete();
        return redirect()->back()->with("success", "Collection Deleted Successfully!");
        
    }
    public function export(Request $request)
    {
       $fileName = 'collections.csv';
       $collections = Collection::withCount('issues')->get();
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Collection ID', 'Name', 'Description', 'Created on', 'Issues Attached', 'Status');

            $callback = function() use($collections, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($collections as $collection) {
                    $row['Collection ID'] = $collection->collectionId;
                    $row['Name']  = $collection->name;
                    $row['Description'] = $collection->description;
                    $row['Created on']  = date('d/m/Y', strtotime($collection->created_at));
                    $row['Issues Attached']  = $collection->issues_count;
                    $row['Status']        = $collection->status==1?"Live":"Offline";

                    fputcsv($file, array($row['Collection ID'], $row['Name'], $row['Description'], $row['Created on'], $row['Issues Attached'], $row['Status']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
}
