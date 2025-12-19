// Chatbot Alpine.js Component
document.addEventListener('alpine:init', () => {
    Alpine.data('chatbot', () => ({
        isOpen: false,
        isMinimized: false,
        message: '',
        isTyping: false,
        sessionId: null,
        unreadUpdates: 0,
        error: null,
        messages: [
            {
                id: 1,
                type: 'bot',
                text: 'Olá! Sou o assistente fiscal da Fiscal Wallet, powered by IA. Posso ajudar com dúvidas sobre tributação de criptomoedas, IN 1888, GCAP, IRPF e muito mais. Como posso ajudar você hoje?',
                time: new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' })
            }
        ],
        quickActions: [],

        async init() {
            await this.loadQuickActions();
            await this.checkLawUpdates();
        },

        async loadQuickActions() {
            try {
                const response = await fetch('/api/chat/quick-actions', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    credentials: 'same-origin'
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.success && data.data) {
                        this.quickActions = data.data.map(a => a.label);
                    }
                }
            } catch (e) {
                this.quickActions = [
                    'Resumo do mês',
                    'Limite de isenção cripto',
                    'O que é IN1888?',
                    'Como pagar DARF?'
                ];
            }
        },

        async checkLawUpdates() {
            try {
                const response = await fetch('/api/chat/law-updates?days=7', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    credentials: 'same-origin'
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.success && data.data) {
                        this.unreadUpdates = data.data.unread_count || 0;
                    }
                }
            } catch (e) {
                console.error('Erro ao verificar atualizações:', e);
            }
        },

        async sendMessage() {
            if (!this.message.trim() || this.isTyping) return;

            const userMessage = this.message.trim();
            this.message = '';
            this.error = null;

            this.messages.push({
                id: this.messages.length + 1,
                type: 'user',
                text: userMessage,
                time: new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' })
            });

            this.$nextTick(() => {
                if (this.$refs.messagesContainer) {
                    this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight;
                }
            });

            this.isTyping = true;

            try {
                // Timeout de 3 minutos para requisições à IA
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 180000);

                const response = await fetch('/api/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    },
                    credentials: 'same-origin',
                    signal: controller.signal,
                    body: JSON.stringify({
                        message: userMessage,
                        session_id: this.sessionId
                    })
                });

                clearTimeout(timeoutId);
                const data = await response.json();

                this.isTyping = false;

                if (data.success) {
                    if (data.data.session_id) {
                        this.sessionId = data.data.session_id;
                    }

                    this.messages.push({
                        id: this.messages.length + 1,
                        type: 'bot',
                        text: data.data.message,
                        time: new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' }),
                        messageId: data.data.message_id
                    });
                } else {
                    this.error = data.error || 'Erro ao processar mensagem';
                    this.messages.push({
                        id: this.messages.length + 1,
                        type: 'bot',
                        text: '⚠️ Desculpe, tive um problema ao processar sua pergunta. Tente novamente em alguns instantes.',
                        time: new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' })
                    });
                }
            } catch (e) {
                this.isTyping = false;
                console.error('Erro na requisição:', e);

                this.messages.push({
                    id: this.messages.length + 1,
                    type: 'bot',
                    text: this.getOfflineResponse(userMessage),
                    time: new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' })
                });
            }

            this.$nextTick(() => {
                if (this.$refs.messagesContainer) {
                    this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight;
                }
            });
        },

        sendQuickAction(action) {
            const actionMessages = {
                'Resumo do mês': 'Me dê um resumo da minha situação fiscal este mês',
                'Limite de isenção cripto': 'Qual é o limite de isenção para criptomoedas?',
                'O que é IN1888?': 'O que é a IN 1888 e quando preciso declarar?',
                'Como pagar DARF?': 'Como faço para pagar um DARF de criptomoedas?'
            };

            this.message = actionMessages[action] || action;
            this.sendMessage();
        },

        getOfflineResponse(message) {
            const lowerMessage = message.toLowerCase();

            if (lowerMessage.includes('darf')) {
                return 'O DARF (código 4600) deve ser pago até o último dia útil do mês seguinte à venda com lucro. Para gerar, acesse o Sicalc da Receita Federal. Assim que a conexão for restabelecida, posso dar mais detalhes sobre sua situação específica.';
            }

            if (lowerMessage.includes('in1888') || lowerMessage.includes('1888')) {
                return 'A IN 1888 obriga declaração mensal de operações com criptoativos quando: (1) valor mensal > R$ 30.000 em exchanges brasileiras, ou (2) qualquer valor em exchanges estrangeiras (Binance, Coinbase, etc). Prazo: último dia útil do mês seguinte.';
            }

            if (lowerMessage.includes('isencao') || lowerMessage.includes('isenção') || lowerMessage.includes('35')) {
                return 'Vendas de criptoativos até R$ 35.000/mês são ISENTAS de imposto. Atenção: o limite considera o valor total vendido, não o lucro. Se ultrapassar R$ 35k, todo o lucro é tributável.';
            }

            if (lowerMessage.includes('gcap')) {
                return 'O GCAP é o programa para calcular ganho de capital. Alíquotas: 15% (até R$ 5M), 17,5% (R$ 5-10M), 20% (R$ 10-30M), 22,5% (acima). O imposto deve ser pago via DARF até o último dia útil do mês seguinte.';
            }

            return 'Estou com dificuldades de conexão no momento. Assim que a conexão for restabelecida, poderei acessar seus dados e fornecer uma resposta personalizada. Enquanto isso, posso responder perguntas gerais sobre tributação de cripto.';
        },

        formatMessage(text) {
            return text
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\n/g, '<br>');
        }
    }));
});
