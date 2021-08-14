<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
    :class="{ 'dark': dark }" x-data="data()" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Basic Helpdesk') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            .swal2-styled.swal2-confirm {
                background-color: #3f83f8 !important;
            }
        </style>
        <template x-if="dark">
			<style>
				.swal2-popup {
					background: #24262d !important;
				}
				.swal2-title {
					color: #e5e7eb !important;
				}
				.swal2-input {
					border: 2px solid #4c4f52 !important;
                    color: #e5e7eb !important;
				}
				.swal2-content {
					color: #d5d6d7 !important;
				}
                .swal2-html-container {
                    color: #e5e7eb !important;
                }
                .swal2-validation-message {
                    background: #1a1c23 !important;
                    color: #e5e7eb !important;
                }
			</style>
		</template>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/init_alpine.js') }}"></script>
        <script src="{{ asset('js/sweetalert2.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body class="dark:bg-gray-900">
        <x-nav.navigation>
            <h2 class="ml-6 mt-6 mb-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                {{ $header }}
            </h2>
            {{ $slot }}
        </x-nav.navigation>
    </body>
</html>
