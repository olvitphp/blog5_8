<?php

namespace App\Http\Controllers\Blog\Admin;



use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateReequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Blog\Admin
 */


class CategoryController extends BaseController
{
    /**
     * @return Factory|View
     * @var BlogCategoryRepository
     *
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();

        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */

    public function index()
    {
      //  $dsd = BlogCategory::all();
     //  $paginator = BlogCategory::paginate(15);

      $paginator = $this->blogCategoryRepository->getAllWithPaginate(10);

// dd($dsd, $paginator);

        return view('blog.admin.categories.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
       $item = new BlogCategory();
    //   $categoryList = BlogCategory::all();
      // dd($item);
    $categoryList
        = $this->blogCategoryRepository->getForComboBox();

       return view('blog.admin.categories.edit',
       compact('item', 'categoryList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();
        if (empty($data['slug'])) {
            $data['slug'] = str_slug($data['title']);
        }

        // Создает объект но не добавлят в БД

        $item = (new BlogCategory())->create($data);

//        dd($item);
//        $item->save();

        if ($item) {
            return redirect()->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'Успешно сохранено'])
                ->withInput();
        } else {
            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param BlogCategoryRepository $categoryRepository
     * @return Factory|View
     */
    public function edit($id)
    {
        // $item = BlogCategory::findOrFail($id);
        // $categoryList = BlogCategory::all();

        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)) {
            abort(404);;
        }
        $categoryList
            = $this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
            compact('item',  'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

       public function update(BlogCategoryUpdateReequest $request, $id)
   {


        $item = $this->blogCategoryRepository->getEdit($id);
      // dd($item);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();
       if (empty($data['slug'])) {
           $data['slug'] = str_slug($data['title']);
       }


        $result = $item->update($data);


        if ($result) {
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);

        }else{
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();

        }





//        if (empty($data['slug'])) {
//            $data['slug'] = str::slug($data['title']);
//        }

    }
}
