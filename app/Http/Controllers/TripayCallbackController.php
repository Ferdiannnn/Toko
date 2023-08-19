<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Transactopm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TripayCallbackController extends Controller
{
    // Isi dengan private key anda
    protected $privateKey = '2AIqf-IT1me-5vGS8-msYMC-Ply6N';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }
        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $reference = $data->reference;
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $Transaction = Transaction::where('reference', $reference)
                ->where('status', '=', 'UNPAID')
                ->first();

            if (!$Transaction) {
                return Response::json([
                    'success' => false,
                    'message' => 'No Transaction found or already paid: ' . $reference,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $Transaction->update(['status' => 'PAID']);
                    break;

                case 'EXPIRED':
                    $Transaction->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $Transaction->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }
    }
}