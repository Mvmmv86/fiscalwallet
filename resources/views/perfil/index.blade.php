<x-layouts.dashboard title="Meu Perfil">
    <div x-data="{
        activeTab: 'dados',
        user: {
            nome: 'Alonso Rodrigues',
            email: 'alonso.rodrigues@email.com',
            telefone: '(11) 99999-9999',
            cpf: '123.456.789-00',
            dataNascimento: '1990-05-15',
            endereco: {
                cep: '01310-100',
                logradouro: 'Av. Paulista',
                numero: '1000',
                complemento: 'Sala 123',
                bairro: 'Bela Vista',
                cidade: 'São Paulo',
                estado: 'SP'
            }
        },
        security: {
            senhaAtual: '',
            novaSenha: '',
            confirmarSenha: '',
            twoFactorEnabled: false
        },
        notifications: {
            emailPendencias: true,
            emailDeclaracoes: true,
            emailOperacoes: false,
            emailMarketing: false,
            pushPendencias: true,
            pushDeclaracoes: true,
            pushOperacoes: true,
            pushMarketing: false
        },
        sessions: [
            { device: 'Chrome - Windows', location: 'São Paulo, BR', current: true, lastActive: 'Agora' },
            { device: 'Safari - iPhone', location: 'São Paulo, BR', current: false, lastActive: 'Há 2 dias' }
        ],
        showSaveSuccess: false,
        showPasswordSuccess: false,
        saving: false,
        savingPassword: false,
        showDeleteModal: false,
        saveProfile() {
            this.saving = true;
            setTimeout(() => {
                this.saving = false;
                this.showSaveSuccess = true;
                setTimeout(() => this.showSaveSuccess = false, 3000);
            }, 1000);
        },
        savePassword() {
            this.savingPassword = true;
            setTimeout(() => {
                this.savingPassword = false;
                this.showPasswordSuccess = true;
                this.security.senhaAtual = '';
                this.security.novaSenha = '';
                this.security.confirmarSenha = '';
                setTimeout(() => this.showPasswordSuccess = false, 3000);
            }, 1000);
        },
        saveNotifications() {
            this.saving = true;
            setTimeout(() => {
                this.saving = false;
                this.showSaveSuccess = true;
                setTimeout(() => this.showSaveSuccess = false, 3000);
            }, 1000);
        }
    }">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition-colors">
                    <x-icons.arrow-left class="w-4 h-4 text-gray-600" />
                </a>
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">Meu Perfil</h1>
                    <p class="text-sm text-gray-500">Gerencie suas informações pessoais e preferências</p>
                </div>
            </div>
        </div>

        <!-- Conteúdo Principal -->
        <div class="bg-white rounded-xl border border-gray-100">
            <!-- Tabs de Navegação -->
            <div class="border-b border-gray-100">
                <nav class="flex gap-0 px-4">
                    <button
                        @click="activeTab = 'dados'"
                        :class="activeTab === 'dados' ? 'border-b-2 border-primary-600 text-primary-600' : 'text-gray-500 hover:text-gray-700'"
                        class="px-4 py-3 text-sm font-medium transition-colors"
                    >
                        Dados Pessoais
                    </button>
                    <button
                        @click="activeTab = 'seguranca'"
                        :class="activeTab === 'seguranca' ? 'border-b-2 border-primary-600 text-primary-600' : 'text-gray-500 hover:text-gray-700'"
                        class="px-4 py-3 text-sm font-medium transition-colors"
                    >
                        Segurança
                    </button>
                    <button
                        @click="activeTab = 'notificacoes'"
                        :class="activeTab === 'notificacoes' ? 'border-b-2 border-primary-600 text-primary-600' : 'text-gray-500 hover:text-gray-700'"
                        class="px-4 py-3 text-sm font-medium transition-colors"
                    >
                        Notificações
                    </button>
                </nav>
            </div>

            <!-- ========================================== -->
            <!-- TAB: DADOS PESSOAIS -->
            <!-- ========================================== -->
            <div x-show="activeTab === 'dados'" x-cloak class="p-6">
                <!-- Alerta de Sucesso -->
                <div
                    x-show="showSaveSuccess"
                    x-transition
                    class="mb-6 p-4 bg-success-50 border border-success-200 rounded-xl flex items-center gap-3"
                >
                    <div class="w-8 h-8 bg-success-100 rounded-full flex items-center justify-center">
                        <x-icons.check class="w-4 h-4 text-success-600" />
                    </div>
                    <p class="text-sm text-success-700 font-medium">Perfil atualizado com sucesso!</p>
                </div>

                <!-- Foto de Perfil -->
                <div class="flex items-center gap-6 mb-8 pb-8 border-b border-gray-100">
                    <div class="relative">
                        <img
                            src="https://ui-avatars.com/api/?name=Alonso+Rodrigues&background=9333EA&color=fff&size=96"
                            alt="Avatar"
                            class="w-24 h-24 rounded-full"
                        />
                        <button class="absolute bottom-0 right-0 w-8 h-8 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-sm hover:bg-gray-50 transition-colors">
                            <x-icons.camera class="w-4 h-4 text-gray-600" />
                        </button>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900" x-text="user.nome"></h3>
                        <p class="text-sm text-gray-500" x-text="user.email"></p>
                        <a href="{{ route('perfil.planos') }}" class="text-xs text-primary-600 hover:text-primary-700 mt-1 inline-block">
                            Plano Pro • Ver detalhes →
                        </a>
                    </div>
                </div>

                <!-- Formulário de Dados -->
                <form @submit.prevent="saveProfile">
                    <!-- Dados Básicos -->
                    <div class="mb-8">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4">Informações Básicas</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Nome completo</label>
                                <input
                                    type="text"
                                    x-model="user.nome"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">E-mail</label>
                                <input
                                    type="email"
                                    x-model="user.email"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Telefone</label>
                                <input
                                    type="tel"
                                    x-model="user.telefone"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">CPF</label>
                                <input
                                    type="text"
                                    x-model="user.cpf"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Data de nascimento</label>
                                <input
                                    type="date"
                                    x-model="user.dataNascimento"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Endereço -->
                    <div class="mb-8">
                        <h4 class="text-sm font-semibold text-gray-900 mb-4">Endereço</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">CEP</label>
                                <input
                                    type="text"
                                    x-model="user.endereco.cep"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Logradouro</label>
                                <input
                                    type="text"
                                    x-model="user.endereco.logradouro"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Número</label>
                                <input
                                    type="text"
                                    x-model="user.endereco.numero"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Complemento</label>
                                <input
                                    type="text"
                                    x-model="user.endereco.complemento"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Bairro</label>
                                <input
                                    type="text"
                                    x-model="user.endereco.bairro"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Cidade</label>
                                <input
                                    type="text"
                                    x-model="user.endereco.cidade"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Estado</label>
                                <select
                                    x-model="user.endereco.estado"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                >
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Botões -->
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                        <button
                            type="button"
                            class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Cancelar
                        </button>
                        <button
                            type="submit"
                            :disabled="saving"
                            class="px-6 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-lg hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm disabled:opacity-50"
                        >
                            <span x-show="!saving">Salvar alterações</span>
                            <span x-show="saving" class="flex items-center gap-2">
                                <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Salvando...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- ========================================== -->
            <!-- TAB: SEGURANÇA -->
            <!-- ========================================== -->
            <div x-show="activeTab === 'seguranca'" x-cloak class="p-6">
                <!-- Alerta de Sucesso Senha -->
                <div
                    x-show="showPasswordSuccess"
                    x-transition
                    class="mb-6 p-4 bg-success-50 border border-success-200 rounded-xl flex items-center gap-3"
                >
                    <div class="w-8 h-8 bg-success-100 rounded-full flex items-center justify-center">
                        <x-icons.check class="w-4 h-4 text-success-600" />
                    </div>
                    <p class="text-sm text-success-700 font-medium">Senha alterada com sucesso!</p>
                </div>

                <!-- Alterar Senha -->
                <div class="mb-8 pb-8 border-b border-gray-100">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <x-icons.key class="w-5 h-5 text-gray-600" />
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">Alterar senha</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Atualize sua senha regularmente para manter sua conta segura</p>
                        </div>
                    </div>

                    <form @submit.prevent="savePassword" class="max-w-md">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Senha atual</label>
                                <input
                                    type="password"
                                    x-model="security.senhaAtual"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="••••••••"
                                />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Nova senha</label>
                                <input
                                    type="password"
                                    x-model="security.novaSenha"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="••••••••"
                                />
                                <p class="text-xs text-gray-400 mt-1">Mínimo 8 caracteres, incluindo letras e números</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1.5">Confirmar nova senha</label>
                                <input
                                    type="password"
                                    x-model="security.confirmarSenha"
                                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    placeholder="••••••••"
                                />
                            </div>
                        </div>
                        <button
                            type="submit"
                            :disabled="savingPassword || !security.senhaAtual || !security.novaSenha || !security.confirmarSenha"
                            class="mt-4 px-6 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-lg hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm disabled:opacity-50"
                        >
                            <span x-show="!savingPassword">Alterar senha</span>
                            <span x-show="savingPassword">Alterando...</span>
                        </button>
                    </form>
                </div>

                <!-- Autenticação 2FA -->
                <div class="mb-8 pb-8 border-b border-gray-100">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                <x-icons.shield class="w-5 h-5 text-gray-600" />
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900">Autenticação de dois fatores (2FA)</h4>
                                <p class="text-xs text-gray-500 mt-0.5">Adicione uma camada extra de segurança à sua conta</p>
                            </div>
                        </div>
                        <button
                            @click="security.twoFactorEnabled = !security.twoFactorEnabled"
                            :class="security.twoFactorEnabled ? 'bg-primary-600' : 'bg-gray-300'"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full transition-colors duration-200 ease-in-out"
                        >
                            <span
                                :class="security.twoFactorEnabled ? 'translate-x-5' : 'translate-x-0'"
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out mt-0.5 ml-0.5"
                            ></span>
                        </button>
                    </div>
                    <div x-show="security.twoFactorEnabled" x-transition class="mt-4 ml-14 p-4 bg-success-50 border border-success-200 rounded-lg">
                        <p class="text-sm text-success-700">2FA está ativo. Sua conta está mais protegida.</p>
                    </div>
                    <div x-show="!security.twoFactorEnabled" x-transition class="mt-4 ml-14 p-4 bg-warning-50 border border-warning-200 rounded-lg">
                        <p class="text-sm text-warning-700">Recomendamos ativar o 2FA para maior segurança.</p>
                    </div>
                </div>

                <!-- Sessões Ativas -->
                <div class="mb-8 pb-8 border-b border-gray-100">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <x-icons.monitor class="w-5 h-5 text-gray-600" />
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">Sessões ativas</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Dispositivos onde sua conta está conectada</p>
                        </div>
                    </div>

                    <div class="space-y-3 ml-14">
                        <template x-for="session in sessions" :key="session.device">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center border border-gray-200">
                                        <x-icons.monitor class="w-4 h-4 text-gray-500" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900" x-text="session.device"></p>
                                        <p class="text-xs text-gray-500">
                                            <span x-text="session.location"></span> •
                                            <span x-text="session.lastActive"></span>
                                            <span x-show="session.current" class="text-success-600 font-medium">(Esta sessão)</span>
                                        </p>
                                    </div>
                                </div>
                                <button
                                    x-show="!session.current"
                                    class="text-xs text-danger-600 hover:text-danger-700 font-medium"
                                >
                                    Encerrar
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Excluir Conta -->
                <div>
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-10 h-10 bg-danger-100 rounded-lg flex items-center justify-center">
                            <x-icons.alert-triangle class="w-5 h-5 text-danger-600" />
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">Excluir conta</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Exclua permanentemente sua conta e todos os dados</p>
                        </div>
                    </div>
                    <div class="ml-14">
                        <button
                            @click="showDeleteModal = true"
                            class="px-4 py-2 text-sm font-medium text-danger-600 border border-danger-300 rounded-lg hover:bg-danger-50 transition-colors"
                        >
                            Excluir minha conta
                        </button>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB: NOTIFICAÇÕES -->
            <!-- ========================================== -->
            <div x-show="activeTab === 'notificacoes'" x-cloak class="p-6">
                <!-- Alerta de Sucesso -->
                <div
                    x-show="showSaveSuccess"
                    x-transition
                    class="mb-6 p-4 bg-success-50 border border-success-200 rounded-xl flex items-center gap-3"
                >
                    <div class="w-8 h-8 bg-success-100 rounded-full flex items-center justify-center">
                        <x-icons.check class="w-4 h-4 text-success-600" />
                    </div>
                    <p class="text-sm text-success-700 font-medium">Preferências salvas com sucesso!</p>
                </div>

                <!-- Notificações por E-mail -->
                <div class="mb-8 pb-8 border-b border-gray-100">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <x-icons.mail class="w-5 h-5 text-gray-600" />
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">Notificações por e-mail</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Escolha quais e-mails você deseja receber</p>
                        </div>
                    </div>

                    <div class="space-y-4 ml-14">
                        <label class="flex items-center justify-between cursor-pointer">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Pendências fiscais</p>
                                <p class="text-xs text-gray-500">Alertas sobre DARF, IN1888, GCAP vencidos ou próximos do vencimento</p>
                            </div>
                            <input type="checkbox" x-model="notifications.emailPendencias" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" />
                        </label>

                        <label class="flex items-center justify-between cursor-pointer">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Declarações</p>
                                <p class="text-xs text-gray-500">Lembretes sobre prazos de declaração mensal e anual</p>
                            </div>
                            <input type="checkbox" x-model="notifications.emailDeclaracoes" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" />
                        </label>

                        <label class="flex items-center justify-between cursor-pointer">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Novas operações</p>
                                <p class="text-xs text-gray-500">Resumo diário/semanal das operações sincronizadas</p>
                            </div>
                            <input type="checkbox" x-model="notifications.emailOperacoes" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" />
                        </label>

                        <label class="flex items-center justify-between cursor-pointer">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Novidades e promoções</p>
                                <p class="text-xs text-gray-500">Informações sobre novos recursos e ofertas especiais</p>
                            </div>
                            <input type="checkbox" x-model="notifications.emailMarketing" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" />
                        </label>
                    </div>
                </div>

                <!-- Notificações Push -->
                <div class="mb-8">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <x-icons.bell class="w-5 h-5 text-gray-600" />
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900">Notificações no navegador</h4>
                            <p class="text-xs text-gray-500 mt-0.5">Receba alertas em tempo real no seu navegador</p>
                        </div>
                    </div>

                    <div class="space-y-4 ml-14">
                        <label class="flex items-center justify-between cursor-pointer">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Pendências fiscais</p>
                                <p class="text-xs text-gray-500">Alertas urgentes sobre obrigações fiscais</p>
                            </div>
                            <input type="checkbox" x-model="notifications.pushPendencias" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" />
                        </label>

                        <label class="flex items-center justify-between cursor-pointer">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Declarações</p>
                                <p class="text-xs text-gray-500">Lembretes de prazos importantes</p>
                            </div>
                            <input type="checkbox" x-model="notifications.pushDeclaracoes" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" />
                        </label>

                        <label class="flex items-center justify-between cursor-pointer">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Sincronização concluída</p>
                                <p class="text-xs text-gray-500">Aviso quando a sincronização de operações terminar</p>
                            </div>
                            <input type="checkbox" x-model="notifications.pushOperacoes" class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500" />
                        </label>
                    </div>
                </div>

                <!-- Botão Salvar -->
                <div class="flex items-center justify-end pt-6 border-t border-gray-100">
                    <button
                        @click="saveNotifications"
                        :disabled="saving"
                        class="px-6 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-600 to-primary-500 rounded-lg hover:from-primary-700 hover:to-primary-600 transition-all shadow-sm disabled:opacity-50"
                    >
                        <span x-show="!saving">Salvar preferências</span>
                        <span x-show="saving">Salvando...</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal de Excluir Conta -->
        <div
            x-show="showDeleteModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
            @click.self="showDeleteModal = false"
            style="display: none;"
        >
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md">
                <div class="p-6">
                    <div class="w-12 h-12 bg-danger-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <x-icons.alert-triangle class="w-6 h-6 text-danger-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Excluir conta</h3>
                    <p class="text-sm text-gray-500 text-center mb-6">
                        Tem certeza que deseja excluir sua conta? Esta ação é irreversível e todos os seus dados serão permanentemente apagados.
                    </p>
                    <div class="flex gap-3">
                        <button
                            @click="showDeleteModal = false"
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                        >
                            Cancelar
                        </button>
                        <button
                            class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-danger-600 rounded-lg hover:bg-danger-700 transition-colors"
                        >
                            Sim, excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
