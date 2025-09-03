<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-50 via-white to-gray-100"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_60%_40%,rgba(16,185,129,0.05),transparent_50%)]"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-16 left-16 w-20 h-20 bg-primary-500/5 rounded-full blur-xl animate-pulse delay-200"></div>
        <div class="absolute bottom-24 right-20 w-24 h-24 bg-primary-400/3 rounded-full blur-2xl animate-pulse delay-800"></div>

        <div class="relative flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
                <!-- Auth Card Container -->
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500/10 to-primary-400/10 rounded-2xl blur-xl"></div>
                    <div class="relative rounded-2xl border border-gray-200 bg-white/80 p-8 shadow-2xl backdrop-blur-xl">
                        <div class="flex flex-col gap-6">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
