<?php

namespace App\Helpers;

use App\Models\Roles;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Order;
use App\Models\FooterFeatures;
use App\Models\Ratting;
use App\Models\User;
use App\Models\Time;
use App\Models\Languages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;
use App;
use App\Models\WhatsappMessage;
use App\Models\CustomStatus;
use App\Models\Promocode;
use App\Models\Settings;
use App\Models\SocialLinks;
use App\Models\SystemAddons;
use App\Models\AgeVerification;
use App\Models\Tax;
use App\Models\TopDeals;
use Carbon\Carbon;

class helper
{
    public static function push_notification($token, $title, $body, $type, $order_id)
    {
        $customdata = array(
            "type" => $type,
            'sub_type' => "",
            'category_id' => "",
            'category_name' => "",
            'item_id' => "",
            "order_id" => $order_id,
        );
        if ($title == "") {
            $title = @helper::appdata()->website_title;
        }
        $msg = array(
            'body' => $body,
            'title' => $title,
            'sound' => 1/*Default sound*/
        );
        $fields = array(
            'to'           => $token,
            'notification' => $msg,
            'data' => $customdata
        );
        $headers = array(
            'Authorization: key=' . @helper::appdata()->firebase,
            'Content-Type: application/json'
        );
        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public static function image_path($image)
    {
        $path = url(env('ASSETSPATHURL') . 'admin-assets/images/item-placeholder.png');
        if (Str::contains($image, 'noaccess')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/' . $image);
            }
        }
        if (Str::contains($image, 'category')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/category/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/category/' . $image);
            }
        }
        if (Str::contains($image, 'profile') || Str::contains($image, 'unknown') || Str::contains($image, 'identity')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/profile/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/profile/' . $image);
            }
        }
        if (Str::contains($image, 'item')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/item/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/item/' . $image);
            }
        }
        if (Str::contains($image, 'banner-')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/banner/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/banner/' . $image);
            }
        }
        if (Str::contains($image, 'slider')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/slider/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/slider/' . $image);
            }
        }
        if (Str::contains($image, 'theme')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/theme/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/theme/' . $image);
            }
        }
        if (Str::contains($image, 'store_review')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/reviews/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/reviews/' . $image);
            }
        }
        if (Str::contains($image, 'mobile_app_bg_image') || Str::contains($image, 'booknow_bg_image') || Str::contains($image, 'reviews_bg_image') || Str::contains($image, 'refer_earn_bg_image') || Str::contains($image, 'subscribe_newsletter_image') || Str::contains($image, 'auth_bg_image') || Str::contains($image, 'no_data_image') || Str::contains($image, 'authformbgimage') || Str::contains($image, 'app_bottom_image') || Str::contains($image, 'mobile_app_image') || Str::contains($image, 'faqs_image') || Str::contains($image, 'blog') || Str::contains($image, 'veg') || Str::contains($image, 'gallery') || Str::contains($image, 'tutorial') || Str::contains($image, 'team') || Str::contains($image, 'choose_us') || Str::contains($image, 'why_choose_image') || Str::contains($image, 'default') || Str::contains($image, 'about') || Str::contains($image, 'footer') || Str::contains($image, 'logo') || Str::contains($image, 'favicon') || Str::contains($image, 'og_image')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/about/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/about/' . $image);
            }
        }
        if (Str::contains($image, 'payment-') || Str::contains($image, 'cod') || Str::contains($image, 'wallet') || Str::contains($image, 'razorpay') || Str::contains($image, 'paystack') || Str::contains($image, 'stripe')  || Str::contains($image, 'flutterwave') || Str::contains($image, 'paytab') || Str::contains($image, 'phonepe') || Str::contains($image, 'mollie') || Str::contains($image, 'toyyibpay') || Str::contains($image, 'khalti') || Str::contains($image, 'mercadopago') || Str::contains($image, 'myfatoorah') || Str::contains($image, 'paypal')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/about/payment/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/about/payment/' . $image);
            }
        }
        if (Str::contains($image, 'flag')) {
            if (file_exists(env('ASSETSPATHURL') . 'admin-assets/images/language/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/language/' . $image);
            }
        }
        if (Str::contains($image, 'quick-')) {
            if (file_exists(storage_path('app/public/admin-assets/images/about/' . $image))) {
                $path = url(env('ASSETSPATHURL') . 'admin-assets/images/about/' . $image);
            }
        }
        return $path;
    }
    public static function web_image_path($image)
    {
        $path = url(env('ASSETSPATHURL') . 'admin-assets/images/item-placeholder.png');
        if (Str::contains($image, 'refer') || Str::contains($image, 'nexticon') || Str::contains($image, 'playstore') || Str::contains($image, 'appstore') || Str::contains($image, 'bg1') || Str::contains($image, 'bg2') || Str::contains($image, 'breadcrumb_bg') || Str::contains($image, 'section_bg') || Str::contains($image, 'footer_bg') || Str::contains($image, 'facebook') || Str::contains($image, 'google') || Str::contains($image, 'delivery') || Str::contains($image, 'takeaway') || Str::contains($image, 'cod') || Str::contains($image, 'wallet') || Str::contains($image, 'razorpay') || Str::contains($image, 'paystack') || Str::contains($image, 'stripe')  || Str::contains($image, 'flutterwave')) {
            if (file_exists(env('ASSETSPATHURL') . 'web-assets/images/' . $image)) {
                $path = url(env('ASSETSPATHURL') . 'web-assets/images/' . $image);
            }
        }
        return $path;
    }
    public static function verificationemail($email, $otp)
    {
        $data = ['title' => trans('messages.email_code'), 'email' => $email, 'otp' => $otp, 'logo' => helper::image_path(@helper::appdata()->logo)];
        try {
            Mail::send('email.emailverification', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function send_pass($email, $name, $password)
    {
        $data = ['title' => trans('labels.new_password'), 'email' => $email, 'name' => $name, 'password' => $password, 'logo' => helper::image_path(@helper::appdata()->logo)];
        try {
            Mail::send('email.email', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            dd($th->messages);
            return 0;
        }
    }
    public static function referral($email, $name, $toname, $referralmessage)
    {
        $data = ['title' => trans('labels.referral_earning'), 'email' => $email, 'name' => $name, 'toname' => $toname, 'logo' => helper::image_path(@helper::appdata()->logo), 'referralmessage' => $referralmessage];
        try {
            Mail::send('email.referral', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function create_order_invoice($user_email, $user_name, $order_number, $orderdata, $itemdata)
    {
        $data = ['title' => trans('labels.order_placed'), 'email' => $user_email, 'name' => $user_name, 'order_number' => $order_number, 'orderdata' => $orderdata, 'itemdata' => $itemdata, 'logo' => helper::image_path(@helper::appdata()->logo)];
        try {
            Mail::send('email.emailinvoice', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function order_status_email($email, $name, $title, $message_text)
    {
        $data = ['email' => $email, 'name' => $name, 'title' => $title, 'message_text' => $message_text, 'logo' => helper::image_path(@helper::appdata()->logo)];
        try {
            Mail::send('email.orderemail', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function get_roles()
    {
        $data = Roles::select('modules')->where('id', Auth::user()->role_id)->first();
        return @$data->modules;
    }
    public static function get_user_cart()
    {
        $count = 0;
        if (Auth::user()) {
            $count = Cart::where('user_id', Auth::user()->id)->where('buynow', 0)->count();
        } else {
            $count = Cart::where('session_id', Session::getId())->where('buynow', 0)->count();
        }
        return $count;
    }
    public static function currency_format($price)
    {
        $price = (float)$price;
        if (@helper::appdata()->currency_position == "1") {
            if (@helper::appdata()->decimal_separator == "1") {
                if (@helper::appdata()->currency_space == "1") {
                    return @helper::appdata()->currency . ' ' . number_format($price, @helper::appdata()->currency_formate, '.', ',');
                } else {
                    return @helper::appdata()->currency . number_format($price, @helper::appdata()->currency_formate, '.', ',');
                }
            } else {
                if (@helper::appdata()->currency_space == "1") {
                    return @helper::appdata()->currency . ' ' . number_format($price, @helper::appdata()->currency_formate, ',', '.');
                } else {
                    return @helper::appdata()->currency . number_format($price, @helper::appdata()->currency_formate, ',', '.');
                }
            }
        }
        if (@helper::appdata()->currency_position == "2") {
            if (@helper::appdata()->decimal_separator == "1") {
                if (@helper::appdata()->currency_space == "1") {
                    return number_format($price, @helper::appdata()->currency_formate, '.', ',') . ' ' . @helper::appdata()->currency;
                } else {
                    return number_format($price, @helper::appdata()->currency_formate, '.', ',') . @helper::appdata()->currency;
                }
            } else {
                if (@helper::appdata()->currency_space == "1") {
                    return number_format($price, @helper::appdata()->currency_formate, ',', '.') . ' ' . @helper::appdata()->currency;
                } else {
                    return number_format($price, @helper::appdata()->currency_formate, ',', '.') . @helper::appdata()->currency;
                }
            }
        }
    }
    public static function appdata()
    {
        $data = Settings::select('*', \DB::raw("CONCAT('" . url(env('ASSETSPATHURL') . 'admin-assets/images/about') . "/', app_bottom_image) AS app_bottom_image_url"), \DB::raw("CONCAT('" . url(env('ASSETSPATHURL') . 'admin-assets/images/about') . "/', booknow_bg_image) AS booknow_bg_image_url"), \DB::raw("CONCAT('" . url(env('ASSETSPATHURL') . 'admin-assets/images/about') . "/', why_choose_image) AS why_choose_image_url"), \DB::raw('(case when app_bottom_image is null then 0 else 1 end) as is_app_bottom_image'),)->first();
        return $data;
    }
    public static function stripe_data()
    {
        return Payment::select('environment', 'public_key', 'secret_key', 'currency')->where('payment_type', '=', 4)->where('is_available', 1)->first();
    }
    public static function check_alert()
    {
        if (@helper::appdata()->max_order_qty != "" && @helper::appdata()->min_order_amount != "" && @helper::appdata()->max_order_amount != "" && @helper::appdata()->address != "" && @helper::appdata()->firebase != "") {
            return 1;
        } else {
            return 0;
        }
    }
    public static function check_restaurant_closed()
    {
        if (@helper::appdata()->timezone != "") {
            date_default_timezone_set(helper::appdata()->timezone);
        }
        $checkstatus = User::find(Auth::user()->id);
        return $checkstatus->is_online;
    }

    public static function date_format($date)
    {
        return date(helper::appdata()->date_format, strtotime($date));
    }

    public static function time_format($time)
    {
        if (helper::appdata()->time_format == 1) {
            return \Carbon\Carbon::parse($time)->format('H:i');
        } else {
            return \Carbon\Carbon::parse($time)->format('h:i A');
        }
    }
    public static function number_format($number)
    {
        // $number = (float)$number;
        // return number_format($number, 2, '.', '');
        return $number;
    }
    public static function gettype($status, $type, $order_type)
    {
        $status = CustomStatus::where('order_type', $order_type)->where('type', $type)->where('id', $status)->first();
        return $status;
    }
    public static function customstauts($order_type)
    {
        $status = CustomStatus::where('order_type', $order_type)->where('is_available', 1)->where('is_deleted', 2)->orderBy('reorder_id')->get();
        return $status;
    }

    public static function check_review_exist($user_id, $item_id)
    {
        $data = Ratting::where('user_id', $user_id)->where('item_id', $item_id)->first();
        if (!empty($data)) {
            return 1;
        }
        return 0;
    }
    public static function get_theme()
    {
        $setting = Settings::first();
        return $setting->theme;
    }
    public static function emailconfigration()
    {
        $mailsettings = Settings::first();
        if ($mailsettings) {
            $emaildata = [
                'driver' => $mailsettings->mail_driver,
                'host' => $mailsettings->mail_host,
                'port' => $mailsettings->mail_port,
                'encryption' => $mailsettings->mail_encryption,
                'username' => $mailsettings->mail_username,
                'password' => $mailsettings->mail_password,
                'from'     => ['address' => $mailsettings->mail_fromaddress, 'name' => $mailsettings->mail_fromname]
            ];
        }
        return $emaildata;
    }


    // front
    public static function gettax($tax_id)
    {
        $taxArr = explode(',', $tax_id);
        $taxes = [];
        foreach ($taxArr as $tax) {
            $taxes[] = Tax::find($tax);
        }
        return $taxes;
    }

    public static function footer_features()
    {
        return FooterFeatures::select('id', 'icon', 'title', 'description')->orderByDesc('id')->get();
    }
    public static function get_categories()
    {
        return Category::with('item_info')->select('id', 'category_name', 'slug', 'image')->where('is_available', '=', '1')->where('is_deleted', '2')->orderBy('reorder_id')->get();
    }
    public static function get_item_cart($item_id)
    {
        if (Auth::user()) {
            return Cart::where('item_id', $item_id)->where('user_id', Auth::user()->id)->where('buynow', 0)->sum('qty');
        } else {
            return Cart::where('item_id', $item_id)->where('session_id', Session::getId())->where('buynow', 0)->sum('qty');
        }
    }

    public static function language()
    {
        $lang = Languages::where('is_available', '1')->get();
        if (session()->get('locale') == null) {
            $layout = Languages::select('name', 'layout', 'image', 'is_default', 'code')->where('is_default', 1)->first();
            App::setLocale($layout->code);
            session()->put('locale', $layout->code);
            session()->put('language', $layout->name);
            session()->put('flag', $layout->image);
            session()->put('direction', $layout->layout);
        } else {
            $layout = Languages::select('name', 'layout', 'image', 'is_default', 'code')->where('code', session()->get('locale'))->first();
            App::setLocale(session()->get('locale'));
            session()->put('locale', @$layout->code);
            session()->put('language', @$layout->name);
            session()->put('flag', @$layout->image);
            session()->put('direction', @$layout->layout);
        }
        return $lang;
    }

    // get language list vendor side.
    public static function available_language($vendor_id)
    {
        if ($vendor_id == "") {
            $listoflanguage = Languages::where('is_available', '1')->where('is_deleted', 2)->get();
        } else {
            $listoflanguage = Languages::where('is_deleted', 2)->get();
        }
        return $listoflanguage;
    }

    public static function getcouponcodecount($offer_code)
    {
        $count = Order::select('offer_code')->where('offer_code', $offer_code)->count();
        return $count;
    }
    public static function getoffers()
    {
        $offers = Promocode::where('is_available', 1)->where('start_date', '<=', Carbon::now()->format('Y-m-d'))->where('expire_date', '>=', Carbon::now()->format('Y-m-d'))->orderBy('id', 'desc')->get();
        return $offers;
    }

    // display dynamic paymant name
    public static function getpayment($payment_type)
    {
        $payment = Payment::select('payment_name')->where('payment_type', $payment_type)->first();
        return $payment->payment_name;
    }
    public static function paymentlist()
    {
        $payment = Payment::select('image')->where('is_available', 1)->get();
        return $payment;
    }

    public static function gettime()
    {
        $gettimings = Time::all();
        return $gettimings;
    }
    public static function getwhatsappmessage()
    {
        $data = WhatsappMessage::first();
        return $data;
    }
    public static function sociallinks()
    {
        $getsociallinks = SocialLinks::all();
        return $getsociallinks;
    }
    public static function top_deals()
    {
        date_default_timezone_set(helper::appdata()->timezone);
        $current_date  = Carbon::now()->format('Y-m-d');
        $current_time  = Carbon::now()->format('H:i:s');
        $topdeal = TopDeals::first();
        $topdeals = null;
        if (@helper::checkaddons('top_deals')) {
            if (isset($topdeal) && $topdeal->top_deals_switch == 1) {
                $startDate = $topdeal['start_date'];
                $starttime = $topdeal['start_time'];
                $endDate = $topdeal['end_date'];
                $endtime = $topdeal['end_time'];
                // Checking validity of top deal offer
                if ($topdeal->deal_type == 1) {
                    if ($current_date > $startDate) {
                        if ($current_date < $endDate) {
                            $topdeals = TopDeals::first();
                        } elseif ($current_date == $endDate) {
                            if ($current_time < $endtime) {
                                $topdeals = TopDeals::first();
                            }
                        }
                    } elseif ($current_date == $startDate) {
                        if ($current_date < $endDate && $current_time >= $starttime) {
                            $topdeals = TopDeals::first();
                        } elseif ($current_date == $endDate) {
                            if ($current_time >= $starttime && $current_time <= $endtime) {
                                $topdeals = TopDeals::first();
                            }
                        }
                    }
                } else if ($topdeal->deal_type == 2) {
                    if ($current_time >= $starttime && $current_time <= $endtime) {
                        $topdeals = TopDeals::first();
                    }
                }
            }
        }
        return $topdeals;
    }

    public static function getagedetails()
    {
        $agedetails = AgeVerification::first();
        return $agedetails;
    }

    public static function checkaddons($addons)
    {
        if (str_contains(url()->current(), 'admin')) {
            if (session()->get('demo') == "free-addon") {
                $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->where('type', 1)->first();
            } elseif (session()->get('demo') == "all-addon") {
                $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->whereIn('type', ['1', '2'])->first();
            } else {
                $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->first();
            }
        } else {
            $check = SystemAddons::where('unique_identifier', $addons)->where('activated', 1)->first();
        }

        return $check;
    }

    public static function checkthemeaddons($addons)
    {
        if (session()->get('demo') == "free-addon") {
            $check = SystemAddons::where('unique_identifier', 'LIKE', '%' . $addons . '%')->where('activated', 1)->where('type', 1)->get();
        } elseif (session()->get('demo') == "all-addon") {
            $check = SystemAddons::where('unique_identifier', 'LIKE', '%' . $addons . '%')->where('activated', 1)->whereIn('type', ['1', '2', '3'])->get();
        } else {
            $check = SystemAddons::where('unique_identifier', 'LIKE', '%' . $addons . '%')->where('activated', 1)->get();
        }
        return $check;
    }
}
