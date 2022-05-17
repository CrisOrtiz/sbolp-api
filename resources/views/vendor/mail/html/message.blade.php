@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => "http://localhost:4200/home"])
Archivo de casos - SBOLP
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} Sociedad Boliviana de Ortodoncia y Ortopedia Dentofacial - La Paz. @lang('Todos los derechos reservados.')
@endcomponent
@endslot
@endcomponent
