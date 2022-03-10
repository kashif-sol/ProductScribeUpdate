<?php namespace App\Jobs;

use App\Models\User;
use stdClass;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Osiset\ShopifyApp\Objects\Values\ShopDomain;

class PackageSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain|string
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain.
     * @param stdClass $data       The webhook data (JSON decoded).
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Package Subscription job runned');
        $shopDomain = $this->shopDomain;
        $base_url = env('BASE_URL');
        $request_url = $base_url."/payment";
        $data = array();
        $data["uid"] = $shopDomain;
        $data["storeName"] = $shopDomain;
        $user = User::where('name',$shopDomain)->first();
        $charge = DB::table('charges')->where('user_id',$user->id)->orderBy('id','desc')->first();
        $data["planID"] = intval($charge->terms);
        $data["transactionID"] = $charge->charge_id;
        $data["appSecret"] =$user->password;
        $response_api = Http::post($request_url, $data);
        Log::info('Response from Subscription :'. $response_api);
    }
}
