<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;


class repliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($discussion_id)
    {
        //
        $post = Discussion::find($discussion_id);
        return view('replies.create')->with('post',$post);
        // return 'create page';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$discussion_id)
    {
        //
        $this->validate($request, [
            'body' => 'required',
        ]);
                // Create Post
        $comment = new Reply;
        $comment->user_id = auth()->user()->id;
        $comment->content = $request->input('body');
        $comment->discussion_id = $discussion_id;

        $comment->save();

        return redirect('discussions/'.$discussion_id)->with('success', 'You replied succefully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$discussion_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($discussion_id,$id)
    {
        //
        $comment = Reply::find($id);
        $post = Discussion::find($discussion_id);


        return view("replies.edit")->with('comment',$comment)->with('post',$post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$discussion_id,$id)
    {
        //
        $this->validate($request, [
            'body' => 'required',
        ]);
                // Create Post
        $comment = Reply::find($id);
        $comment->content = $request->input('body');

        $comment->save();

        return redirect('discussions/'.$discussion_id)->with('success', 'Comment Updated Succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($discussion_id,$id)
    {
        //
        $comment = Reply::find($id);

        // Check for correct user
        if(auth()->user()->id != $comment->user_id){
            return redirect('discussions')->with('error', 'Unauthorized Page');
        }



        $comment->delete();
        return redirect()->back()->with('success', 'Comment Removed');
    }
}
