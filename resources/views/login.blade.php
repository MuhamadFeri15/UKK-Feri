<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>
            <form role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="email"
                        value="{{ old('email') }}"
                        required
                    />
                </div>
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="password"
                        value="{{ old('password') }}"
                        required
                    />
                </div>

                <button
                    type="submit"
                    class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Login
                </button>
            </form>
        </div>
    </body>
</html>