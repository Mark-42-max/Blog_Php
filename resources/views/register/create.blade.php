<x-layout>
    <section class="wrapper style1 align-center">

        <div class="inner medium">
            <h2>Create new user</h2>
            <form method="post" action="/register">
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li style="font-size: 1rem; color: red; text-align: left">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

                {{csrf_field()}}

                <div class="fields">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="{{old('username')}}" />
                    </div>
                    <div class="field">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}" />
                    </div>
                    <div class="field ">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{old('email')}}" />
                    </div>
                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" value="" />
                    </div>
                </div>
                <ul class="actions special">
                    <li><input type="submit" name="submit" id="submit" value="Create User" /></li>
                    <li><a href="/register/google" class="button big wide smooth-scroll-middle">Sign up With Google</a></li>
                    <li><a href="/register/facebook" class="button big wide smooth-scroll-middle">Sign up With Facebook</a></li>
                    <li><a href="/" class="button big wide smooth-scroll-middle">Back to home page</a></li>

                </ul>
            </form>

        </div>
    </section>
    <x-footer />
</x-layout>
