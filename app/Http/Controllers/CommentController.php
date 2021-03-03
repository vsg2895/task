<?php

namespace App\Http\Controllers;

use App\Reason;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function add_coment(Request $request)
    {

        $comment = new Comment();
        $validation = $request->validate([

            'topic' => 'required',
            'content' => 'required|min:56|max:560',
            'title' => 'required|min:20|max:256',

        ]);

        $req_img = $request->file('img');
        $file = $req_img[0];
        $fileArray = array('image' => $req_img);

        $rules = array(
            'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:300|dimensions:width=320,height=240' // max 10000kb
        );
        $validator = Validator::make($fileArray, $rules);
        if ($validator->fails()) {

            return redirect()->back()->with(['errors' => $validator->errors()->all()]);
//           dd($validator->errors()->getMessages());
        }


        if ($request->hasFile('img')) {

            $img_array = [];
            $images = $request->file('img');
            if (count($images) > 3 ){

                return redirect()->back()->with(session()->flash('alert-danger','Sorry  you can dont upload more 3 images'));

            }

            foreach ($images as $img) {

                $img_name = $img->store('public/image');
                $img_uniquename = str_replace('public/image/', '', $img_name);
                array_push($img_array, $img_uniquename);

            }
            $db_images = implode(',', $img_array);
            $comment->image = $db_images;

        }

        $comment->title = $request->post('title');
        $comment->content = $request->post('content');
        $comment->user_id = Auth::user()->id;
        $comment->topic_id = $request->post('topic');
        $comment->save();

        return redirect()->back()->with(session()->flash('alert-success','Comment adding success'));


    }
    public function block_comment(Request $request,$id){


        $c = Comment::find($id);
        $reason_id = $request->post('reason');
        $reason = Reason::find($reason_id);
//        dd($reason);
        $status = 'Blocked';
        $c->status = 2;
        $c->save();
        MailController::sendCommentEmail($c->comment_user->name,$c->comment_user->lastname,$c->comment_user->email,$c->comment_topic->name,$status,$reason->name);

        return redirect()->back()->with(session()->flash('alert-success','Comment blocked success'));

    }

    public function delete_comment($id){

        $comment = Comment::find($id);
        $status = 'Deleting';
        Comment::where('id',$id)->delete();
//        $comment->delete();
        MailController::sendCommentEmail($comment->comment_user->name,$comment->comment_user->lastname,$comment->comment_user->email,$comment->comment_topic->name,$status,'');

        return redirect()->back()->with(session()->flash('alert-success','Comment blocked success'));

    }
    public function publish_comment($id){

        $c = Comment::find($id);
        $status = 'Published';
        $c->status = 1;
        $c->save();
        MailController::sendCommentEmail($c->comment_user->name,$c->comment_user->lastname,$c->comment_user->email,$c->comment_topic->name,$status,'');
        return redirect()->back()->with(session()->flash('alert-success','Comment published success'));
    }
    public function blockedcomments(){

        $blocked_comments = Comment::where('status',2)->get();
        return view('site.blockedcomments',['comments'=>$blocked_comments]);

    }

    public function filtr(Request $request){


        $time = $request->time;
        $topic = $request->topic;
        $query = Comment::where('status',1);
        if ($time == '1'){
            $query = $query->orderBy('created_at', 'DESC');

        }
        if ($time == '2'){

            $query = $query->orderBy('created_at', 'ASC');

        }
        if ($topic != 0){

            $query = $query->where('topic_id',$topic);


        }
        $users_comments = $query->get();


        return response()
            ->json([
                'view' => view('site.filtr', compact('users_comments'))->render(),
                'users_comments' => $users_comments,

            ]);

    }

    public function seemore($id){

        $seemore = Comment::find($id);

        return view('site.seemore',['seemore'=>$seemore]);

    }

    public function allcomments(){

        $comments = Comment::where('status','!=',2)->get();
        return view('site.allcomments',['comments' => $comments]);


    }
}
