<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Module;
use App\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Module $module)
    {
        return view('posts.postForm', compact('module'));
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['tutor']);  
        $this->validatorStore($request->all())->validate();
        $post = new Post($request->all());
        $post->save();
        foreach ($request->file('files') as $file) {
            if ($file->isValid()) {
                $hashedName = $file->store($post->module->division->description.'/'.$post->module->name.'/'.$post->id.'/');
                $addFile = File::create([
                    'foreign_id' => $post->id,
                    'foreign_type' => 'App\\Post',
                    'name' => $file->getClientOriginalName(),
                    'hashed' => $hashedName,
                    'mime' => $file->getClientMimeType(),
                    'size' => $file->getClientSize(),
                ]);
                $addFile->save();
            }
        }
        $module = Module::find($request->module_id);
        $module->load(['users', 'files', 'posts']);
        return redirect()->route('module.show', compact('module'))->with('success', 'Your post was created.');

    }

    public function index(Request $request)
    {
        $posts = Post::all();
        return view('posts.postIndex', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.postShow', compact('post'));
    }

    public function destroy(Post $post)
    {
        $module = $post->module;
        $this->authorize('owner', $post);
        foreach ($post->files as $file) {
            Storage::delete($file->hashed);
            $file->delete();
        }
        $post->delete();
        return redirect()->route('module.show', compact('module'))->with('success', 'Your post was deleted.');
    }


    protected function validatorStore(array $data)
    {
        return Validator::make($data, [
            'user_id' => ['required', 'exists:users,id'],
            'module_id' => ['required', 'exists:modules,id'],
            'name' => ['required'],
            'description' => ['required']
        ]);
    }

}
