<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Thread;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return view('comments', ['comments' => $comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comment = new Comment;
        return view('commentsForm',['comment' => $comment]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'message' => 'required|min:10|max:255',
        ]);
        if (\Auth::User()==null)
        {
            return view('home');
        }
        $comment = new Comment();
        $comment->user_id = \Auth::user()->id;
        $comment->message = $request->message;
        if($comment->save())
        {
            return redirect('comments');
        }
        return view('comments');
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
        $comment = Comment::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if (\Auth::user()->id != $comment->user_id) {
        return back()->with(['success' => false, 'message_type' => 'danger',
        'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        return view('commentsEditForm', ['comment'=>$comment]);
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
        $this->validate($request, [
        'message' => 'required|min:10|max:255',
        ]);
        $comment = Comment::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if(\Auth::user()->id != $comment->user_id)
        {
        return back()->with(['success' => false, 'message_type' => 'danger',
        'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        $comment->message = $request->message;
        if($comment->save()) {
        return redirect()->route('comments');
        }
        return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Znajdź komentarz o danych id:
         $comment = Comment::find($id);
         //Sprawdz czy użytkownik jest autorem komentarza:
         if(\Auth::user()->id != $comment->user_id)
         {
         return back();
         }
         if($comment->delete()){
         return redirect()->route('comments');
         }
         else return back();
    }
    

    
    public function create_thread($id)
    {
        //Sprawdzenie czy uz jest zalogowany
        if (\Auth::User()==null)
        {
            return view('home');
        }
        $comment = Comment::find($id);
        $threads = Thread::where('comment_id','=',$comment->id)->orderBy('created_at', 'asc')->get();
        return view('thread', ['threads' => $threads, 'comment'=>$comment] );
    }
    public function store_thread(Request $request, $id)
    {
        $this->validate($request, [
        'message' => 'required|min:10|max:255',
        ]);
        if (\Auth::User()==null)
        {
            return view('home');
        }
        $thread = new Thread();
        $thread->user_id = \Auth::user()->id;
        $thread->message = $request->message;        //dd($id);
        $thread->comment_id = $id;
        
        if($thread->save())
        {
            $comment = Comment::find($id);
            $threads = Thread::where('comment_id','=',$comment->id)->orderBy('created_at', 'asc')->get();
            return view('thread', ['threads' => $threads, 'comment'=>$comment] );
        }
        
        return redirect()->back();
    }
    
    public function edit_thread($id)
    {
        $thread = Thread::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if (\Auth::user()->id != $thread->user_id) 
        {
            return back()->with(['success' => false, 'message_type' => 'danger',
            'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        return view('threadsEditForm', ['thread'=>$thread]);
    }
    
    public function update_thread(Request $request, $id)
    {
        $this->validate($request, [
        'message' => 'required|min:10|max:255',
        ]);
        $thread = Thread::find($id);
        //Sprawdzenie czy użytkownik jest autorem komentarza
        if(\Auth::user()->id != $thread->user_id)
        {
            return back()->with(['success' => false, 'message_type' => 'danger',
            'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.']);
        }
        $thread->message = $request->message;
        if($thread->save())
        {
            redirect()->route('comments');
        }
        
        return redirect()->route('comments');
    }
    
    public function destroy_thread($id)
    {
        //Znajdź komentarz o danych id:
         $thread = Thread::find($id);
         //Sprawdz czy użytkownik jest autorem komentarza:
         if(\Auth::user()->id != $thread->user_id)
         {
            return back();
         }
         if($thread->delete())
         {
            return redirect()->route('comments');
         }
         else return back();
    }
}
