<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use App\Model\Category;
use App\Model\Coupon;
use App\Model\Item;
use App\model\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MessengerController extends Controller
{
    public function index()
    {
        // here we can verify the webhook.
        // i create a method for that.
        $this->verifyAccess();

        $input   = json_decode(file_get_contents('php://input'), true);

        $id 	 = $input['entry'][0]['messaging'][0]['sender']['id'];
        $message = '';

        if (isset($input['entry'][0]['messaging'][0]['postback']['payload'])) {
            $message = $input['entry'][0]['messaging'][0]['postback']['payload'];
        } else {
            $message = $input['entry'][0]['messaging'][0]['message']['text'];
        }
        $user    = json_decode($this->getUser($id));

        Cache::get('lang') == '' ? Cache::put('lang', 'ar', Carbon::tomorrow()) : '';
        $lang = Cache::get('lang');

        if($message == __('bot.' .$lang. '.main_menu')) {
            $response = $this->mainMenu($id, $user);
        } elseif ($message == __('bot.'. $lang .'.visit_website')) {
            $response = $this->visitWebsite($id);
        } elseif ($message == __('bot.' . $lang . '.categories')) {
            $response = $this->categories($id);
        } elseif (substr($message, -8) == 'Category'){
            $response = $this->categoryItems($id, $message);
        } elseif (substr($message, 0, 8) == 'add_cart'){
            $response = $this->addToCart($id, $message);
        } elseif (substr($message, 0, 11) == 'remove_cart'){
            $response = $this->removeFromCart($id, $message);
        } elseif($message == 'view_cart') {
            $response = $this->showCart($id);
        } elseif ($message == 'ar' || $message == 'en') {
            $this->switchLang($message);
            $response = $this->mainMenu($id, $user);
        } elseif ($message == __('bot.' . $lang . '.track_order' )) {
            $response = $this->showOrders($id);
        } elseif (substr($message, 0, 5) == 'order') {
            $response = $this->showStatus($id, $message);
        } elseif ($message == 'coupon') {
            $response = $this->askCoupon($id);
        } elseif (substr($message, 0, 6) == 'coupon') {
            $response = $this->showOrdersWithCoupon($id, $message);
        } else {
            $response = $this->mainMenu($id, $user);
        }


        $this->sendMessage($response);
    }

    protected function getUser($id = null)
    {
        $url = "https://graph.facebook.com/v8.0/{$id}?fields=first_name,last_name,profile_pic&access_token=" . env('FACE_ACCESS_TOKEN');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $user = curl_exec($ch);
        curl_close($ch);

        return $user;
    }

    public function quickReplies($lang)
    {
        return [
            [
                "content_type" => "text",
                "title" => trans('bot.'. $lang .'.categories'),
                "payload" => "http://monraytravel.com/appointments"
            ], [
            "content_type" => "text",
            "title" => __('bot.'. $lang .'.visit_website'),
            "payload" => "http://monraytravel.com/appointments"
            ], [
                "content_type" => "text",
                "title" => 'ar',
                "payload" => "http://monraytravel.com/appointments"
            ], [
                "content_type" => "text",
                "title" => 'en',
                "payload" => "http://monraytravel.com/appointments"
            ], [
                "content_type" => "text",
                "title" => __('bot.'. $lang .'.track_order'),
                "payload" => "http://monraytravel.com/appointments"
            ]
        ];
    }

    public function mainMenu($id, $user)
    {
        $lang = Cache::get('lang');
        return [
            'recipient' => ['id' => $id ],
            'messaging_type' => 'RESPONSE',
            'message'  => [
                'text' =>  __('bot.'. $lang .'.hi') . ' ' . $user->first_name . ' ' . __('bot.' . $lang . '.welcome_message') ,
                'quick_replies' => $this->quickReplies($lang)
            ]
        ];
    }

    public function visitWebsite($id)
    {
        $lang = Cache::get('lang');
        return [
            'recipient' => ['id' => $id ],
            'message'  => [
                'attachment' => [
                    'type'  => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements'  => [
                            [
                                'title'     => __('bot.' . $lang . '.welcome'),
                                'image_url' => 'https://image.shutterstock.com/image-vector/coffee-cup-icon-vector-symbol-600w-1082019227.jpg',
                                'subtitle'  => __('bot.'. $lang .'.hello_everyone'),
                                'default_action' => [
                                    'type' => 'web_url',
                                    'url'   => 'http://monraytravel.com',
                                    'webview_height_ratio'  => 'tall'
                                ], 'buttons'    => [
                                    [
                                        'type'  => 'web_url',
                                        'url'   => 'http://monraytravel.com',
                                        'title' => __('bot.'. $lang .'.visit_website')
                                    ], [
                                        'type'  => 'postback',
                                        'payload'   => __('bot.main_menu'),
                                        'title' => __('bot.'. $lang .'.main_menu')
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function categories($id)
    {
        $lang = Cache::get('lang');
        $categories = Category::all()->toArray();
        $temp = [];

        for ($i = 0; $i < count($categories); $i++) {
            array_push($temp, [
                "content_type" => "text",
                "title" =>  $categories[$i]['name_en'] . " Category",
                "payload" => "http://monraytravel.com/appointments/{$categories[$i]['id']}",
                "image_url" => "http://example.com/img/red.png"
            ]);
        }
        array_push($temp,
            [
                "content_type" => "text",
                "title" => __('bot.'. $lang .'.visit_website'),
                "payload" => "http://monraytravel.com/appointments"
            ],
            [
                "content_type" => "text",
                "title" => __('bot.'. $lang .'.main_menu'),
                "payload" => "http://monraytravel.com/appointments"
            ]);

        return [
            'recipient' => ['id' => $id ],
            'messaging_type' => 'RESPONSE',
            'message'  => [
                'text' => __('bot.'. $lang .'.tasty_categories'),
                'quick_replies' => $temp
            ]
        ];
    }

    public function categoryItems($id, $message)
    {
        $lang = Cache::get('lang');
        $category_name = substr($message, '0', '-9');
        $category = Category::where('name_en', 'like', '%' . $category_name . '%')->first();
        $category_id = $category->id;
        $items = Item::where('category_id', $category_id)->get()->toArray();

        $carts = Cart::where('user_id', $id)->get();
        $itemsIds = array();
        foreach ($carts as $cart) {
            array_push($itemsIds, $cart->item_id);
        }

        $temp = [];
        for ($i = 0; $i < count($items); $i++) {
            array_push($temp,
                    [
                        'title' => $items[$i]['title'],
                        'subtitle' => $items[$i]['content'],
                        "image_url" => "https://image.shutterstock.com/image-vector/coffee-cup-icon-vector-symbol-600w-1082019227.jpg",
                        'default_action' => [
                            "type" => "web_url",
                            "url" => "https://91a105edf6b8.ngrok.io/",
                            "webview_height_ratio" => "tall"
                        ],
                        'buttons' => [
                            [
                                "type" => "postback",
                                "payload" => in_array($items[$i]['id'], $itemsIds) == true ? 'remove_cart-' . $items[$i]['id'] . '-' . $category_name : "add_cart-" . $items[$i]['id']. '-' . $category_name,
                                "title" => in_array($items[$i]['id'], $itemsIds) == true ?  __('bot.' . $lang . '.remove_from_cart') :  __('bot.' . $lang . '.add_to_cart'),
                            ],
                            [
                                "type" => "postback",
                                "payload" => "view_cart",
                                "title" => __('bot.'. $lang .'.view_cart'),
                            ],
                            [
                                "type" => "postback",
                                "payload" => __('bot.'. $lang .'.main_menu'),
                                "title" => __('bot.'. $lang .'.main_menu'),
                            ]
                        ]
                    ]);
        }

        return
            [
            'recipient' => ['id' => $id ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements' => $temp,
                    ]
                ]
            ]
        ];
    }

    public function addToCart($id, $message)
    {
        $all_message = explode('-', $message);
        $item_id = $all_message[1];
        Cart::create([
            'user_id'   => $id,
            'item_id'   => $item_id,
            'quantity'  => 1
        ]);

        return $this->categoryItems($id, $all_message[2]);
    }

    public function removeFromCart($id, $message)
    {
        $all_message = explode('-', $message);
        $item_id = $all_message[1];
        $cart = Cart::where('item_id', $item_id)->where('user_id', $id)->first();
        $cart->delete();

        if (isset($all_message[2])) {
            return $this->categoryItems($id, $all_message[2]);
        } else {
            return $this->showCart($id);
        }
    }

    public function showCart($id)
    {
        $lang = Cache::get('lang');
        $carts = Cart::with('items')->where('user_id', $id)->get()->toArray();
        $temp = [];

        for ($i = 0; $i < count($carts); $i++) {
            array_push($temp,
                [
                    'title' => $carts[0]['items']['title'],
                    'subtitle' => $carts[0]['items']['content'],
                    "image_url" => "https://91a105edf6b8.ngrok.io/",
                    'default_action' => [
                        "type" => "web_url",
                        "url" => "https://91a105edf6b8.ngrok.io/",
                        "webview_height_ratio" => "tall"
                    ],
                    'buttons' => [
                        [
                            "type" => "postback",
                            "payload" => 'remove_cart-' . $carts[$i]['items']['id'],
                            "title" => __('bot.' . $lang . '.remove_from_cart'),
                        ],
                        [
                            "type" => "postback",
                            "payload" => __('bot.main_menu'),
                            "title" => __('bot.' . $lang . '.main_menu'),
                        ]
                    ]
                ]);
        }

        return
            [
                'recipient' => ['id' => $id ],
                'message' => [
                    'attachment' => [
                        'type' => 'template',
                        'payload' => [
                            'template_type' => 'generic',
                            'elements' => $temp,
                        ]
                    ]
                ]
            ];
    }

    public function switchLang($message)
    {
        Cache::put('lang', $message, Carbon::tomorrow());
    }

    public function showOrders($id)
    {
        $lang = Cache::get('lang');
        $total_prices = 0;
        $orders = Orders::with('items')
                    ->where('user_id', $id)
                    ->where('status', '!=' , 'Delivered')
                    ->get()
                    ->toArray();
        if (count($orders) > 0) {
            $temp = [];
            for ($i = 0; $i < count($orders); $i++) {
                $price = $orders[$i]['items']['price'];
                array_push($temp,
                    [
                        'type'  => 'postback',
                        'payload'   => "order-{$orders[$i]['id']}",
                        'title' => $orders[$i]['items']['title'] . "- $price LE"
                    ]);
                $total_prices += $orders[$i]['items']['price'];
            }
            array_push($temp,
                [
                    'type'  => 'postback',
                    'payload'   => 'coupon',
                    'title' => __('bot.'. $lang .'.apply_coupon')
                ]);
            array_push($temp,
                [
                    "type" => "postback",
                    "title" => __('bot.'. $lang .'.main_menu'),
                    "payload" => "http://monraytravel.com/appointments"
                ]);

            return [
                'recipient' => ['id' => $id ],
                'message'  => [
                    'attachment' => [
                        'type'  => 'template',
                        'payload' => [
                            'template_type' => 'generic',
                            'elements'  => [
                                [
                                    'title'     => __('bot.' . $lang . '.welcome'),
                                    'image_url' => 'https://image.shutterstock.com/image-vector/coffee-cup-icon-vector-symbol-600w-1082019227.jpg',
                                    'subtitle'  => __('bot.'. $lang .'.orders') . '-' . __('bot.'. $lang .'.total_price') . '-' . $total_prices . ' LE',
                                    'default_action' => [
                                        'type' => 'web_url',
                                        'url'   => 'http://monraytravel.com',
                                        'webview_height_ratio'  => 'tall'
                                    ], 'buttons'    => $temp
                                ]
                            ]
                        ]
                    ]
                ]
            ];

        } else {
            return [
                'recipient' => ['id' => $id ],
                'message'   => [
                    'text'  => __('bot.' . $lang .'.no_orders'),
                    'quick_replies' => $this->quickReplies($lang)
                ]
            ];
        }
    }

    public function askCoupon($id)
    {
        $lang = Cache::get('lang');
        return [
            'recipient' => ['id' => $id ],
            'message' => [
                'text'  => __('bot.' . $lang . '.ask_coupon')
            ]
        ];
    }

    public function showOrdersWithCoupon($id, $message)
    {
        $lang = Cache::get('lang');
        $orders = Orders::with('items')
            ->where('user_id', $id)
            ->where('status', '!=' , 'Delivered')
            ->get()
            ->toArray();
        $temp = [];

        $coupon = Coupon::where('title', 'like', "%$message%")->first();
        $coupon_value = $coupon->value;
        $total_price = 0;
        for ($i = 0; $i < count($orders); $i++) {
            array_push($temp, [
                'type'  => 'postback',
                'payload'   => 'payload',
                'title' => $orders[$i]['items']['title'] . '-' . $orders[$i]['items']['price']  . ' LE'
            ]);
            $total_price += $orders[$i]['items']['price'];
        }

        $total = $total_price  - $coupon_value;

        array_push($temp,
            [
                'type'  => 'web_url',
                'url'   => 'http://monraytravel.com',
                'title' => __('bot.'. $lang .'.visit_website')
            ], [
                'type'  => 'postback',
                'payload'   => __('bot.main_menu'),
                'title' => __('bot.'. $lang .'.main_menu')
            ]);

        return [
            'recipient' => ['id' => $id ],
            'message'  => [
                'attachment' => [
                    'type'  => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements'  => [
                            [
                                'title'     => __('bot.' . $lang . '.welcome'),
                                'image_url' => 'https://image.shutterstock.com/image-vector/coffee-cup-icon-vector-symbol-600w-1082019227.jpg',
                                'subtitle'  =>  __('bot.' . $lang . '.total_price') . '-' . $total  . ' LE',
                                'default_action' => [
                                    'type' => 'web_url',
                                    'url'   => 'http://monraytravel.com',
                                    'webview_height_ratio'  => 'tall'
                                ], 'buttons'    => $temp
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function showStatus($id, $message)
    {
        $lang = Cache::get('lang');
        $orderId = explode('-', $message)[1];
        $order = Orders::findOrFail($orderId);

        return [
            'recipient' => ['id' => $id ],
            'messaging_type' => 'RESPONSE',
            'message'  => [
                'text' => __('bot.'. $lang .'.order_status'),
                'quick_replies' => [
                    [
                        "content_type" => "text",
                        "title" =>  $order->status,
                        "payload" => "Main Menu",
                        "image_url" => "http://example.com/img/red.png"
                    ], [
                        "content_type" => "text",
                        "title" =>  'Main Menu',
                        "payload" => "Main Menu",
                        "image_url" => "http://example.com/img/red.png"
                    ],
                ]
            ]
        ];
    }

    protected function sendMessage($response)
    {
        // set our post
        $ch = curl_init('https://graph.facebook.com/v8.0/me/messages?access_token=' . env('FACE_ACCESS_TOKEN'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_exec($ch);
        curl_close($ch);
    }

    protected function verifyAccess()
    {
        // FACEBOOK_MESSENGER_WEBHOOK_TOKEN is not exist yet.
        // we can set that up in our .env file
        $local_token = env('FACEBOOK_MESSENGER_WEBHOOK_TOKEN');
        $hub_verify_token = request('hub_verify_token');

        // condition if our local token is equal to hub_verify_token
        if ($hub_verify_token === $local_token) {
            // echo the hub_challenge in able to verify.
            echo request('hub_challenge');
            exit;
        }
    }

}
