<x-layout style="auth" script="auth" title="Auth">

    <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen flex items-center justify-center p-4">
     <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-8 right-8 w-80 hidden z-50">
        <div class="relative rounded-xl shadow-2xl overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
            
            <div id="toast-content" class="p-5 flex items-start backdrop-blur-md bg-white/10">
                <div id="toast-icon" class="toast-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path id="check-icon" d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        <path id="error-icon" class="hidden" d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                </div>
                
                <div class="flex-1">
                    <h3 id="toast-title" class="font-bold text-lg text-white"></h3>
                    <p id="toast-message" class="text-sm text-white opacity-90"></p>
                </div>
                
                <button onclick="hideToast()" class="ml-4 text-white/70 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            </div>
            
            <div class="progress-bar"></div>
        </div>
    </div>

        <!-- Main Container -->
        <div class="max-w-lg w-full">
            <!-- Tab Selector -->
            <div class="flex justify-center mb-8">
                <div class="flex space-x-1 p-1 bg-indigo-100 rounded-full">
                    <button id="login-tab" class="px-6 py-2 rounded-full font-medium text-indigo-700 bg-white shadow-sm transition-all duration-300">
                        <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                    </button>
                    <button id="register-tab" class="px-6 py-2 rounded-full font-medium text-indigo-500 hover:bg-indigo-50 transition-all duration-300">
                        <i class="fas fa-user-plus mr-2"></i>Inscription
                    </button>
                </div>
            </div>

            <!-- 3D Card Container -->
            <div class="card-container">
                <div id="card" class="flip-card">
                    <!-- Login Form (Front Face) -->
                    <div class="login-card bg-white rounded-2xl shadow-xl p-8 absolute w-full animate__animated animate__fadeIn">
                        <div class="text-center mb-8">
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">Content de vous revoir !</h1>
                            <p class="text-gray-600">Connectez-vous pour accéder à votre compte</p>
                        </div>

                        <form id="loginForm" class="space-y-6">
                            <div class="input-container">
                                <label for="login-email" class="floating-label">Email</label>
                                <input type="email" id="login-email" name="email" placeholder=" " class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-200">
                            </div>

                            <div class="input-container">
                                <label for="login-password" class="floating-label">Mot de passe</label>
                                <input type="password" id="login-password" name="password" placeholder=" " class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-200">
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                        Se souvenir de moi
                                    </label>
                                </div>
                                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Mot de passe oublié ?</a>
                            </div>

                            <button type="submit" class="gradient-button w-full">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                <span>Se connecter</span>
                            </button>




                        </form>
                    </div>
                    <script>
                          document.getElementById('loginForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Empêche la soumission normale du formulaire

        const form = this;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        fetch("{{ route('login') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(result => {
            // Afficher le toast de succès
            showToast("Connexion réussie. Redirection...", 'success');

            // Rediriger après un court délai
            setTimeout(() => {
                window.location.href = result.redirect;
            }, 1500);
        })
        .catch(error => {
            // Afficher l'erreur dans le toast
            const errorMessage = error.error ? error.error[0] : 'Une erreur est survenue.';
            showToast(errorMessage, 'error');
        });
    });

                    </script>
                    <!-- Register Form (Back Face) -->
                    <div class="register-card bg-white rounded-2xl shadow-xl p-8 absolute w-full">
                        <div class="relative h-2 bg-gray-200 rounded-full mb-6">
                            <div id="progress-bar" class="h-full bg-gradient-to-r from-indigo-500 to-purple-600 transition-all duration-500 ease-in-out rounded-full" style="width: 0%"></div>
                        </div>

                        <div class="text-center mb-6">
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">Bienvenue parmi nous !</h1>
                            <p class="text-gray-600">Remplissez les informations pour créer votre compte</p>
                        </div>

                        <!-- Progress Dots -->
                        <div class="flex justify-center space-x-4 mb-8">
                            <div id="step1-dot" class="progress-dot bg-indigo-300"></div>
                            <div id="step2-dot" class="progress-dot bg-gray-200"></div>
                            <div id="step3-dot" class="progress-dot bg-gray-200"></div>
                            <div id="step4-dot" class="progress-dot bg-gray-200"></div>
                        </div>

                        <!-- Form Steps -->
                        <form id="registerForm" class="space-y-6">
                            <!-- Step 1: Email -->
                            <div id="step-1" class="fadeIn">
                                <div class="input-container">
                                    <label for="email" class="floating-label">Email</label>
                                    <input type="email" id="email" name="email" placeholder=" " class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-200" autofocus>
                                </div>
                                <button type="button" class="gradient-button w-full mt-6" onclick="validateAndProceed(1)">
                                    <span>Continuer</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </div>

                            <!-- Step 2: Name -->
                            <div id="step-2" class="hidden fadeIn">
                                <div class="input-container">
                                    <label for="name" class="floating-label">Nom complet</label>
                                    <input type="text" id="name" name="name" placeholder=" " class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-200">
                                </div>
                                <div class="flex space-x-4 mt-6">
                                    <button type="button" class="back-button" onclick="goToStep(1)">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        <span>Retour</span>
                                    </button>
                                    <button type="button" class="gradient-button" onclick="validateAndProceed(2)">
                                        <span>Continuer</span>
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 3: Password -->
                            <div id="step-3" class="hidden fadeIn">
                                <div class="input-container">
                                    <label for="password" class="floating-label">Mot de passe</label>
                                    <input type="password" id="password" name="password" placeholder=" " class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-200">
                                    <div class="text-xs text-gray-500 mt-2">Minimum 8 caractères avec des chiffres et lettres</div>
                                </div>
                                <div class="input-container mt-4">
                                    <label for="confirm_password" class="floating-label">Confirmer mot de passe</label>
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder=" " class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 transition duration-200">
                                </div>
                                <div class="flex space-x-4 mt-6">
                                    <button type="button" class="back-button" onclick="goToStep(2)">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        <span>Retour</span>
                                    </button>
                                    <button type="button" class="gradient-button" onclick="validateAndProceed(3)">
                                        <span>Continuer</span>
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Step 4: Confirmation -->
                            <div id="step-4" class="hidden fadeIn">
                                <div class="bg-indigo-50 rounded-xl p-6 mb-6 animate__animated animate__fadeIn">
                                    <h3 class="font-medium text-lg text-indigo-800 mb-3">Récapitulatif</h3>
                                    <div class="space-y-2">
                                        <p><span class="font-medium">Email:</span> <span id="review-email" class="text-gray-700"></span></p>
                                        <p><span class="font-medium">Nom:</span> <span id="review-name" class="text-gray-700"></span></p>
                                    </div>
                                </div>

                                <div class="flex items-center mb-6">
                                    <input type="checkbox" id="terms" name="terms" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="terms" class="ml-3 block text-sm text-gray-700">
                                        J'accepte les <a href="#" class="text-indigo-600 hover:text-indigo-500">conditions d'utilisation</a>
                                    </label>
                                </div>

                                <div class="flex space-x-4">
                                    <button type="button" class="back-button" onclick="goToStep(3)">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        <span>Retour</span>
                                    </button>
                                    <button type="submit" class="gradient-button animate-pulse">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        <span>Terminer l'inscription</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Script JS Unique -->
    <script>
        // Register Form Logic
        let currentStep = 1;
        const totalSteps = 4;

        // Initialize the first step
        document.getElementById('step-1').classList.remove('hidden');
        updateProgressDots();

        function validateAndProceed(step) {
            let isValid = true;
            let errorMessage = '';

            if (step === 1) {
                const email = document.getElementById('email').value;
                if (!email) {
                    errorMessage = "L'email est requis";
                    isValid = false;
                } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                    errorMessage = "Format d'email invalide";
                    isValid = false;
                }
            } else if (step === 2) {
                const name = document.getElementById('name').value;
                if (!name) {
                    errorMessage = "Le nom est requis";
                    isValid = false;
                } else if (name.length < 3) {
                    errorMessage = "Le nom doit avoir au moins 3 caractères";
                    isValid = false;
                }
            } else if (step === 3) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('confirm_password').value;

                if (!password) {
                    errorMessage = "Le mot de passe est requis";
                    isValid = false;
                } else if (password.length < 6) {
                    errorMessage = "Le mot de passe doit avoir au moins 6 caractères";
                    isValid = false;
                } else if (password !== confirmPassword) {
                    errorMessage = "Les mots de passe ne correspondent pas";
                    isValid = false;
                }
                // Fill recap
                document.getElementById('review-email').textContent = document.getElementById('email').value;
                document.getElementById('review-name').textContent = document.getElementById('name').value;
            }

            if (!isValid) {
                showToast(errorMessage, 'error');
                return;
            }

            if (step < 4) {
                goToStep(step + 1);
            }
        }

        function goToStep(step) {
            document.getElementById(`step-${currentStep}`).classList.add('hidden');
            currentStep = step;
            document.getElementById(`step-${currentStep}`).classList.remove('hidden');
            document.getElementById('progress-bar').style.width = `${((currentStep - 1) / (totalSteps - 1)) * 100}%`;
            updateProgressDots();
            window.scrollTo({
                top: 0
                , behavior: 'smooth'
            });
        }

        function updateProgressDots() {
            for (let i = 1; i <= totalSteps; i++) {
                const dot = document.getElementById(`step${i}-dot`);
                if (i < currentStep) {
                    dot.classList.add('bg-indigo-500');
                    dot.classList.remove('bg-gray-200', 'bg-indigo-300');
                } else if (i === currentStep) {
                    dot.classList.add('bg-indigo-300', 'active');
                    dot.classList.remove('bg-gray-200', 'bg-indigo-500');
                } else {
                    dot.classList.add('bg-gray-200');
                    dot.classList.remove('bg-indigo-300', 'bg-indigo-500', 'active');
                }
            }
        }

        // Toast Notification (avec type)
        let toastTimeout;
        
        function showToast(message, type = 'error') {
            const toast = document.getElementById('toast');
            const toastContent = document.querySelector('#toast-content');
            const toastMessage = document.getElementById('toast-message');
            const toastTitle = document.getElementById('toast-title');
            const checkIcon = document.getElementById('check-icon');
            const errorIcon = document.getElementById('error-icon');
            
            // Clear any existing timeout
            clearTimeout(toastTimeout);
            
            // Reset styles
            toast.classList.remove('toast-animate-out');
            toastContent.classList.remove('bg-red-600', 'bg-green-600');
            
            if (type === 'success') {
                toastContent.classList.add('bg-green-600');
                toastTitle.textContent = 'Succès';
                checkIcon.classList.remove('hidden');
                errorIcon.classList.add('hidden');
            } else {
                toastContent.classList.add('bg-red-600');
                toastTitle.textContent = 'Erreur';
                errorIcon.classList.remove('hidden');
                checkIcon.classList.add('hidden');
            }
            
            toastMessage.textContent = message;
            toast.classList.remove('hidden');
            toast.classList.add('toast-animate-in');
            
            toastTimeout = setTimeout(() => {
                hideToast();
            }, 4000);
        }
        
        function hideToast() {
            const toast = document.getElementById('toast');
            
            toast.classList.remove('toast-animate-in');
            toast.classList.add('toast-animate-out');
            
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 500);
        }
        /**
         * Gère la soumission du formulaire de connexion.
         * Valide les champs, envoie les données au serveur,
         * et gère la réponse (redirection ou erreur).
         */

        // Handle Register (final step)
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!document.getElementById('terms').checked) {
                showToast("Vous devez accepter les conditions d'utilisation", 'error');
                return;
            }

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            fetch("{{ route('register') }}", {
                    method: "POST"
                    , headers: {
                        "Content-Type": "application/json"
                        , "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                    , body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) throw new Error("Erreur réseau");
                    return response.json();
                })
                .then(json => {
                    if (json.redirect) {
                        window.location.href = json.redirect;
                    } else if (json.error) {
                        showToast(json.error[0], 'error');
                    } else {
                        showToast("Inscription réussie ! Bienvenue.", 'success');
                        setTimeout(() => window.location.href = "/welcome", 1500);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showToast("Une erreur est survenue lors de l'inscription.", 'error');
                });
        });

        // Tab Switching
        document.getElementById('login-tab').addEventListener('click', function() {
            document.getElementById('card').classList.remove('flipped');
            this.classList.add('bg-white', 'text-indigo-700', 'shadow-sm');
            this.classList.remove('text-indigo-500', 'hover:bg-indigo-50');
            document.getElementById('register-tab').classList.remove('bg-white', 'text-indigo-700', 'shadow-sm');
            document.getElementById('register-tab').classList.add('text-indigo-500', 'hover:bg-indigo-50');
        });

        document.getElementById('register-tab').addEventListener('click', function() {
            document.getElementById('card').classList.add('flipped');
            this.classList.add('bg-white', 'text-indigo-700', 'shadow-sm');
            this.classList.remove('text-indigo-500', 'hover:bg-indigo-50');
            document.getElementById('login-tab').classList.remove('bg-white', 'text-indigo-700', 'shadow-sm');
            document.getElementById('login-tab').classList.add('text-indigo-500', 'hover:bg-indigo-50');

            if (currentStep !== 1) {
                goToStep(1);
            }
        });

    </script>

</x-layout>
