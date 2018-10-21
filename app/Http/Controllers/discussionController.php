<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;
use App\Like;
use Auth;

class discussionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Discussion::orderBy('created_at','desc')->paginate(10);
        return view('discussions.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('discussions.newDiscussion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
                // Create Post
        $post = new Discussion;
        $post->category = $request->input('category');
        $post->title = $request->input('title');
        $post->user_id = auth()->user()->id;
        $post->content = $request->input('body');
        $post->save();

        return redirect('/discussions')->with('success', 'Discusson Created');
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
        $post = Discussion::find($id);
        $comments = Reply::orderBy('created_at','desc')->where('discussion_id',$id)->get();

        return view("discussions.show")->with('post', $post)->with('comments',$comments);

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
        $post = Discussion::find($id);

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('discussions')->with('error', 'Unauthorized Page');
        }

        return view('discussions.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = Discussion::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('body');

        $post->save();

        return redirect('/discussions/'.$id)->with('success', 'Discussion Updated');
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
        $post = Discussion::find($id);

        // Check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('discussions')->with('error', 'Unauthorized Page');
        }

        $comments = $post->replies()->delete();


        $post->delete();
        return redirect('/discussions')->with('success', 'Post Removed');

    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Discussion::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('discussion_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->discussion_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }

    public function category($category){
      $posts = Discussion::where('category',$category)->get();

      return view("discussions.index")->with('posts',$posts);

    }
}
