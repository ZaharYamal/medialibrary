<?php

namespace App\Http\Controllers;

use App\Post;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\MediaLibrary\MediaStream;
use Spatie\MediaLibrary\Models\Media;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(12);
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $data = $request->input();
        //dd($data, $request->file('image'));
//        $post = new Post($data);
//        $store = $post->save();

        if ($request->file('image') && $request->hasFile('image')):
            // multiple upload file
//            $post->addMultipleMediaFromRequest(['image'])->each(function ($fileAddress){
//                $fileAddress->toMediaCollection('posts');
//            });
            //----------------------------------------------------------------------------------------
            // add watermark test
            ;

//            $images = $request->file('image');
//            collect($images)->each(function(Image $image) use ($manipulations) {
//                $image->manipulate($manipulations)->watermark()->watermarkOpacity(50)->save();
//            });
//            dd($images->watermark('watermark/watermark.png'));
//            $images = $post->addMultipleMediaFromRequest(['image'])->each(function ($fileAddress){
//                $fileAddress->toMediaCollection('posts');
//            });

            // single upload images
            //$post->addMediaFromRequest('image')->toMediaCollection('posts');
        endif;
        if ($store): return redirect()->route('post.index')->with(['success' => 'Запись "' . $post->title . '", успешно добавлена !']);
        else: return back()->withErrors(['msg' => 'Что то пошло не так !']); endif;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (!$post): return redirect('post.index')->withErrors(['msg' => 'статья не найдена']); endif;
        //$media = $post->getMedia('posts')->get()->getUrl('origin'); //$post->media('posts')->get();
        $media = Media::where('model_id','=', $post->id)->get();
        //dd($media);
        foreach($media as $item):
            $image = Image::load($item->getFullUrl('origin'))->sepia();
        //dd($image);
        endforeach;
        //dd($post->getMedia('posts')->all());
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->input();
        //dd($data, $request->file('images'));
        if ($request->file('images') && $request->hasFile('images')):

            $post->addMultipleMediaFromRequest(['images'])->each(function ($fileAddress){
                $fileAddress->toMediaCollection('posts');
            });
            //$post->addMultipleMediaFromRequest(['image'])->toMediaCollection('posts','media');
            //$post->addMediaFromRequest('image')->toMediaCollection('posts');
        endif;
        $update = $post->update($data);
        if($update): return back()->with(['success'=>'Запись "'.$post->title.'", успешно обновлена !']);
        else: return back()->withErrors(['msg'=>'Что то пошло не так !']); endif;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (!$post): return redirect()->route('post.index')->withErrors(['msg' => 'не найденно!']); endif;
        $media = $post->media()->get();
//        dd($media,$post,__METHOD__);
        foreach ($media as $file):
            if (File::exists('storage/media/' . $file->id . '/' . $file->file_name)):
                Storage::deleteDirectory('storage/media/' . $file->id);
            endif;
        endforeach;

        $delete = $post->delete();
        if ($delete): return redirect()->route('post.index')->with(['success' => 'запись "' . $post->title . '", удалена']);
        else: return back()->withErrors(['msg' => 'Something wrong !']); endif;
    }
    /*
     *
     */
    public function deleteImage($id)
    {
        $media = Media::find($id);
        //dd($media->getUrl() );
        Storage::deleteDirectory('storage/media/'.$media->id);
        $delImage = $media->delete();
        if($delImage): return back()->with(['success'=>'Файл "'.$media->file_name.'", успешно удален ! С содержимым директории']);
        else: return back()->withErrors(['msg'=>'something wrong !']); endif;
    }
}
