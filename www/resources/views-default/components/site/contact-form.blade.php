<div class="contact-form">

    <div class="{!! $containerClass ?? 'container-fluid px-0' !!}">

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
                                    {{-- imie --}}
                                    <div class="form-group">
                                        {{-- <label for="contact-firstname" aria-label="Imię">Imię</label> --}}
                                        <input type="text" name="contact[firstname]" class="form-control" id="contact-firstname" placeholder="Imię" aria-label="Imię" aria-describedby="contact-firstname-help">
                                        {{-- <small id="contact-firstname-help" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                    {{-- nazwisko --}}
                                    <div class="form-group">
                                        {{-- <label for="contact-lastname" aria-label="Imię">Nazwisko</label> --}}
                                        <input type="text" name="contact[lastname]" class="form-control" id="contact-lastname" placeholder="Nazwisko" aria-label="Nazwisko" aria-describedby="contact-lastname-help">
                                        {{-- <small id="contact-lastname-help" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                @else
                                    {{-- nazwa --}}
                                    <div class="form-group">
                                        {{-- <label for="contact-fullname" aria-label="Imię">Imię</label> --}}
                                        <input type="text" name="contact[fullname]" class="form-control" id="contact-fullname" placeholder="Imię i nazwisko" aria-label="Imię i nazwisko" aria-describedby="contact-fullname-help">
                                        {{-- <small id="contact-fullname-help" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                    </div>
                                @endif

                                {{-- telefon --}}
                                <div class="form-group">
                                    {{-- <label for="contact-phone" aria-label="Imię">Telefon</label> --}}
                                    <input type="text" name="contact[phone]" class="form-control" id="contact-phone" placeholder="Telefon" aria-label="Telefon" aria-describedby="contact-phone-help">
                                    {{-- <small id="contact-phone-help" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>
                                {{-- e-mail --}}
                                <div class="form-group">
                                    {{-- <label for="contact-email" aria-label="Imię">E-mail</label> --}}
                                    <input type="contact-email" name="contact[email]" class="form-control" id="contact-email" placeholder="E-mail" aria-label="E-mail" aria-describedby="contact-email-help">
                                    {{-- <small id="contact-email-help" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                                </div>

                            </div>

                            <div class="col-12 col-md-6">

                                {{-- tresc --}}
                                <div class="form-group">
                                    {{-- <label for="contact-content" aria-label="Imię">Treść</label> --}}
                                    <textarea class="form-control" name="contact[content]" id="contact-content" rows="3" placeholder="Treść" aria-label="Treść" aria-describedby="contact-content-help"></textarea>
                                    {{-- <small id="contact-content-help" class="form-text text-muted">We'll never share your text with anyone else.</small> --}}
                                </div>

                            </div>

                            <div class="col-12 col-md-12">
                                <div class="form-group custom-control custom-checkbox">
                                    <input name="contact[consent]" value="1" type="checkbox" class="form-control custom-control-input" id="contact-consent">
                                    <label class="custom-control-label" for="contact-consent">{!! \ViewHelper::parse($settings->contact_form_consent) !!}</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-12">
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
                        $form.find('.btn-submit').before('<div class="alert alert-warning" role="alert">{!! $settings->contact_form_errors !!}</div>');
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
