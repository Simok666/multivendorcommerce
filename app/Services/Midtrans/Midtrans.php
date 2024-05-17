<?php
    namespace App\Services\Midtrans;

    use Midtrans\Config;
    use Illuminate\Support\Facades\Log;

    class Midtrans {
        protected $serverKey;
        protected $isProduction;
        protected $isSanitized;
        protected $is3ds;
    
        public function __construct()
        {
            $this->serverKey = config('midtrans.server_key');
            $this->isProduction = config('midtrans.is_production');
            $this->isSanitized = config('midtrans.is_sanitized');
            $this->is3ds = config('midtrans.is_3ds');
    
            $this->_configureMidtrans();
        }
    
        public function _configureMidtrans()
        {
            Config::$serverKey = $this->serverKey;
            Config::$isProduction = $this->isProduction;
            Config::$isSanitized = $this->isSanitized;
            Config::$is3ds = $this->is3ds;

            Log::channel('custom')->info(json_encode(Config::$serverKey));
            Log::channel('custom')->info(json_encode(Config::$isProduction));
            Log::channel('custom')->info(json_encode(Config::$isSanitized));
            Log::channel('custom')->info(json_encode(Config::$is3ds));
        }
    }    
?>