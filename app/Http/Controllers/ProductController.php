<?php

namespace App\Http\Controllers;

use App\Jobs\CreateTopDawgProduct;
use App\Jobs\ModifyPublishStatus;
use App\Jobs\SaveProducts;
use App\Jobs\UpdateTopDawgProducts;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use PDO;
use phpDocumentor\Reflection\Types\Boolean;
use Shopify\Clients\Rest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function subscriptionTest($shopDomain){
        $base_url = env('BASE_URL');
        $request_url = $base_url."/payment";
        $data = array();
        $data["uid"] = $shopDomain;
        $data["storeName"] = $shopDomain;
        $user = User::where('name',$shopDomain)->first();
        $charge = DB::table('charges')->where('user_id',$user->id)->orderBy('user_id','desc')->first();
        $data["planID"] = intval($charge->terms);
        $data["transactionID"] = $charge->charge_id;
        $data["appSecret"] =$user->password;
        $response_api = Http::post($request_url, $data);
        dd(json_decode($response_api->body()));
    }

    public function generateKeyword(Request $request){
        $product_title = $request->productTitle;
        $user = User::where('id',$request->user_id)->select('name')->first();
        $base_url = env('BASE_URL');
        $request_url = $base_url.'/keywords';
        $response = Http::post($request_url, ["uid"=>"sdadsa", "text"=>$product_title]);
        return [json_decode($response->body()), $response->getStatusCode()];
    }
    
    public function showAllProducts(Request $request){
        $shop = Auth::user();
        $user_id = $shop->id;
        $link="";

        if(isset($request->pageInfo)){
            $response = $shop->api()->rest('GET', '/admin/api/2020-01/products.json', [
                'limit' => 50,
                'page_info' => $request->pageInfo,
            ]);
        }

        else{
            $response = $shop->api()->rest('GET', '/admin/api/2020-01/products.json' , [    
                'status' => "active"
            ]);
        }   
        // dd($response['body']);
        $products=$response['body']['products'];

        if(isset($response['link']['container'])){
            $link=$response['link']['container'];
        }
        else{
            $link = "";
        }
        
        $base_url = env('BASE_URL');
        $request_url = $base_url."/balance";
        $data = array();
        $data["uid"] = $shop->name;
        $response = Http::post($request_url, $data);
        $remaining_credits = json_decode($response->body());
        $credit_updated_at = User::select('updated_at')->where('id',$user_id)->first();

        $languagesFilePath = storage_path() . "/json/languages.json";
        if (!File::exists($languagesFilePath)) {
            throw new Exception("Invalid File");
        }
    
        $languagesFile = File::get($languagesFilePath);
        $languages = json_decode($languagesFile);
        
        return view('Content.products', compact('products','link', 'user_id','credit_updated_at','remaining_credits','languages'));
    }

    public function submitProduct(Request $request){
        if($request->formTitle == "description"){
            if(empty($request->title) || !isset($request->title)){
                return [$request->formTitle, 'Title is a required field!', 200];
            }
        }else{
            if(empty($request->keywords[0]) || !isset($request->keywords[0])){
                return [$request->formTitle, 'At least 1 Keyword is required to proceed!', 200];
            }
        }

        $base_url = env('BASE_URL');
        $request_url = "";
        $customResponse = [];
        $keywords = "";
        $customExamples = [];
        $customExample = "";
        $data = array();
        $shop = User::where('id',$request->user_id)->first();
        $data["uid"] = $shop->name;

        if(isset($request->keywords)){
            if(isset($request->keywords[0])){
                $keywords .= $request->keywords[0];
                for($i=1;$i<count($request->keywords);$i++){
                    $keywords .= ','.$request->keywords[$i];
                }    
            }
            $data["keywords"] = $keywords;
        }else{
            $data["title"] = $request->title;
        }



        if(isset($request->examples))
        {
            foreach($request->examples as $key=>$example){
                if(isset($request->exampleTitles[$key])){
                    $customExample = $example.':'.$request->exampleTitles[$key];
                }else{
                    $customExample = $example;
                }
                array_push($customExamples, $customExample);
            }
            
            $data["examples"] = $customExamples;
        }
            
        
        $data["completions"] = $request->completion;
        $data["outputLanguage"] = $request->outputLanguage;
        $data["inputLanguage"] = $request->inputLanguage;

        if($request->formTitle == 'title'){
            $request_url = $base_url."/title";
        }
        
        if($request->formTitle == 'description'){
            $request_url = $base_url."/description";
        }
        
        $response = Http::post($request_url, $data);

        if($response->getStatusCode() == 200){
            $customResponse = json_decode($response->body());
       
            $this->credit($shop);
            array_push($customResponse, $request->formTitle);
            array_push($customResponse, $request->productIds[0]);
            array_push($customResponse, $request->user_id);
            return $customResponse;
        }

        else if($response->getStatusCode() == 400){
            return [$request->formTitle, "Invalid User!", $response->getStatusCode()];
        }
        else if($response->getStatusCode() == 402){
            return "Insufficient Credit!";
        }
        else{
            return [$request->formTitle, "An Error Occurred Please Contact Support support@sonicmelody.com", $response->getStatusCode()];
        }

    }

    public function credit($shop)
    {
        $data = array();
        $credit_amount = $shop->credit;
        if (isset($credit_amount) && $credit_amount > 0 && $credit_amount != NULL) {
            $credit_amount = $credit_amount + 1; 
        } else {
            $credit_amount = 1;
        }

        $affectedRows = User::where("id", $shop->id)->update(["credit" => $credit_amount]);
    }

    public function publishProduct(Request $request){
        $shop = User::where('id',$request->user_id)->first();
        $dataSet = [];

        if($request->formTitle == "title"){
            $dataSet = [
                "product" => [
                    "id" => $request->productId,
                    "title" => $request->data,
                ]
            ];
        }

        if($request->formTitle == "description"){
            $dataSet = [
                "product" => [
                    "id" => $request->productId,
                    "body_html" => '<p>'.$request->data.'</p>',
                ]
            ];
        }

        $response = $shop->api()->rest('PUT', '/admin/api/2022-01/products/'.$request->productId.'.json', $dataSet);
        if($response["errors"] == false)
        {
            return "Product published successfully!";
        }
    }

    public function Plans(){
        $plans['plans'] = DB::table('plans')->get();
        return view('Content.plan', $plans);
    }

}


