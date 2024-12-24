<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{
    public function create_razorpay_order_id(Request $request)
    {
        request()->validate([
            'course_id' => 'required|numeric',
        ]);

        $api = new Api(config('app.RAZORPAY_KEY', ''), config('app.RAZORPAY_SECRET', ''));

        $course_id = $request->input('course_id');
        $amount = Course::find($course_id)->price * 100;

        $order = $api->order->create([
            'receipt' => 'order_receipt_' . Auth::id() . '_' . time(),
            'amount' => $amount,
            'currency' => 'INR',
            'notes' => [
                'purchased_by_id' => Auth::id(),
                'course_id' => $course_id,
            ],
        ]);

        return response()->json($order->id);
    }

    public function verify_razorpay_payment(Request $request)
    {
        request()->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
            'course_id' => 'required|numeric',
        ]);

        $razorpay_payment_id = $request->input('razorpay_payment_id');
        $razorpay_order_id = $request->input('razorpay_order_id');
        $razorpay_signature = $request->input('razorpay_signature');
        $course_id = $request->input('course_id');

        /*
        $api = new Api(config('app.RAZORPAY_KEY', ''), config('app.RAZORPAY_SECRET', ''));

        $attributes  = array('razorpay_signature'  => $razorpay_signature,  'razorpay_payment_id'  => $razorpay_payment_id ,  'razorpay_order_id' => $razorpay_order_id);
        $order_verified  = $api->utility->verifyPaymentSignature($attributes);
        */

        $generated_signature = hash_hmac('sha256', $request->input('razorpay_order_id') . '|' . $request->input('razorpay_payment_id'), config('app.RAZORPAY_SECRET', ''));

        if ($generated_signature == $request->input('razorpay_signature')) {

            $payment = new Payment;

            $payment->user_id = Auth::id();
            $payment->course_id = $course_id;
            $payment->razorpay_payment_data = [
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_signature' => $razorpay_signature,
            ];

            //$payment->save();
        }

        //Notification::send($user, new PaymentNotification(['amount' => '999', 'user_id' => $user->id]));
    }

    public function razorpay_webhook(Request $request)
    {
        abort_if($request->hasHeader('x-razorpay-signature') == false, 401);

        $paid_by_id = $request['payload']['payment']['entity']['notes']['purchased_by_id'];
        $course_id = $request['payload']['payment']['entity']['notes']['course_id'];

        $razorpay_payment_id = $request['payload']['payment']['entity']['id'];
        $razorpay_order_id = $request['payload']['payment']['entity']['order_id'];
        $razorpay_signature = $request->header('x-razorpay-signature');

        $amount = $request['payload']['payment']['entity']['amount'];

        /*
        Log::info($request->headers);
        Log::warning($paid_by_id);
        Log::alert($request);
        */

        //$user = User::findOrFail($paid_by_id);

        $api = new Api(config('app.RAZORPAY_KEY'), config('app.RAZORPAY_SECRET'));

        $payload = @file_get_contents('php://input');

        $generated_signature = hash_hmac('sha256', $payload, config('app.RAZORPAY_WEBHOOK_SECRET'));

        if ($generated_signature == $razorpay_signature) {
            //$user->save();
        }

        try {
            $api->utility->verifyWebhookSignature($payload, $razorpay_signature, config('app.RAZORPAY_WEBHOOK_SECRET'));

            $payment = new Payment;

            $payment->user_id = $paid_by_id;
            $payment->course_id = $course_id;
            $payment->amount = (int) $amount / 100;
            $payment->razorpay_payment_data = [
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_signature' => $razorpay_signature,
            ];

            $payment->save();

            //Notification::send(User::find($paid_by_id), new PaymentNotification(['amount' => $amount, 'user_id' => $paid_by_id]));
        } catch (SignatureVerificationError $e) {
            $error = 'Razorpay Error : ' . $e->getMessage();
            /*
            Log::debug($error);
            Log::error($razorpay_signature);
            Log::debug($razorpay_payment_id);
            Log::warning($razorpay_order_id);
            */
        }

        return response()->json([]);
    }
}
