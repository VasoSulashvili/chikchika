<div>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <x-forms.input rquired label="Email" type="email" name="email" placeholder="Your Email" />
        <x-forms.input rquired label="Password" type="password" name="password" placeholder="Your Password" />
        <div class="flex space-x-2">
            <x-forms.button submit action="edit" name="Login" />
            <span class="cursor-pointer" @click="auth = 'register'">or create new user</span>
        </div>
    </form>
</div>