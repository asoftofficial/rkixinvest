<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magazine;
use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Collection;
class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Issue::paginate(10);
        $collections = Collection::where('status', 1)->get();
        $magazines = Magazine::all();
        return view('admin.issues.index', compact('issues', 'collections','magazines'));
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'publish_date' => 'required',
            'release_date' => 'required',
            'magazine_id' => 'required|integer',
            'collection_id' => 'required|integer',
            'file' => 'required|mimes:pdf',
            'image' => 'required|image',
            'page_title' => 'nullable|string',
            'keywords' => 'nullable',
            'desc' => 'nullable|string'
        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $imageName = "issue_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
        $upload_path = public_path('uploads/issues/');
        $full_path = '/uploads/issues/'.$imageName;
        $check = $request->file('image')->move($upload_path, $imageName);

        $uniqueFileName = uniqid().'_'.$request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path('/uploads/issues/') , $uniqueFileName);

        try{
            $issue = Issue::create([
                'title'      => $request->name,
                'publish_date' => $request->publish_date,
                'release_date' => $request->release_date,
                'magazine_id' => $request->magazine_id,
                'collection_id' => $request->collection_id,
                'file_path' => "/uploads/issues/".$uniqueFileName,
                'image_path' => $full_path,
                'page_title' => $request->page_title,
                'keywords' => $request->keywords,
                'desc' => $request->desc,
                'status' => $request->status
            ]);
        }catch (Exception $ex) {
            return redirect()->back()->with("error", $ex->getMessage());
        }
        return redirect()->back()->with("success", "Issue Created Successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $issue = Issue::findOrFail($id);
        return view('admin.issues.show', compact('issue'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
