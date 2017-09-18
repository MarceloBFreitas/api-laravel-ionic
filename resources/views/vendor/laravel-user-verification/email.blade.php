<h3>{{config('app.name')}}</h3>
<p>Sua conta foi criada com sucesso</p>

<a href="{{ $link = route('email-verification.check', $user->verification_token) . '?email=' . urlencode($user->email) }}">
    Clique aqui para verificar sua conta
</a>

<b>Não responda esse E-Mail, ele foi gerado automaticamente</b>
