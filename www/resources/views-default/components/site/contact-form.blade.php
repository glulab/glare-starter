<div class="contact-form">

    <div class="{!! $containerClass ?? 'container' !!}">

        <div class="row my-5">

            @if(!empty($site->contact_form_title) || !empty($site->contact_form_text))
            <div class="col-12 col-xl-4 pb-3 contact-form-description">
                @if (!empty($site->contact_form_title))<div class="contact-form-title">{{ $site->contact_form_title }}</div>@endif
                @if (!empty($site->contact_form_text))<div class="contact-form-text format">{!! $site->contact_form_text !!}</div>@endif
            </div>
            @endif
            <div class="col-12 col-xl-8">
                <div class="contact-form-form">

                    <form class="js-contact-form d-none" action="{!! route('site.contact-form') !!}" method="POST">

                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-12 col-md-6">

                                @if(config('site.options.contact-form-has-split-fullname'))
                                    <div class="form-group">
                                        <label for="contact-firstname" aria-label="{!! __('validation.attributes.contact.firstname') !!}">{!! __('validation.attributes.contact.firstname') !!}</label>
                                        <input type="text" name="contact[firstname]" class="form-control" id="contact-firstname" placeholder="{!! __('validation.attributes.contact.firstname') !!}" aria-label="{!! __('validation.attributes.contact.firstname') !!}" aria-describedby="contact-firstname-help">
                                        <small id="contact-firstname-help" class="form-text text-muted">{!! __('contact-form.help.firstname') !!}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact-lastname" aria-label="{!! __('validation.attributes.contact.lastname') !!}">{!! __('validation.attributes.contact.lastname') !!}</label>
                                        <input type="text" name="contact[lastname]" class="form-control" id="contact-lastname" placeholder="{!! __('validation.attributes.contact.lastname') !!}" aria-label="{!! __('validation.attributes.contact.lastname') !!}" aria-describedby="contact-lastname-help">
                                        <small id="contact-lastname-help" class="form-text text-muted">{!! __('contact-form.help.lastname') !!}</small>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="contact-fullname" aria-label="{!! __('validation.attributes.contact.name') !!}">{!! __('validation.attributes.contact.name') !!}</label>
                                        <input type="text" name="contact[fullname]" class="form-control" id="contact-fullname" placeholder="{!! __('validation.attributes.contact.name') !!}" aria-label="{!! __('validation.attributes.contact.name') !!}" aria-describedby="contact-fullname-help">
                                        <small id="contact-fullname-help" class="form-text text-muted">{!! __('contact-form.help.name') !!}</small>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="contact-phone" aria-label="{!! __('validation.attributes.contact.phone') !!}">{!! __('validation.attributes.contact.phone') !!}</label>
                                    <input type="text" name="contact[phone]" class="form-control" id="contact-phone" placeholder="{!! __('validation.attributes.contact.phone') !!}" aria-label="{!! __('validation.attributes.contact.phone') !!}" aria-describedby="contact-phone-help">
                                    <small id="contact-phone-help" class="form-text text-muted">{!! __('contact-form.help.phone') !!}</small>
                                </div>

                                <div class="form-group">
                                    <label for="contact-email" aria-label="{!! __('validation.attributes.contact.email') !!}">{!! __('validation.attributes.contact.email') !!}</label>
                                    <input type="contact-email" name="contact[email]" class="form-control" id="contact-email" placeholder="{!! __('validation.attributes.contact.email') !!}" aria-label="{!! __('validation.attributes.contact.email') !!}" aria-describedby="contact-email-help">
                                    <small id="contact-email-help" class="form-text text-muted">{!! __('contact-form.help.email') !!}</small>
                                </div>

                            </div>

                            <div class="col-12 col-md-6">

                                @if(\Site::contactFormHasSubjects())
                                    <div class="form-group">
                                        <label for="contact-subject" aria-label="{!! __('validation.attributes.contact.subject') !!}">{!! __('validation.attributes.contact.subject') !!}</label>
                                        {{-- <input type="text" name="contact[subject]" class="form-control" id="contact-subject" placeholder="{!! __('validation.attributes.contact.subject') !!}" aria-label="{!! __('validation.attributes.contact.subject') !!}" aria-describedby="contact-subject-help"> --}}
                                        <select name="contact[subject]" class="form-control custom-select" id="contact-subject" aria-label="{!! __('validation.attributes.contact.subject') !!}" aria-describedby="contact-subject-help">
                                            {{-- <option selected>{!! __('validation.attributes.contact.subject') !!}</option> --}}
                                            @foreach ($site->contact_form_subjects->all() as $item)
                                                <option value="{!! $item->id !!}">{!! $item->subject !!}</option>
                                            @endforeach
                                        </select>
                                        <small id="contact-subject-help" class="form-text text-muted">{!! __('contact-form.help.subject') !!}</small>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="contact-content" aria-label="{!! __('validation.attributes.contact.content') !!}">{!! __('validation.attributes.contact.content') !!}</label>
                                    <textarea class="form-control" name="contact[content]" id="contact-content" rows="3" placeholder="{!! __('validation.attributes.contact.content') !!}" aria-label="{!! __('validation.attributes.contact.content') !!}" aria-describedby="contact-content-help"></textarea>
                                    <small id="contact-content-help" class="form-text text-muted">{!! __('contact-form.help.content') !!}</small>
                                </div>

                            </div>

                            <div class="col-12 col-md-12">
                                <div class="form-group custom-control custom-checkbox contact-consent">
                                    <input name="contact[consent]" value="1" type="checkbox" class="form-control custom-control-input" id="contact-consent">
                                    <label class="custom-control-label" for="contact-consent">{!! \ViewHelper::parse($settings->contact_form_consent) !!}</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-12 alert-placeholder">
                                <button type="submit" class="btn-submit btn btn-custom text-nowrap ml-auto mr-0 d-block">{{-- <i class="far fa-paper-plane"></i>  --}}Wyślij</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

