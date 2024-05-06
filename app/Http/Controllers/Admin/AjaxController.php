<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\NoticeBoard;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function updateCandidateStatus(Request $request){
        $candidateId = $request->candidateId;

        $candidate = Candidate::find($candidateId);
        $candidate->update([
            'status_id' => $request->statusId,
        ]);

        
        return response()->json([ 'success' => 'Candidate status updated successfully!' ]);
    }

}
