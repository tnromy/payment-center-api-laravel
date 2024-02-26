@extends('layouts.mail')

@section('content')
<p>Terima kasih telah mendaftar di Sistem Kepegawaian Kota Tangerang Selatan</p>

<p>Silakan konfirmasi email yang didaftarkan dengan mengklik link di bawah ini:</p>

<a href="{{ $verification_url }}">{{ $verification_url }}</a>

<p>Silakan abaikan email ini jika Anda tidak merasa telah melakukan registrasi di Sistem Kepegawaian Kota Tangerang Selatan</p>
@endsection()

