<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Impak: The Most Trusted and Powerful Survey Generator Tool</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    @vite(['resources/css/home/style.css', 'resources/js/home.js'])
</head>

<body class="font-inter antialiased bg-gray-900 text-gray-200 tracking-tight">
    <!-- Page wrapper -->
    <div class="flex flex-col min-h-screen overflow-hidden">
        <!-- Site header -->
        <header class="absolute w-full z-30">
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="flex items-center justify-between h-20">

                    <!-- Site branding -->
                    <div class="shrink-0 mr-4">
                        <!-- Logo -->
                        <a class="block" href="/" aria-label="Impak">
                            <svg class="w-8 h-8 fill-current text-purple-600" viewBox="0 0 32 32"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M31.952 14.751a260.51 260.51 0 00-4.359-4.407C23.932 6.734 20.16 3.182 16.171 0c1.634.017 3.21.28 4.692.751 3.487 3.114 6.846 6.398 10.163 9.737.493 1.346.811 2.776.926 4.262zm-1.388 7.883c-2.496-2.597-5.051-5.12-7.737-7.471-3.706-3.246-10.693-9.81-15.736-7.418-4.552 2.158-4.717 10.543-4.96 16.238A15.926 15.926 0 010 16C0 9.799 3.528 4.421 8.686 1.766c1.82.593 3.593 1.675 5.038 2.587 6.569 4.14 12.29 9.71 17.792 15.57-.237.94-.557 1.846-.952 2.711zm-4.505 5.81a56.161 56.161 0 00-1.007-.823c-2.574-2.054-6.087-4.805-9.394-4.044-3.022.695-4.264 4.267-4.97 7.52a15.945 15.945 0 01-3.665-1.85c.366-3.242.89-6.675 2.405-9.364 2.315-4.107 6.287-3.072 9.613-1.132 3.36 1.96 6.417 4.572 9.313 7.417a16.097 16.097 0 01-2.295 2.275z" />
                            </svg>
                        </a>
                    </div>

                    <!-- Desktop navigation -->
                    <nav class="hidden md:flex md:grow">

                        <!-- Desktop menu links -->
                        <ul class="flex grow justify-end flex-wrap items-center">
                            <li>
                                <a class="text-gray-300 hover:text-gray-200 px-4 py-2 flex items-center transition duration-150 ease-in-out"
                                    href="/features">Features</a>
                            </li>
                            <li>
                                <a class="text-gray-300 hover:text-gray-200 px-4 py-2 flex items-center transition duration-150 ease-in-out"
                                    href="/pricing">Pricing</a>
                            </li>
                            {{-- <li>
                                <a class="text-gray-300 hover:text-gray-200 px-4 py-2 flex items-center transition duration-150 ease-in-out"
                                    href="/blog">Blog</a>
                            </li> --}}
                            <li>
                                <a class="text-gray-300 hover:text-gray-200 px-4 py-2 flex items-center transition duration-150 ease-in-out"
                                    href="/about">About us</a>
                            </li>
                            <!-- 1st level: hover -->
                            <li class="relative" x-data="{ open: false }" @mouseenter="open = true"
                                @mouseleave="open = false">
                                <a class="text-gray-300 hover:text-gray-200 px-4 py-2 flex items-center transition duration-150 ease-in-out"
                                    href="#0" aria-haspopup="true" :aria-expanded="open" @focus="open = true"
                                    @focusout="open = false" @click.prevent>
                                    Support
                                    <svg class="w-3 h-3 fill-current text-gray-500 cursor-pointer ml-1 shrink-0"
                                        viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.28 4.305L5.989 8.598 1.695 4.305A1 1 0 00.28 5.72l5 5a1 1 0 001.414 0l5-5a1 1 0 10-1.414-1.414z" />
                                    </svg>
                                </a>
                                <!-- 2nd level: hover -->
                                <ul class="origin-top-right absolute top-full right-0 w-40 bg-gray-800 py-2 ml-4 rounded-sm"
                                    x-show="open" x-transition:enter="transition ease-out duration-200 transform"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-out duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                                    <li>
                                        <a class="font-medium text-sm text-gray-400 hover:text-purple-600 flex py-2 px-4 leading-tight"
                                            href="/contact" @focus="open = true" @focusout="open = false">Contact
                                            us</a>
                                    </li>
                                    <li>
                                        <a class="font-medium text-sm text-gray-400 hover:text-purple-600 flex py-2 px-4 leading-tight"
                                            href="/help" @focus="open = true" @focusout="open = false">Help
                                            center</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                        <!-- Desktop sign in links -->
                        @guest
                        <ul class="flex grow justify-end flex-wrap items-center">
                            <li>
                                <a class="font-medium text-purple-600 hover:text-gray-200 px-4 py-3 flex items-center transition duration-150 ease-in-out"
                                    href="/sso-login">Sign in</a>
                            </li>
                            <li>
                                <a class="btn-sm text-white bg-purple-600 hover:bg-purple-700 ml-3"
                                    href="/register">Sign up</a>
                            </li>
                        </ul>
                        @endguest
                        @auth
                        <ul class="flex grow justify-end flex-wrap items-center">
                            <li>
                                <a class="font-medium text-white-600 hover:text-gray-200 px-4 py-3 flex items-center transition duration-150 ease-in-out"
                        href="/sso-login">Dashboard</a>
                            </li>
                        </ul>
                        
                        @endauth
                    </nav>

                    <!-- Mobile menu -->
                    <div class="md:hidden" x-data="{ expanded: false }">

                        <!-- Hamburger button -->
                        <button class="hamburger" :class="{ 'active': expanded }" @click.stop="expanded = !expanded"
                            aria-controls="mobile-nav" :aria-expanded="expanded">
                            <span class="sr-only">Menu</span>
                            <svg class="w-6 h-6 fill-current text-gray-300 hover:text-gray-200 transition duration-150 ease-in-out"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <rect y="4" width="24" height="2" rx="1" />
                                <rect y="11" width="24" height="2" rx="1" />
                                <rect y="18" width="24" height="2" rx="1" />
                            </svg>
                        </button>

                        <!-- Mobile navigation -->
                        <nav id="mobile-nav"
                            class="absolute top-full z-20 left-0 w-full px-4 sm:px-6 overflow-hidden transition-all duration-300 ease-in-out"
                            x-ref="mobileNav"
                            :style="expanded ? 'max-height: ' + $refs.mobileNav.scrollHeight + 'px; opacity: 1' :
                                'max-height: 0; opacity: .8'"
                            @click.outside="expanded = false" @keydown.escape.window="expanded = false" x-cloak>
                            <ul class="bg-gray-800 px-4 py-2">
                                <li>
                                    <a class="flex text-gray-300 hover:text-gray-200 py-2"
                                        href="/features">Features</a>
                                </li>
                                <li>
                                    <a class="flex text-gray-300 hover:text-gray-200 py-2"
                                        href="/pricing">Pricing</a>
                                </li>
                                {{-- <li>
                                    <a class="flex text-gray-300 hover:text-gray-200 py-2" href="/blog">Blog</a>
                                </li> --}}
                                <li>
                                    <a class="flex text-gray-300 hover:text-gray-200 py-2" href="/about">About
                                        us</a>
                                </li>
                                <li class="py-2 my-2 border-t border-b border-gray-700">
                                    <span class="flex text-gray-300 py-2">Support</span>
                                    <ul class="pl-4">
                                        <li>
                                            <a class="text-sm flex font-medium text-gray-400 hover:text-gray-200 py-2"
                                                href="/contact">Contact us</a>
                                        </li>
                                        <li>
                                            <a class="text-sm flex font-medium text-gray-400 hover:text-gray-200 py-2"
                                                href="/help">Help center</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="flex font-medium w-full text-purple-600 hover:text-gray-200 py-2 justify-center"
                                        href="/sso-login">Sign in</a>
                                </li>
                                <li>
                                    <a class="font-medium w-full inline-flex items-center justify-center border border-transparent px-4 py-2 my-2 rounded-sm text-white bg-purple-600 hover:bg-purple-700 transition duration-150 ease-in-out"
                                        href="/register">Sign up</a>
                                </li>
                            </ul>
                        </nav>

                    </div>

                </div>
            </div>
        </header>

        <!-- Page content -->
        @yield('content')

        <!-- Site footer -->
        <footer>
            <div class="py-12 md:py-16">
                <div class="max-w-6xl mx-auto px-4 sm:px-6">

                    <!-- Top area: Blocks -->
                    <div class="grid md:grid-cols-12 gap-8 lg:gap-20 mb-8 md:mb-12">

                        <!-- 1st block -->
                        <div class="md:col-span-4 lg:col-span-5">
                            <div class="mb-2">
                                <!-- Logo -->
                                <a class="inline-block" href="/" aria-label="Impak">
                                    <svg class="w-8 h-8 fill-current text-purple-600" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M31.952 14.751a260.51 260.51 0 00-4.359-4.407C23.932 6.734 20.16 3.182 16.171 0c1.634.017 3.21.28 4.692.751 3.487 3.114 6.846 6.398 10.163 9.737.493 1.346.811 2.776.926 4.262zm-1.388 7.883c-2.496-2.597-5.051-5.12-7.737-7.471-3.706-3.246-10.693-9.81-15.736-7.418-4.552 2.158-4.717 10.543-4.96 16.238A15.926 15.926 0 010 16C0 9.799 3.528 4.421 8.686 1.766c1.82.593 3.593 1.675 5.038 2.587 6.569 4.14 12.29 9.71 17.792 15.57-.237.94-.557 1.846-.952 2.711zm-4.505 5.81a56.161 56.161 0 00-1.007-.823c-2.574-2.054-6.087-4.805-9.394-4.044-3.022.695-4.264 4.267-4.97 7.52a15.945 15.945 0 01-3.665-1.85c.366-3.242.89-6.675 2.405-9.364 2.315-4.107 6.287-3.072 9.613-1.132 3.36 1.96 6.417 4.572 9.313 7.417a16.097 16.097 0 01-2.295 2.275z" />
                                    </svg>
                                </a>
                            </div>
                            <div class="text-gray-400">Lorem ipsum is placeholder text commonly used in the graphic,
                                print, and publishing industries for previewing layouts and visual mockups.</div>
                        </div>

                        <!-- 2nd, 3rd and 4th blocks -->
                        <div class="md:col-span-8 lg:col-span-7 grid sm:grid-cols-3 gap-8">

                            <!-- 2nd block -->
                            <div class="text-sm">
                                <h6 class="text-gray-200 font-medium mb-1">Other Products</h6>
                                <ul>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">WellNest</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">MoveUp</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">KembaQ</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">LAMA Care</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- 3rd block -->
                            <div class="text-sm">
                                <h6 class="text-gray-200 font-medium mb-1">Resources</h6>
                                <ul>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">Nostrud exercitation</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">Visual mockups</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">Nostrud exercitation</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">Visual mockups</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">Nostrud exercitation</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- 4th block -->
                            <div class="text-sm">
                                <h6 class="text-gray-200 font-medium mb-1">Company</h6>
                                <ul>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="/privacy-policy">Privacy Policy</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="/terms-of-service">Terms of Service</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">Android App</a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="text-gray-400 hover:text-gray-100 transition duration-150 ease-in-out"
                                            href="#0">iOS App</a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>

                    <!-- Bottom area -->
                    <div class="md:flex md:items-center md:justify-between">

                        <!-- Social links -->
                        <ul class="flex mb-4 md:order-1 md:ml-4 md:mb-0">
                            <li>
                                <a class="flex justify-center items-center text-purple-600 bg-gray-800 hover:text-gray-100 hover:bg-purple-600 rounded-full transition duration-150 ease-in-out"
                                    href="#0" aria-label="Twitter">
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M24 11.5c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4 0 1.6 1.1 2.9 2.6 3.2-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H8c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4c.7-.5 1.3-1.1 1.7-1.8z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="ml-4">
                                <a class="flex justify-center items-center text-purple-600 bg-gray-800 hover:text-gray-100 hover:bg-purple-600 rounded-full transition duration-150 ease-in-out"
                                    href="#0" aria-label="Github">
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16 8.2c-4.4 0-8 3.6-8 8 0 3.5 2.3 6.5 5.5 7.6.4.1.5-.2.5-.4V22c-2.2.5-2.7-1-2.7-1-.4-.9-.9-1.2-.9-1.2-.7-.5.1-.5.1-.5.8.1 1.2.8 1.2.8.7 1.3 1.9.9 2.3.7.1-.5.3-.9.5-1.1-1.8-.2-3.6-.9-3.6-4 0-.9.3-1.6.8-2.1-.1-.2-.4-1 .1-2.1 0 0 .7-.2 2.2.8.6-.2 1.3-.3 2-.3s1.4.1 2 .3c1.5-1 2.2-.8 2.2-.8.4 1.1.2 1.9.1 2.1.5.6.8 1.3.8 2.1 0 3.1-1.9 3.7-3.7 3.9.3.4.6.9.6 1.6v2.2c0 .2.1.5.6.4 3.2-1.1 5.5-4.1 5.5-7.6-.1-4.4-3.7-8-8.1-8z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="ml-4">
                                <a class="flex justify-center items-center text-purple-600 bg-gray-800 hover:text-gray-100 hover:bg-purple-600 rounded-full transition duration-150 ease-in-out"
                                    href="#0" aria-label="Facebook">
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M14.023 24L14 17h-3v-3h3v-2c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V14H21l-1 3h-2.72v7h-3.257z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="ml-4">
                                <a class="flex justify-center items-center text-purple-600 bg-gray-800 hover:text-gray-100 hover:bg-purple-600 rounded-full transition duration-150 ease-in-out"
                                    href="#0" aria-label="Instagram">
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="20.145" cy="11.892" r="1" />
                                        <path
                                            d="M16 20c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4zm0-6c-1.103 0-2 .897-2 2s.897 2 2 2 2-.897 2-2-.897-2-2-2z" />
                                        <path
                                            d="M20 24h-8c-2.056 0-4-1.944-4-4v-8c0-2.056 1.944-4 4-4h8c2.056 0 4 1.944 4 4v8c0 2.056-1.944 4-4 4zm-8-14c-.935 0-2 1.065-2 2v8c0 .953 1.047 2 2 2h8c.935 0 2-1.065 2-2v-8c0-.935-1.065-2-2-2h-8z" />
                                    </svg>
                                </a>
                            </li>
                            <li class="ml-4">
                                <a class="flex justify-center items-center text-purple-600 bg-gray-800 hover:text-gray-100 hover:bg-purple-600 rounded-full transition duration-150 ease-in-out"
                                    href="#0" aria-label="Linkedin">
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23.3 8H8.7c-.4 0-.7.3-.7.7v14.7c0 .3.3.6.7.6h14.7c.4 0 .7-.3.7-.7V8.7c-.1-.4-.4-.7-.8-.7zM12.7 21.6h-2.3V14h2.4v7.6h-.1zM11.6 13c-.8 0-1.4-.7-1.4-1.4 0-.8.6-1.4 1.4-1.4.8 0 1.4.6 1.4 1.4-.1.7-.7 1.4-1.4 1.4zm10 8.6h-2.4v-3.7c0-.9 0-2-1.2-2s-1.4 1-1.4 2v3.8h-2.4V14h2.3v1c.3-.6 1.1-1.2 2.2-1.2 2.4 0 2.8 1.6 2.8 3.6v4.2h.1z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>

                        <!-- Copyrights note -->
                        <div class="text-gray-400 text-sm mr-4">&copy; Impak.com. Made with love, powered by MoveUp.</div>

                    </div>

                </div>
            </div>
        </footer>
    </div>
</body>

</html>
