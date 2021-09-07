<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Collection;

class IssueController extends Controller
{
    public function index(Request $request){
    	$data['collections'] = Collection::where('status', 1)->get();
    	if($request->collection){
    		$data['issues'] = Issue::where('collection_id', $request->collection)->get();
    	}else{
    		$data['issues'] = Issue::all();
    	}

    	return view('users.issues.index', $data);
    }
    public function view($id){
        $issue = Issue::findOrFail($id);
        $pdftext = file_get_contents(public_path($issue->file_path));
        $totalPages = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        return view('users.issues.show', compact('issue', 'totalPages'));
    }
}
