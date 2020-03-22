<?php

namespace App\Http\Controllers;

use App\Repositories\NewsRepository;
use Illuminate\View\View;

class NewsController extends Controller
{


    /**
     * @return View
     */
    public function getAllNews(): View
    {
        $repository = new NewsRepository();

        $repository->upload();

        $response = $repository->getAll();

        return view('main', [
            'news' => $response->toArray(),
        ]);
    }
}
