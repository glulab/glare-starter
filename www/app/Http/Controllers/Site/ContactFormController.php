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
            'contact.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'contact.email' => 'required|email:rfc,dns',
            'contact.content' => 'required',
            'contact.consent' => 'accepted',
        ];
        $customAttributes = [
            'contact.phone' => __('validation.attributes.contact.phone'),
            'contact.email' => __('validation.attributes.contact.email'),
            'contact.content' => __('validation.attributes.contact.content'),
            'contact.consent' => __('validation.attributes.contact.consent'),
        ];

        $splitFullnameRules = [
            'contact.firstname' => 'required',
            'contact.lastname' => 'required',
        ];
        $splitFullnameCustomAttributes = [
            'contact.firstname' => __('validation.attributes.contact.firstname'),
            'contact.lastname' => __('validation.attributes.contact.lastname'),
        ];

        $fullnameRules = [
            'contact.fullname' => 'required',
        ];
        $fullnameCustomAttributes = [
            'contact.fullname' => __('validation.attributes.contact.fullname'),
        ];

        $hasSubjectRules = [
            'contact.subject' => 'required',
        ];
        $hasSubjectCustomAttributes = [
            'contact.subject' => __('validation.attributes.contact.subject'),
        ];

        if (config('site.options.contact-form-has-split-fullname')) {
            $rules = array_merge($splitFullnameRules, $rules);
            $customAttributes = array_unshift($splitFullnameCustomAttributes, $customAttributes);
        } else {
            $rules = array_merge($fullnameRules, $rules);
            $customAttributes = array_merge($fullnameCustomAttributes, $customAttributes);
        }

        if (\Site::contactFormHasSubjects()) {
            $rules = array_merge($hasSubjectRules, $rules);
            $customAttributes = array_merge($hasSubjectCustomAttributes, $customAttributes);
        }

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
        $mailToFullname = !empty($mailData['fullname']) ? $mailData['fullname'] : $mailData['firstname'] . ' ' .  $mailData['lastname'];
        $mailMessage = !empty($mailData['message']) ? $mailData['message'] : (!empty($mailData['content']) ? $mailData['content'] : '-');
        $content = [];
        $content[] = 'Od: ' . $mailToFullname;
        $content[] = 'Telefon: ' . $mailData['phone'];
        $content[] = 'E-mail: ' . $mailData['email'];
        $content[] =  '';
        $content[] =  $mailMessage;

        $subject = \LitSettings::get('contact_form_subject', 'Wiadomo???? z formularza kontaktowego: ' . config('app.name'), 'settings');

        if(\Site::contactFormHasSubjects() && !empty($mailData['subject'])) :
            $site = \Site::shared('site');
            $subjectId = $mailData['subject'];
            $subject .= ' : ' . $site->contact_form_subjects->pluck('subject', 'id')->get($subjectId);
            $emailsToSend = $site->contact_form_subjects->pluck('email', 'id')->get($subjectId);
        else :
            $emailsToSend = \LitSettings::get('contact_form_emails', null, 'settings');
        endif;
        $emailsToSendArray = explode(',', $emailsToSend) ?? [\LitSettings::get('site_email', null, 'settings')];

        $mail = [
            'content' => implode("<br>\n\r", $content),
            'subject' => $subject,
            'to' => $emailsToSendArray,
            'cc' => $mailData['email'],
            'reply_to' => ['name' => $mailData['firstname'] . ' ' .  $mailData['lastname'], 'address' => $mailData['email']],
        ];

        try {
            \Mail::html($mail['content'], function($message) use ($mail) {
               $message->subject($mail['subject'])->to($mail['to'])->cc($mail['cc'])->replyTo($mail['reply_to']['address'], $mail['reply_to']['name']);
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