@push('scripts')
    <script>

        function contactForm() {

            $('.js-contact-form').removeClass('d-none');

            $('.js-contact-form').on('submit', function (event) {
                event.preventDefault();

                var $form = $('.js-contact-form');
                $form.find('.alert').remove();
                $form.find('.invalid-feedback').remove();
                $form.find('.form-control').removeClass('is-invalid');

                $form.find('.btn-submit').css('opacity', '0');

                var url = $('.js-contact-form').prop('action');
                window.axios.post(url, {
                    'contact': {
                        'fullname': $('[name="contact[fullname]"]').val(),
                        'firstname': $('[name="contact[firstname]"]').val(),
                        'lastname': $('[name="contact[lastname]"]').val(),
                        'phone': $('[name="contact[phone]"]').val(),
                        'email': $('[name="contact[email]"]').val(),
                        'subject': $('[name="contact[subject]"]').val(),
                        'content': $('[name="contact[content]"]').val(),
                        'consent': $('[name="contact[consent]"]').is(':checked'),
                    }
                })
                .then(function (response) {
                    console.log(response.status);
                    console.log(response.data.status);
                    if (response.status == 200 && response.data.status == 'success') {
                        $form[0].reset();
                        $form.before('<div class="alert alert-success" role="alert">{!! $settings->contact_form_success !!}</div>');
                        $form.remove();
                    }
                })
                .catch(function (error) {
                    // console.log(error.response);
                    // console.log(error.response.data);

                    if (!jQuery.isEmptyObject(error.response.data)) {
                        $form.find('.alert-placeholder').prepend('<div class="alert alert-warning" role="alert">{!! $settings->contact_form_errors !!}</div>');
                    }

                    for (var i in error.response.data) {
                        var curId = i.replace('.', '-');
                        var errors = error.response.data[i]
                        var $curElement = $form.find('#' + curId);
                        $curElement.removeClass('is-valid');
                        $curElement.addClass('is-invalid');
                        $curElement.closest('.form-group').append('<div id="'+curId+'-feedback" class="invalid-feedback"></div>');
                        $('#'+curId+'-feedback').text(errors[0]);
                    }

                    $form.find('.btn-submit').css('opacity', '1');

                })
                .then(function () {
                });
                return false;
            });
        };

        onJqueryLoad(['contactForm']);

    </script>
@endpush
