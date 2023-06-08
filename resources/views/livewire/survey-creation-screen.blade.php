<div class="overflow-hidden">
    <div class="h-[calc(100vh-74px)] flex">
        <!-- Fixed sidebar -->
        <div class="w-72 flex items-center justify-center">
            <div class="flex flex-col space-y-2 w-full mr-6 ml-6">
                <button
                    wire:click.prevent="updateScreen('setup')"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-100 {{ $screen == 'setup' ? 'bg-blue-200' : '' }}">
                    <i class="fa-solid fa-screwdriver-wrench mr-3 w-5"></i>
                    <span class="font-bold">1. Setup</span>
                </button>

                <button
                    wire:click.prevent="updateScreen('rationale')"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-100 {{ $screen == 'rationale' ? 'bg-blue-200' : '' }}">
                    <i class="fa-solid fa-brain mr-3 w-5"></i>
                    <span class="font-bold">2. Rationale</span>
                </button>

                <button
                    wire:click="updateScreen('respondents')"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-100 {{ $screen == 'respondents' ? 'bg-blue-200' : '' }}">
                    <i class="fa-solid fa-users mr-3 w-5"></i>
                    <span class="font-bold">3. Respondents</span>
                </button>

                <button
                    wire:click="updateScreen('questions')"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-100 {{ $screen == 'questions' ? 'bg-blue-200' : '' }}">
                    <i class="fa-solid fa-clipboard-question mr-3 w-5"></i>
                    <span class="font-bold">4. Questions</span>
                </button>

                <button
                    wire:click="updateScreen('schedule')"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-100 {{ $screen == 'schedule' ? 'bg-blue-200' : '' }}">
                    <i class="fa-solid fa-calendar-days mr-3 w-5"></i>
                    <span class="font-bold">5. Schedule</span>
                </button>

                <button
                    wire:click="updateScreen('preview')"
                    class="flex items-center p-2 rounded-lg hover:bg-blue-100 {{ $screen == 'preview' ? 'bg-blue-200' : '' }}">
                    <i class="fa-solid fa-eye mr-3 w-5"></i>
                    <span class="font-bold">6. Preview</span>
                </button>
            </div>
        </div>

        <div class="flex-1 flex overflow-hidden">
            <div class="flex-1 overflow-y-auto mt-5">
                @switch($screen)
                    @case('setup')
                        <livewire:survey.setup />
                    @break

                    @case('rationale')
                        <livewire:survey.rationale />
                    @break

                    @case('respondents')
                        <livewire:survey.respondents />
                    @break

                    @case('questions')
                        <livewire:survey-creation-preview-screen />
                    @break

                    @case('schedule')
                        <livewire:survey.schedule />
                    @break

                    @case('preview')
                        <livewire:survey-creation-preview-screen />
                    @break

                    @default
                        Default case...
                @endswitch
            </div>
        </div>

        <!-- Fixed sidebar -->
        <div class="w-72 flex items-center justify-center">
            <div class="flex flex-col space-y-2 w-full mr-6 ml-6">
                @switch($screen)
                    @case('setup')
                    @break

                    @case('rationale')
                    @break

                    @case('respondents')
                    @break

                    @case('questions')
                        <div class="relative">
                            <div class="w-full bg-indigo-200 p-5 rounded-lg">
                                <h1 class="font-bold">Impak AI, Survey Helper</h1>
                                <p>We recommend to have no more than <b>10 questions</b> mixed between opened and closed
                                    questions to allow participants to better reflect on what they achieved.</p>
                            </div>
                            <img src="https://png.pngtree.com/png-vector/20220611/ourlarge/pngtree-chatbot-icon-chat-bot-robot-png-image_4841963.png"
                                alt="Profile Photo"
                                class="absolute top-0 right-0 rounded-lg w-14 h-14 border-4 bg-white border-white -mt-10 -mr-2">
                        </div>
                    @break

                    @case('schedule')
                    @break

                    @case('preview')
                    @break

                    @default
                        Default case...
                @endswitch

            </div>
        </div>
    </div>
</div>
