<div>
    @if (Auth::user()->hasPermissionTo('manage-employees'))
        <div x-data="{ modalOpen: {{ $done == false &&auth()->user()->can('manage-employees')? 'true': 'false' }} }">
            <!-- Modal backdrop -->
            <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak>
            </div>
            <!-- Modal dialog -->
            <div id="setup-modal"
                class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center px-4 sm:px-6"
                role="dialog" aria-modal="true" x-show="modalOpen"
                x-transition:enter="transition ease-in-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in-out duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
                x-cloak>
                <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full"
                    @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                    <!-- Modal header -->
                    <div class="px-5 py-3">
                        <div class="flex justify-between items-center">
                            <div class="font-semibold text-xl text-slate-800">Setup your company</div>
                            <button class="text-slate-400  hover:text-slate-500" @click="modalOpen = false">
                                <div class="sr-only">Close</div>
                                <svg class="w-4 h-4 fill-current">
                                    <path
                                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Modal content -->
                    <div class="px-8 py-6">

                        <ol class=" text-gray-500 border-l border-gray-200">
                            <li class="mb-4 ml-6 flex items-center">
                                @if ($employeeDone)
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full ring-4 ring-white"
                                        style="margin-left: -40px">

                                        <svg class="w-3.5 h-3.5 text-green-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                        </svg>
                                    </span>
                                @else
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 rounded-full ring-4 ring-white"
                                        style="margin-left: -40px; background-color: #F1F5F9; color: #64748B; font-weight: 600;">
                                        1
                                    </span>
                                @endif
                                <a href="#" class="w-full" @click="modalOpen = false; employeeModalOpen = true">
                                    <div class="w-full p-4 text-gray-900 bg-white border rounded-lg"
                                        style="border-color: #E2E8F0" role="alert">
                                        <div class="flex items-center">
                                            <svg width="26" height="23" viewBox="0 0 26 23" fill="none"
                                                class="mr-2" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.90234 10.177C12.7069 10.177 14.9805 7.89879 14.9805 5.0885C14.9805 2.2782 12.7069 0 9.90234 0C7.09777 0 4.82422 2.2782 4.82422 5.0885C4.82422 7.89879 7.09777 10.177 9.90234 10.177Z"
                                                    fill="#5356E0" />
                                                <path
                                                    d="M10.506 14.7578H9.29996L8.66992 19.4716L9.90299 21.0161L11.1361 19.4716L10.506 14.7578Z"
                                                    fill="#5356E0" />
                                                <path
                                                    d="M9.2793 13.2297H10.5278L10.7817 11.7031H9.02539L9.2793 13.2297Z"
                                                    fill="#5356E0" />
                                                <path
                                                    d="M7.11613 19.5908L7.86266 14.0053L7.47972 11.7031H6.09375C2.72827 11.7031 0 14.437 0 17.8093V22.2363C0 22.6578 0.341047 22.9996 0.761719 22.9996H9.53626L7.27629 20.1689C7.14639 20.0062 7.0885 19.7973 7.11613 19.5908Z"
                                                    fill="#5356E0" />
                                                <path
                                                    d="M15.1116 11.866C14.6622 11.76 14.1938 11.7031 13.712 11.7031H12.3261L11.9432 14.0053L12.6897 19.5908C12.7173 19.7973 12.6594 20.0062 12.5296 20.1689L10.2695 22.9996H14.2219C13.7427 22.3613 13.4581 21.5682 13.4581 20.7098V15.0106C13.4581 13.7073 14.1138 12.5548 15.1116 11.866Z"
                                                    fill="#5356E0" />
                                                <path
                                                    d="M23.7148 12.7211H23.2832V11.4489C23.2832 10.4669 22.4859 9.66797 21.5059 9.66797H19.4746C18.4946 9.66797 17.6973 10.4669 17.6973 11.4489V12.7211H17.2656C16.0036 12.7211 14.9805 13.7462 14.9805 15.0109V15.5197H26V15.0109C26 13.7462 24.9769 12.7211 23.7148 12.7211ZM21.7598 12.7211H19.2207V11.4489C19.2207 11.3087 19.3346 11.1945 19.4746 11.1945H21.5059C21.6459 11.1945 21.7598 11.3087 21.7598 11.4489V12.7211Z"
                                                    fill="#7D87F7" />
                                                <path
                                                    d="M14.9805 20.7106C14.9805 21.9752 16.0036 23.0004 17.2656 23.0004H23.7148C24.9769 23.0004 26 21.9752 26 20.7106V17.0469H14.9805V20.7106Z"
                                                    fill="#7D87F7" />
                                            </svg>


                                            <h3 class="font-medium">Add your employees</h3>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-4 ml-6 flex items-center">
                                @if ($departmentDone)
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full ring-4 ring-white"
                                        style="margin-left: -40px">

                                        <svg class="w-3.5 h-3.5 text-green-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                        </svg>
                                    </span>
                                @else
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 rounded-full ring-4 ring-white"
                                        style="margin-left: -40px; background-color: #F1F5F9; color: #64748B; font-weight: 600;">
                                        2
                                    </span>
                                @endif
                                <a href="{{ route('community.departments.list') }}" class="w-full">
                                    <div class="w-full p-4 text-gray-900 bg-white border rounded-lg"
                                        style="border-color: #E2E8F0" role="alert">
                                        <div class="flex items-center">
                                            <svg width="30" height="26" viewBox="0 0 30 26" fill="none"
                                                class="mr-2" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M30 19.4025V23.9308C29.9972 24.4787 29.7807 25.0034 29.3975 25.3908C29.0143 25.7782 28.4954 25.9972 27.9536 26H19.1893C18.6474 25.9972 18.1285 25.7782 17.7454 25.3908C17.3622 25.0034 17.1457 24.4787 17.1429 23.9308V19.4025C17.1457 18.8546 17.3622 18.33 17.7454 17.9425C18.1285 17.5551 18.6474 17.3362 19.1893 17.3333H22.5V14.0833H7.5V17.3333H10.9536C11.4955 17.3362 12.0143 17.5551 12.3975 17.9425C12.7807 18.33 12.9972 18.8546 13 19.4025V23.9308C12.9972 24.4787 12.7807 25.0034 12.3975 25.3908C12.0143 25.7782 11.4955 25.9972 10.9536 26H2.04643C1.50455 25.9972 0.985667 25.7782 0.602495 25.3908C0.219324 25.0034 0.00281501 24.4787 0 23.9308V19.4025C0.00281501 18.8546 0.219324 18.33 0.602495 17.9425C0.985667 17.5551 1.50455 17.3362 2.04643 17.3333H5.35714V14.0833C5.35714 13.5087 5.58291 12.9576 5.98477 12.5513C6.38663 12.1449 6.93168 11.9167 7.5 11.9167H13.9286V8.66667H10.6179C10.076 8.66382 9.55709 8.44491 9.17392 8.05748C8.79075 7.67005 8.57424 7.1454 8.57143 6.5975V2.06917C8.57424 1.52127 8.79075 0.996619 9.17392 0.60919C9.55709 0.221761 10.076 0.00284629 10.6179 0H19.3821C19.924 0.00284629 20.4429 0.221761 20.8261 0.60919C21.2092 0.996619 21.4258 1.52127 21.4286 2.06917V6.5975C21.4258 7.1454 21.2092 7.67005 20.8261 8.05748C20.4429 8.44491 19.924 8.66382 19.3821 8.66667H16.0714V11.9167H22.5C23.0683 11.9167 23.6134 12.1449 24.0152 12.5513C24.4171 12.9576 24.6429 13.5087 24.6429 14.0833V17.3333H27.9536C28.4954 17.3362 29.0143 17.5551 29.3975 17.9425C29.7807 18.33 29.9972 18.8546 30 19.4025Z"
                                                    fill="#6366F1" />
                                                <rect x="11" y="2" width="8" height="5"
                                                    rx="1" fill="#A5B4FC" />
                                                <rect x="2" y="19" width="4" height="5"
                                                    rx="1" fill="#A5B4FC" />
                                                <rect x="7" y="19" width="4" height="5"
                                                    rx="1" fill="#A5B4FC" />
                                                <rect x="19" y="19" width="9" height="5"
                                                    rx="1" fill="#A5B4FC" />
                                            </svg>

                                            <h3 class="font-medium">Create your departments</h3>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-4 ml-6 flex items-center">
                                @if ($groupDone)
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full ring-4 ring-white"
                                        style="margin-left: -40px">

                                        <svg class="w-3.5 h-3.5 text-green-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M1 5.917 5.724 10.5 15 1.5" />
                                        </svg>
                                    </span>
                                @else
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 rounded-full ring-4 ring-white"
                                        style="margin-left: -40px; background-color: #F1F5F9; color: #64748B; font-weight: 600;">
                                        3
                                    </span>
                                @endif
                                <a href="{{ route('community.groups.list') }}" class="w-full">
                                    <div class="w-full p-4 text-gray-900 bg-white border rounded-lg"
                                        style="border-color: #E2E8F0" role="alert">
                                        <div class="flex items-center">
                                            <svg width="27" height="26" viewBox="0 0 27 26" fill="none"
                                                class="mr-2" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.449951 24.2994H19.8H20.7V22.0494V20.6994C22.35 20.6994 25.65 20.6094 25.65 20.2494C25.65 19.8894 25.95 19.7994 26.1 19.7994V18.8994C26.1 18.4494 26.5499 17.5494 26.1 17.0994L25.2 16.1994C24.9 15.8994 24.2999 15.2094 24.2999 14.8494C24.2999 14.3994 21.6 14.3994 21.15 14.3994C20.7 14.3994 20.7 13.9494 20.7 13.4994V12.5994L22.5 10.7994V8.09941V5.39941L21.6 4.04941L18.45 3.59941L15.3 4.49941L14.85 2.69941L11.7 0.899414H8.09995C7.49995 1.64941 6.20995 3.23941 5.84995 3.59941C5.48995 3.95941 5.39995 5.84941 5.39995 6.74941L5.84995 10.7994L7.19995 12.5994L8.54995 13.9494L7.64995 16.1994L4.49995 16.6494L2.24995 18.4494L0.899951 20.6994L0.449951 24.2994Z"
                                                    fill="#A5B4FC" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M21.4443 13.6863L23.5797 14.1969C25.5935 14.6783 27.0001 16.4618 27 18.5339V20.4614C27 20.815 26.7135 21.1017 26.3602 21.1017H21.1923C21.2249 21.355 21.2418 21.613 21.2418 21.8744V23.919C21.2418 24.1564 21.2601 24.2228 21.2768 24.2853C21.2915 24.3407 21.3055 24.393 21.3055 24.5594C21.3055 24.9129 21.0191 25.1995 20.6658 25.1995H0.640038C0.286696 25.1995 0 24.9129 0 24.5592C0 24.3897 5.85797e-05 24.3313 0.000120088 24.2704C0.000186479 24.2044 0.000255798 24.1356 0.000255798 23.919L0 21.8713C0 21.611 0.0167001 21.3541 0.0490761 21.1016H0.0127401C0.071889 20.6399 0.180923 20.2135 0.327238 19.8213H0.361001C0.508102 19.4171 0.697945 19.0327 0.92573 18.6736L0.922104 18.6595C1.81106 17.3256 3.11168 16.5674 3.90257 16.2991C3.96109 16.2523 4.34292 16.1412 4.81866 16.016L6.59765 15.5893C6.59162 15.5869 6.58559 15.5844 6.57954 15.582L7.74165 15.3066V14.7397L7.74438 14.7414V13.8056C6.90492 13.3042 6.20615 12.5906 5.72253 11.7392C5.70319 11.7027 5.68444 11.667 5.66612 11.6322L5.66215 11.6247L5.32817 9.88083C5.06131 8.48747 4.96879 7.0663 5.05274 5.65007L5.13699 4.34315C5.14576 4.20703 5.1808 4.07389 5.24015 3.95107C5.27063 3.98276 5.21072 3.94125 5.24015 3.97392C5.94993 1.67468 8.09355 -0.000488281 10.6209 -0.000488281C13.1483 -0.000488281 15.292 1.67481 16.0017 3.97392C16.7346 3.16051 17.7951 2.64818 18.9731 2.64818H19.4156C21.622 2.64818 23.4171 4.44457 23.4171 6.65262V9.4859C23.4171 10.9534 22.6238 12.2383 21.4443 12.9356V13.6863ZM18.9732 3.92872C17.4723 3.92872 16.2513 5.15066 16.2513 6.65262L16.2514 6.8168C17.1747 6.8056 18.07 6.53333 18.8442 6.02632C19.0569 5.88685 19.332 5.88685 19.5448 6.02632C20.319 6.53327 21.2143 6.80553 22.1376 6.8168V6.65262C22.1376 5.15066 20.9166 3.92872 19.4157 3.92872H18.9732ZM16.2513 8.09753V8.96364L16.2511 9.48596C16.2511 10.988 17.4722 12.2099 18.9731 12.2099H19.4156C20.9165 12.2099 22.1375 10.988 22.1375 9.48596V8.09753C21.1016 8.08754 20.093 7.81764 19.1944 7.31101C18.2957 7.81758 17.2872 8.08754 16.2513 8.09753ZM16.6706 16.0784C16.9491 16.145 17.2184 16.2312 17.4784 16.3336L17.1252 14.956L15.1042 15.4407C14.9439 15.4792 14.788 15.5301 14.6371 15.5922L16.6706 16.0784ZM16.9487 13.6815V12.9381C16.3963 12.6124 15.9288 12.158 15.5872 11.6161C15.1033 12.5198 14.3803 13.2768 13.5033 13.8021V14.7378C13.9037 14.4902 14.3426 14.3065 14.8059 14.1954L16.9487 13.6815ZM10.621 13.3176C13.02 13.3176 14.9717 11.3644 14.9717 8.96364L14.9718 7.08798H14.6459C13.5951 7.08798 12.6188 6.56605 12.0346 5.692L11.888 5.47268C10.4811 6.51438 8.76974 7.08798 6.9735 7.08798H6.27031V8.96364C6.27031 11.3644 8.22203 13.3176 10.621 13.3176ZM10.6209 1.28011C8.2219 1.28011 6.27018 3.23332 6.27018 5.63405V5.80732H6.97343C9.09728 5.80732 11.0809 4.85925 12.4158 3.20617C12.638 2.93101 13.041 2.8883 13.3156 3.11063C13.5905 3.33289 13.6332 3.73604 13.4111 4.01106C13.237 4.22653 13.0533 4.43125 12.8614 4.62604L13.098 4.98001C13.4443 5.4981 14.0229 5.80738 14.6457 5.80738H14.9716V5.63411C14.9716 3.23332 13.0199 1.28011 10.6209 1.28011ZM1.27969 21.8715V23.919H9.08429L3.23353 18.0638C2.03311 18.9205 1.27969 20.3188 1.27969 21.8715ZM4.86527 17.3216C4.7165 17.3573 4.57126 17.4005 4.42915 17.4493L9.4227 22.4467L7.92092 16.5888L4.86527 17.3216ZM9.02395 14.3671V15.7385L10.6248 21.9827L12.2237 15.7458V14.3654C11.7154 14.5167 11.1775 14.5984 10.6209 14.5984C10.0663 14.5984 9.53045 14.5173 9.02395 14.3671ZM16.3733 17.3239L13.3269 16.5956L11.8242 22.4577L16.8222 17.4559C16.6759 17.4052 16.5265 17.3606 16.3733 17.3239ZM12.1736 23.919H19.9621V21.8745C19.9621 20.3247 19.2118 18.9292 18.0158 18.0724L12.1736 23.919ZM19.3039 17.4689L20.1647 14.1109V13.4192C19.9219 13.4654 19.6718 13.4906 19.4157 13.4906H18.9732C18.7187 13.4906 18.4699 13.4657 18.2284 13.42V14.1058L19.031 17.2364C19.1242 17.3115 19.2157 17.3885 19.3039 17.4689ZM20.8799 19.8212H25.7204V18.5339C25.7204 17.0569 24.7179 15.7856 23.2824 15.4425L21.2678 14.9608L20.3156 18.6754C20.543 19.034 20.7328 19.4176 20.8799 19.8212Z"
                                                    fill="#6366F1" />
                                            </svg>


                                            <h3 class="font-medium">Create your groups</h3>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="ml-6 flex items-center">
                                @if ($surveyDone)
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full ring-4 ring-white"
                                        style="margin-left: -40px">

                                        <svg class="w-3.5 h-3.5 text-green-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M1 5.917 5.724 10.5 15 1.5" />
                                        </svg>
                                    </span>
                                @else
                                    <span
                                        class="absolute flex items-center justify-center w-8 h-8 rounded-full ring-4 ring-white"
                                        style="margin-left: -40px; background-color: #F1F5F9; color: #64748B; font-weight: 600;">
                                        4
                                    </span>
                                @endif
                                <a href="{{ route('survey.drafts') }}" class="w-full">
                                    <div class="w-full p-4 text-gray-900 bg-white border rounded-lg" role="alert"
                                        style="border-color: #E2E8F0">

                                        <div class="flex items-center">
                                            <svg width="29" height="30" viewBox="0 0 29 30" fill="none"
                                                class="mr-2" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0.890634 6.95243C2.9014 12.4839 6.32421 17.5447 9.38178 16.4377C12.4393 15.3306 11.7917 9.25314 9.75833 3.72165C9.5564 3.12594 9.23748 2.57658 8.82031 2.10583C8.40314 1.63507 7.89612 1.25241 7.32902 0.980308C6.76191 0.708207 6.14616 0.552152 5.51792 0.521306C4.88967 0.490461 4.26159 0.585446 3.67056 0.800685C3.07953 1.01592 2.53746 1.34708 2.07618 1.7747C1.6149 2.20233 1.24371 2.71781 0.984394 3.29087C0.72508 3.86393 0.582875 4.48303 0.566127 5.11181C0.54938 5.74059 0.658428 6.36638 0.886868 6.95243H0.890634Z"
                                                    fill="#A5B4FC" />
                                                <path
                                                    d="M9.7591 3.72372C9.48612 2.97495 9.02806 2.30745 8.42759 1.78342C7.82712 1.25938 7.10378 0.895857 6.32496 0.726711C5.54613 0.557565 4.73717 0.588301 3.97342 0.816055C3.20968 1.04381 2.51601 1.46117 1.95703 2.02926C5.72251 1.24227 9.30724 10.351 9.86453 16.1837C12.3272 14.5947 11.6418 8.92008 9.7591 3.72372Z"
                                                    fill="#818CF8" />
                                                <path
                                                    d="M27.1903 6.95243C25.1758 12.4839 21.7568 17.5447 18.7143 16.4377C15.6718 15.3306 16.3044 9.25314 18.3189 3.72165C18.5208 3.12594 18.8397 2.57658 19.2569 2.10583C19.6741 1.63507 20.1811 1.25241 20.7482 0.980308C21.3153 0.708207 21.931 0.552152 22.5593 0.521306C23.1875 0.490461 23.8156 0.585446 24.4066 0.800685C24.9977 1.01592 25.5397 1.34708 26.001 1.7747C26.4623 2.20233 26.8335 2.71781 27.0928 3.29087C27.3521 3.86393 27.4943 4.48303 27.5111 5.11181C27.5278 5.74059 27.4188 6.36638 27.1903 6.95243Z"
                                                    fill="#A5B4FC" />
                                                <path
                                                    d="M18.3177 3.72372C18.5906 2.97495 19.0487 2.30745 19.6492 1.78342C20.2496 1.25938 20.973 0.895857 21.7518 0.726711C22.5306 0.557565 23.3396 0.588301 24.1033 0.816055C24.8671 1.04381 25.5608 1.46117 26.1197 2.02926C22.3542 1.24227 18.7695 10.351 18.2122 16.1837C15.7534 14.5947 16.4274 8.92008 18.3177 3.72372Z"
                                                    fill="#818CF8" />
                                                <path
                                                    d="M25.7823 20.638C25.7823 14.5719 20.5106 9.65039 14.0415 9.65039C7.57245 9.65039 2.30078 14.5719 2.30078 20.638C2.30078 26.7042 7.1959 29.0351 13.68 29.0351C20.1642 29.0351 25.7823 26.708 25.7823 20.638Z"
                                                    fill="#A5B4FC" />
                                                <path
                                                    d="M20.0161 17.252C19.5071 17.2529 19.0192 17.4556 18.6593 17.8155C18.2993 18.1754 18.0967 18.6633 18.0957 19.1723C18.0957 19.3321 18.1592 19.4854 18.2722 19.5984C18.3852 19.7113 18.5384 19.7748 18.6982 19.7748C18.858 19.7748 19.0112 19.7113 19.1242 19.5984C19.2372 19.4854 19.3007 19.3321 19.3007 19.1723C19.3138 18.9911 19.3951 18.8215 19.5282 18.6977C19.6612 18.574 19.8362 18.5051 20.018 18.5051C20.1997 18.5051 20.3747 18.574 20.5078 18.6977C20.6409 18.8215 20.7222 18.9911 20.7353 19.1723C20.7353 19.3321 20.7988 19.4854 20.9118 19.5984C21.0247 19.7113 21.178 19.7748 21.3378 19.7748C21.4976 19.7748 21.6508 19.7113 21.7638 19.5984C21.8768 19.4854 21.9403 19.3321 21.9403 19.1723C21.9393 18.6627 21.7361 18.1742 21.3754 17.8142C21.0146 17.4542 20.5258 17.252 20.0161 17.252Z"
                                                    fill="#6366F1" />
                                                <path
                                                    d="M25.5199 10.7943C25.3791 10.7177 25.2136 10.7001 25.0597 10.7453C24.9059 10.7904 24.7762 10.8947 24.6991 11.0352L24.6463 11.1256C24.6356 11.2631 24.6724 11.4001 24.7506 11.5137C24.8287 11.6274 24.9434 11.7108 25.0757 11.75C25.2079 11.7892 25.3495 11.7819 25.477 11.7292C25.6044 11.6766 25.71 11.5818 25.776 11.4607L25.8099 11.3892C25.8239 11.2726 25.804 11.1545 25.7526 11.049C25.7012 10.9435 25.6204 10.855 25.5199 10.7943Z"
                                                    fill="#6366F1" />
                                                <path
                                                    d="M25.8298 11.3891L25.7959 11.4606C25.7299 11.5817 25.6244 11.6765 25.4969 11.7291C25.3695 11.7818 25.2278 11.7891 25.0956 11.7499C24.9634 11.7107 24.8486 11.6273 24.7705 11.5136C24.6924 11.4 24.6556 11.263 24.6663 11.1255C24.2927 11.8071 23.879 12.466 23.4274 13.0986C22.4648 12.0492 21.327 11.1751 20.0649 10.5155C21.3941 6.41491 23.6873 2.38208 25.8373 2.60801C26.3326 3.16162 26.669 3.83885 26.8109 4.56801C26.9527 5.29717 26.8948 6.05112 26.6432 6.75003C26.4248 7.34874 24.9525 10.4138 24.7077 10.9862C24.687 11.0316 24.673 11.0798 24.6663 11.1293L24.719 11.0389C24.7852 10.9152 24.8925 10.8185 25.0223 10.7654C25.1522 10.7124 25.2965 10.7063 25.4304 10.7482C25.5642 10.7902 25.6793 10.8775 25.7556 10.9952C25.832 11.1129 25.8649 11.2535 25.8486 11.3929C26.1687 10.6624 27.5582 7.76295 27.7766 7.16047C28.0164 6.5023 28.1242 5.80335 28.0939 5.1035C28.0636 4.40366 27.8958 3.71664 27.6 3.08166C27.3042 2.44668 26.8862 1.87619 26.3699 1.40275C25.8536 0.929307 25.2491 0.562193 24.591 0.322365C23.9328 0.082538 23.2338 -0.0253056 22.534 0.00499182C21.8342 0.0352892 21.1471 0.203134 20.5122 0.498944C19.2298 1.09636 18.2372 2.17873 17.7529 3.50796C17.0671 5.36009 16.5627 7.27439 16.2467 9.22395C14.791 8.97761 13.3043 8.97761 11.8486 9.22395C11.5321 7.27449 11.0277 5.36023 10.3424 3.50796C10.1026 2.85004 9.73552 2.2458 9.26217 1.72974C8.78883 1.21368 8.21847 0.79591 7.58367 0.500275C6.94887 0.20464 6.26205 0.0369339 5.56244 0.00673114C4.86282 -0.0234716 4.16411 0.0844206 3.50619 0.324248C2.84827 0.564075 2.24403 0.931141 1.72797 1.40449C1.21191 1.87783 0.794141 2.44819 0.498506 3.08299C0.202871 3.71779 0.0351651 4.40461 0.00496233 5.10422C-0.0252404 5.80384 0.0826517 6.50255 0.322479 7.16047C1.17949 9.61296 2.37736 11.9326 3.88085 14.0513C1.38434 17.4402 1.18854 21.6538 2.46127 24.4365C2.63133 24.8036 2.82896 25.1573 3.05245 25.4946C4.87871 28.1906 8.49733 29.6366 13.6786 29.6366C14.9547 29.6428 16.2292 29.5445 17.4893 29.3429C17.8916 29.3077 18.2891 29.2307 18.6754 29.1132C23.2166 28.0551 26.3833 25.3477 26.3833 20.6409C26.3839 18.2665 25.6179 15.9553 24.1994 14.0513C24.7739 13.2718 25.2948 12.454 25.7583 11.6037C25.7948 11.5371 25.8191 11.4644 25.8298 11.3891ZM18.8863 3.92969C19.0828 3.39462 19.3885 2.90626 19.7838 2.49562C20.1792 2.08498 20.6556 1.76103 21.1828 1.54433C21.7101 1.32763 22.2766 1.22292 22.8465 1.23684C23.4163 1.25077 23.9771 1.38303 24.4931 1.62522C22.1509 2.57035 20.1816 6.24922 18.9428 10.0185C18.4519 9.81636 17.9489 9.64532 17.4366 9.50636C17.7359 7.60445 18.2214 5.73657 18.8863 3.92969ZM9.19394 3.92969C9.86273 5.72996 10.3533 7.59149 10.6587 9.48753C10.146 9.6268 9.64292 9.79911 9.15252 10.0034C8.22621 7.23201 6.29076 2.70968 3.57962 1.62522C4.096 1.38177 4.65742 1.24851 5.22813 1.23393C5.79884 1.21936 6.36634 1.32379 6.89447 1.54057C7.42261 1.75735 7.89982 2.08173 8.29571 2.49306C8.69161 2.90439 8.99751 3.39365 9.19394 3.92969ZM1.47471 6.74627C1.2231 6.04735 1.16515 5.2934 1.30701 4.56424C1.44886 3.83509 1.78524 3.15785 2.28053 2.60424C4.43061 2.39338 6.72379 6.4262 8.053 10.5117C6.79088 11.1713 5.65307 12.0454 4.69043 13.0949C3.34294 11.1299 2.26163 8.99515 1.47471 6.74627ZM25.1972 20.6371C25.1972 27.671 17.1542 28.4316 13.6974 28.4316C4.7921 28.4316 2.92066 24.1917 2.92066 20.6371C2.92066 14.9098 7.91744 10.2519 14.0589 10.2519C20.2004 10.2519 25.1972 14.9098 25.1972 20.6371Z"
                                                    fill="#6366F1" />
                                                <path
                                                    d="M13.0681 20.4518L13.7309 20.7492C13.828 20.7929 13.9332 20.8154 14.0396 20.8154C14.1461 20.8154 14.2513 20.7929 14.3484 20.7492L15.03 20.4518C15.0856 20.4271 15.1352 20.3904 15.1751 20.3444C15.215 20.2984 15.2442 20.2442 15.2608 20.1856C15.2773 20.127 15.2807 20.0654 15.2708 20.0054C15.2608 19.9453 15.2377 19.8881 15.2032 19.838C15.0966 19.6774 14.9342 19.5621 14.7476 19.5142C14.2961 19.3937 13.8209 19.3937 13.3694 19.5142C13.1827 19.5621 13.0204 19.6774 12.9138 19.838C12.8786 19.8869 12.8545 19.9429 12.8433 20.0021C12.832 20.0613 12.8338 20.1223 12.8484 20.1807C12.8631 20.2392 12.8904 20.2937 12.9284 20.3405C12.9663 20.3873 13.014 20.4253 13.0681 20.4518Z"
                                                    fill="#6366F1" />
                                                <path
                                                    d="M8.06283 17.252C7.55316 17.252 7.06432 17.4542 6.70357 17.8142C6.34283 18.1742 6.13967 18.6627 6.13867 19.1723C6.13867 19.3321 6.20215 19.4854 6.31513 19.5984C6.42812 19.7113 6.58136 19.7748 6.74115 19.7748C6.90093 19.7748 7.05418 19.7113 7.16716 19.5984C7.28015 19.4854 7.34362 19.3321 7.34362 19.1723C7.35677 18.9911 7.43805 18.8215 7.57112 18.6977C7.7042 18.574 7.8792 18.5051 8.06095 18.5051C8.24269 18.5051 8.41769 18.574 8.55077 18.6977C8.68385 18.8215 8.76513 18.9911 8.77827 19.1723C8.77827 19.3321 8.84175 19.4854 8.95473 19.5984C9.06772 19.7113 9.22096 19.7748 9.38075 19.7748C9.54053 19.7748 9.69378 19.7113 9.80676 19.5984C9.91975 19.4854 9.98322 19.3321 9.98322 19.1723C9.98223 18.6633 9.77958 18.1754 9.41965 17.8155C9.05973 17.4556 8.57184 17.2529 8.06283 17.252Z"
                                                    fill="#6366F1" />
                                                <path
                                                    d="M14.9914 22.068C14.8727 22.2039 14.7263 22.3129 14.562 22.3876C14.3976 22.4623 14.2193 22.5009 14.0388 22.501C13.8578 22.5005 13.679 22.4617 13.5141 22.387C13.3493 22.3124 13.2021 22.2036 13.0823 22.068C13.0317 22.0041 12.9687 21.9512 12.897 21.9125C12.8254 21.8737 12.7466 21.8498 12.6655 21.8424C12.5844 21.8349 12.5026 21.844 12.4251 21.869C12.3475 21.8941 12.2759 21.9346 12.2145 21.9881C12.1531 22.0416 12.1031 22.107 12.0677 22.1804C12.0323 22.2538 12.0121 22.3335 12.0084 22.4149C12.0047 22.4963 12.0176 22.5776 12.0462 22.6539C12.0748 22.7301 12.1186 22.7998 12.1749 22.8587C12.4064 23.1259 12.6926 23.3402 13.0142 23.487C13.3358 23.6339 13.6852 23.7099 14.0388 23.7099C14.3923 23.7099 14.7417 23.6339 15.0633 23.487C15.3849 23.3402 15.6711 23.1259 15.9027 22.8587C16.0075 22.7379 16.0601 22.5803 16.0488 22.4207C16.0375 22.2611 15.9633 22.1126 15.8424 22.0077C15.7216 21.9028 15.564 21.8503 15.4044 21.8616C15.2449 21.8729 15.0963 21.9471 14.9914 22.068Z"
                                                    fill="#6366F1" />
                                            </svg>



                                            <h3 class="font-medium">Start a survey from one of our frameworks</h3>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
