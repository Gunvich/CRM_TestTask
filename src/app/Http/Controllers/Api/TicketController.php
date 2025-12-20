<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function store(TicketRequest $data)
    {
        $customer = Customer::firstOrCreate(
            ['phone' => $data['phone']],
            ['name' => $data['name'], 'email' => $data['email']]
        );

        $ticket = $customer->tickets()->create([
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);


        $attachments = $data->file('attachment');

        if ($attachments) {
            if (!is_array($attachments)) $attachments = [$attachments];

            foreach ($attachments as $file) {
                $ticket->addMedia($file)->toMediaCollection('attachments', 'public');
            }
        }

        return response()->json([
            'id' => $ticket->id,
            'status' => $ticket->status,
            'created_at' => $ticket->created_at,
        ]);
    }
}
