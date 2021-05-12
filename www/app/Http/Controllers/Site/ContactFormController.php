<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function send(Request $request)
    {
        $rules = [
            'contact.firstname' => 'required',
            'contact.lastname' => 'required',
            'contact.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'contact.email' => 'required|email:rfc,dns',
            'contact.content' => 'required',
            'contact.consent' => 'accepted',
        ];
        $customAttributes = [
            'contact.firstname' => __('validation.attributes.contact.firstname'),
            'contact.lastname' => __('validation.attributes.contact.lastname'),
            'contact.phone' => __('validation.attributes.contact.phone'),
            'contact.email' => __('validation.attributes.contact.email'),
            'contact.content' => __('validation.attributes.contact.content'),
            'contact.consent' => __('validation.attributes.contact.consent'),
        ];
        try {
            $validated = $request->validate($rules, [], $customAttributes);
        } catch (\Exception $e) {
            $res = [
                'status',
            ];
            return response()->json($e->errors(), $e->status);
        }

        $mailData = $validated['contact'];

        $res = $this->sendContactFormMail($mailData);

        return response()->json($res);
    }

    public function sendContactFormMail($mailData)
    {
        $mailToName = !empty($mailData['name']) ? $mailData['name'] : $mailData['firstname'] . ' ' .  $mailData['lastname'];
        $mailMessage = !empty($mailData['message']) ? $mailData['message'] : (!empty($mailData['content']) ? $mailData['content'] : '-');
        $content = [];
        $content[] = 'Od: ' . $mailToName;
        $content[] = 'Telefon: ' . $mailData['phone'];
        $content[] = 'E-mail: ' . $mailData['email'];
        $content[] =  '';
        $content[] =  $mailMessage;

        $emailsToSend = \LitSettings::get('contact_form_emails', null, 'settings');
        $emailsToSendArray = explode(',', $emailsToSend) ?? [\LitSettings::get('site_email', null, 'settings')];

        $mail = [
            'content' => implode("<br>\n\r", $content),
            'subject' => \LitSettings::get('contact_form_subject', 'Wiadomość z formularza kontaktowego: ' . config('app.name'), 'settings'),
            'to' => $emailsToSendArray,
            'cc' => $mailData['email'],
        ];

        try {
            \Mail::html($mail['content'], function($message) use ($mail) {
               $message->subject($mail['subject'])->to($mail['to'])->cc($mail['cc']);
            });
        } catch(\Exception $e) {
            return config('app.debug') === true ? ['status' => 'danger', 'message' => $e->getMessage()] : ['status' => 'danger', 'message' => \LitSettings::get('contact_form_danger', 'Error', 'settings')];
        }

        if (!empty(\Mail::failures())) {
            return ['status' => 'warning', 'message' => \Mail::failures()];
        }
        return ['status' => 'success'];
    }
}
