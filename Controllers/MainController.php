<?php
namespace Controllers;

require_once 'Controllers/Controller.php';
use http\Client\Request;
use DigiKalaService;

class MainController extends Controller
{
    private DigiKalaService $digiKalaService;
    public function __construct(
        DigiKalaService $digiKalaService
    )
    {
        $this->digiKalaService = $digiKalaService;
    }

    public function search($request)
    {
        $slug = $request['slug'];

        $products = $this->digiKalaService->search($slug);

        $transformedProducts = [];
        foreach ($products as $product) {
            $transformedProducts[] = [
                'id' => $product['id'],
                'title' => $product['title_fa'],
                'image' => $product['images']['main']['url'][0],
                'price' => $product['default_variant']['price']['selling_price'],
            ];
        }

        empty($products) ? $this->error([], 'Didnt Found') : $this->success($transformedProducts, 'Products For This Title ');

    }

    public function product($request, $id)
    {

        $product = $this->digiKalaService->product($id);


        $transformedProduct = [
            'id' => $product['id'],
            'title' => $product['title_fa'],
            'image' => $product['images']['main']['url'][0],
            'image2' => $product['images']['list'][0]['url'][0],
            'price' => $product['default_variant']['price']['selling_price'],
        ];

       $this->success($transformedProduct, 'Products For This Id ');

    }

    public function notFound()
    {
       return $this->error([], 'Not found', 404);
    }

}