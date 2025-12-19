{{-- Chatbot Component - Fiscal Wallet - Integração com IA --}}
<div
    x-data="chatbot"
    x-init="init()"
    class="fixed bottom-6 right-6 z-50"
>
    {{-- Chat Button --}}
    <button
        x-show="!isOpen"
        x-cloak
        @click="isOpen = true"
        class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-700 text-white rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center group"
    >
        <x-icons.message-circle class="w-6 h-6" />
        {{-- Notification badge --}}
        <span
            x-show="unreadUpdates > 0"
            x-text="unreadUpdates"
            class="absolute -top-1 -right-1 w-5 h-5 bg-danger-500 text-white text-xs font-bold rounded-full flex items-center justify-center"
        ></span>
    </button>

    {{-- Chat Window --}}
    <div
        x-show="isOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="absolute bottom-0 right-0 w-[380px] bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col"
        :class="isMinimized ? 'h-[60px]' : 'h-[520px]'"
    >
        {{-- Header --}}
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-4 py-3 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold text-sm">Assistente Fiscal IA</h3>
                    <p class="text-white/70 text-xs flex items-center gap-1">
                        <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                        Powered by Claude
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-1">
                <button
                    @click="isMinimized = !isMinimized"
                    class="p-1.5 rounded-lg hover:bg-white/10 transition-colors"
                >
                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                    </svg>
                </button>
                <button
                    @click="isOpen = false"
                    class="p-1.5 rounded-lg hover:bg-white/10 transition-colors"
                >
                    <x-icons.x class="w-4 h-4 text-white" />
                </button>
            </div>
        </div>

        {{-- Messages Area --}}
        <div
            x-show="!isMinimized"
            x-ref="messagesContainer"
            class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50"
        >
            <template x-for="msg in messages" :key="msg.id">
                <div :class="msg.type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.type === 'user' ? 'max-w-[80%]' : 'max-w-[85%]'">
                        {{-- Bot message --}}
                        <div x-show="msg.type === 'bot'" class="flex items-start gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="bg-white rounded-2xl rounded-tl-none px-4 py-3 shadow-sm">
                                    <p class="text-sm text-gray-700 whitespace-pre-wrap" x-html="formatMessage(msg.text)"></p>
                                </div>
                                <p class="text-xs text-gray-400 mt-1 ml-1" x-text="msg.time"></p>
                            </div>
                        </div>

                        {{-- User message --}}
                        <div x-show="msg.type === 'user'" class="flex flex-col items-end">
                            <div class="bg-gradient-to-r from-primary-600 to-primary-500 text-white rounded-2xl rounded-tr-none px-4 py-3">
                                <p class="text-sm" x-text="msg.text"></p>
                            </div>
                            <p class="text-xs text-gray-400 mt-1 mr-1" x-text="msg.time"></p>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Typing indicator --}}
            <div x-show="isTyping" class="flex justify-start">
                <div class="flex items-start gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="bg-white rounded-2xl rounded-tl-none px-4 py-3 shadow-sm">
                        <div class="flex gap-1 items-center">
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms;"></span>
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms;"></span>
                            <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms;"></span>
                            <span class="ml-2 text-xs text-gray-400">Analisando...</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Error message --}}
            <div x-show="error" x-cloak class="text-center">
                <p class="text-xs text-red-500" x-text="error"></p>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div x-show="!isMinimized && messages.length <= 2 && quickActions.length > 0" x-cloak class="px-4 py-2 bg-white border-t border-gray-100">
            <p class="text-xs text-gray-500 mb-2">Sugestões para você:</p>
            <div class="flex flex-wrap gap-2">
                <template x-for="action in quickActions" :key="action">
                    <button
                        @click="sendQuickAction(action)"
                        class="px-3 py-1.5 bg-gray-100 hover:bg-primary-50 hover:text-primary-700 text-gray-700 text-xs rounded-full transition-colors"
                        x-text="action"
                    ></button>
                </template>
            </div>
        </div>

        {{-- Input Area --}}
        <div x-show="!isMinimized" class="p-4 bg-white border-t border-gray-100 flex-shrink-0">
            <form @submit.prevent="sendMessage" class="flex items-center gap-2">
                <input
                    type="text"
                    x-model="message"
                    :disabled="isTyping"
                    placeholder="Digite sua dúvida fiscal..."
                    class="flex-1 px-4 py-2.5 bg-gray-100 border-0 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:bg-white transition-all disabled:opacity-50"
                />
                <button
                    type="submit"
                    :disabled="!message.trim() || isTyping"
                    class="w-10 h-10 bg-gradient-to-r from-primary-600 to-primary-500 text-white rounded-xl flex items-center justify-center hover:from-primary-700 hover:to-primary-600 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
                >
                    <x-icons.send class="w-4 h-4" />
                </button>
            </form>

            {{-- Footer --}}
            <div class="mt-2 text-center">
                <p class="text-[10px] text-gray-400">
                    IA especializada em tributação de criptomoedas no Brasil
                </p>
            </div>
        </div>
    </div>
</div>
