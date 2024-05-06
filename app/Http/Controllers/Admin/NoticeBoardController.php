<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NoticeBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = NoticeBoard::where('created_by' , \Auth::user()->creatorId())->orderby('id', 'DESC')->paginate(16);

        return view('admin.noticeboard.index', compact('notices'));
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
            'title' => 'required',
            'desc' => 'required',
        ]);

        $file = null;
        if ($request->file('img')) {
            $path = $request->file('img');
            $target = 'public/notice_images';
            $file = Storage::putFile($target, $path);
            $file = substr($file, 7, strlen($file) - 7);
        }

        NoticeBoard::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'img' => $file,
            'created_by' => \Auth::user()->creatorId(),
        ]);

        return back()->withSuccess('Notice added successfully!');
    
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
    public function edit(NoticeBoard $noticeboard)
    {
        if(\Auth::user()->creatorId() == $noticeboard->created_by){
            return view('admin.noticeboard.edit', compact('noticeboard'));
        }else{
            auth()->logout();
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NoticeBoard $noticeboard)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
        ]);

        $file = null;
        if ($request->file('img')) {
            $path = $request->file('img');
            $target = 'public/notice_images';
            $file = Storage::putFile($target, $path);
            $file = substr($file, 7, strlen($file) - 7);
        }

        $noticeboard->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'img' => $file,
        ]);

        return redirect()->route('admin.noticeboard.index')->withSuccess('Notice added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NoticeBoard $noticeboard)
    {

        if(\Auth::user()->creatorId() == $noticeboard->created_by){
            $noticeboard->delete();
            return back()->withSuccess('Notice deleted successfully!');
        }else{
            auth()->logout();
            abort(403);
        }
    
    }
}
