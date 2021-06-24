<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $form_data = $request->all();

        // Slug
        // Creo lo slug
        $new_slug = Str::slug($form_data['title'], '-');
        $base_slug = $new_slug;

        // Controllo se esiste già uno slug uguale
        $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        $counter = 1;

        // Se esiste già uno slug uguale aggiungo il counter
        while($existing_post_with_slug) {
            $new_slug = $base_slug . '-' . $counter;
            $counter++;
            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
        }

        $form_data['slug'] = $new_slug;

        $post = new Post();
        $post->fill($form_data);

        $post->save();

        if( isset($form_data['tags']) && is_array($form_data['tags']) ) {
            $post->tags()->sync($form_data['tags']);
        }
        
        return redirect()->route('admin.posts.show', [
            'post' => $post->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post,
            'post_category' => $post->category,
            'post_tags' => $post->tags
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        
        $categories = Category::all();

        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ];

        return view('admin.posts.edit', $data);
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
        $request->validate($this->getValidationRules());

        $modified_form_data = $request->all();

        $post = Post::findOrFail($id);

        $modified_form_data['slug'] = $post->slug;

        // Se il titolo cambia allora modifico lo slug
        if($modified_form_data['title'] != $post->title) {

            // Creo lo slug
            $new_slug = Str::slug($modified_form_data['title'], '-');
            $base_slug = $new_slug;

            // Controllo se esiste già uno slug uguale
            $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
            $counter = 1;

            // Se esiste già uno slug uguale aggiungo il counter
            while($existing_post_with_slug) {
                $new_slug = $base_slug . '-' . $counter;
                $counter++;
                $existing_post_with_slug = Post::where('slug', '=', $new_slug)->first();
            }

            $modified_form_data['slug'] = $new_slug;
        }

        $post->update($modified_form_data);

        // Aggiornare i tags
        if( isset($modified_form_data['tags']) && is_array($modified_form_data['tags']) ) {
            $post->tags()->sync($modified_form_data['tags']);
        } else{
            $post->tags()->sync([]);
        }

        return redirect()-> route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_delete = Post::find($id);
        $post_to_delete->tags()->sync([]);

        $post_to_delete->delete();

        return redirect()->route('admin.posts.index');
    }

    // Funzione che ritorna le regole di validazione
    private function getValidationRules() {
        $validation_rules = [
            'title' => 'required|max:255',
            'content' => 'required|max:60000',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ];

        return $validation_rules;
    }
}
