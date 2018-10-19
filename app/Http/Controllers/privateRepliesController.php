<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrivateReplies;
use App\PrivateDiscussion;


class privateRepliesController extends Controller
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
    public function create($group_id, $discussion_id)
    {
        //
        $post = PrivateDiscussion::find($discussion_id);

        return view("groups.privateReplies.create")->with('post',$post)->with('group_id',$group_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$group_id,$discussion_id)
    {
        //
        $comment = new PrivateReplies;
        $comment->content = $request->input('body');
        $comment->private_discussion_id = $discussion_id;
        $comment->user_id = auth()->user()->id;

        $comment->save();

        return redirect('groups/'.$group_id.'/discussions/'.$discussion_id)->with('success', 'You replied succefully');

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
    public function edit($group_id,$discussion_id,$id)
    {
        //
        $comment = PrivateReplies::find($id);
        $post = PrivateDiscussion::find($discussion_id);


        return view("groups.privateReplies.edit")->with('comment',$comment)->with('post',$post)->with('group_id',$group_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$group_id,$discussion_id, $id)
    {
        //
        $this->validate($request, [
            'body' => 'required',
        ]);
                // Create Post
        $comment = PrivateReplies::find($id);
        $comment->content = $request->input('body');

        $comment->save();

        return redirect('groups/'.$group_id.'/discussions/'.$discussion_id)->with('success', 'Comment Updated Succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_id,$discussion_id,$id)
    {
        //
        $comment = PrivateReplies::find($id);

        // Check for correct user
        if(auth()->user()->id !==$comment->user_id){
            return redirect('discussions')->with('error', 'Unauthorized Page');
        }



        $comment->delete();
        return redirect()->back()->with('success', 'Comment Removed');
    }
}
