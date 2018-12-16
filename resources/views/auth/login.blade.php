
<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email"></input>
    <input type="password" name="password"></input>
    <button type="submit" name="login">Login</button>
</form>
