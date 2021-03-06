<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $articles = Article::paginate();

    // Статьи передаются в шаблон
    // compact('articles') => [ 'articles' => $articles ]
    return view('article.index', compact('articles'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $article = new Article();
    return view('article.create', compact('article'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // Проверка введённых данных
    // Если будут ошибки, то возникнет исключение
    // Иначе возвращаются данные формы
    $data = $this->validate($request, [
      'name' => 'required|unique:articles',
      'body' => 'required|min:10',
    ]);

    $article = new Article();
    // Заполнение статьи данными из формы
    $article->fill($data);
    // При ошибках сохранения возникнет исключение
    $article->save();

    // Редирект на указанный маршрут с добавлением флеш-сообщения
    $request->session()->flash('status', 'Статья добавлена!');
    return redirect()->route('articles.create');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Article  $article
  * @return \Illuminate\Http\Response
  */
  public function show(Article $article)
  {
    //$article = Article::findOrFail($article->id);
    return view('article.show', compact('article'));
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Article  $article
  * @return \Illuminate\Http\Response
  */
  public function edit(Article $article)
  {
    //$article = Article::findOrFail($article->id);
    return view('article.edit', compact('article'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Article  $article
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Article $article)
  {
    //$article = Article::findOrFail($article->id);
    $data = $this->validate($request, [
      // У обновления немного изменённая валидация. В проверку уникальности добавляется название поля и id текущего объекта
      // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
      'name' => 'required|unique:articles,name,' . $article->id,
      'body' => 'required|min:10',
    ]);

    $article->fill($data);
    $article->save();
    $request->session()->flash('status', 'Статья обновлена!');
    return redirect()->route('articles.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Article  $article
  * @return \Illuminate\Http\Response
  */
  public function destroy(Article $article)
  {
    // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
    // $article = Article::find($article->id);
    // if ($article) {
    //   $article->delete();
    // }
    $article->delete();
    return redirect()->route('articles.index');
  }
}
