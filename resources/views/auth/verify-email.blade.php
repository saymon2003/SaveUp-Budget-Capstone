<h2>Verify Email</h2>

<p>Please check your email and click the verification link.</p>

@if (session('status') == 'verification-link-sent')
    <p style="color: green;">
        Verification email sent!
    </p>
@endif

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Resend Email</button>
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>