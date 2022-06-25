<div>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <x-forms.input rquired label="Email" type="email" name="email" placeholder="Your Email" />
        <x-forms.input rquired label="Password" type="password" name="password" placeholder="Your Password" />
        <x-forms.input rquired label="Password Confirmation" type="password" name="password_confirmation" placeholder="Repeate Password" />
        <div class="flex space-x-2">
            <x-forms.button submit action="edit" name="Register" />
            <span class="cursor-pointer" @click="auth = 'login'">or sign in</span>
        </div>
    </form>
</div>