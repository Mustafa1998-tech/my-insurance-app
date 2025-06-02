// Initialize all components on DOM load
document.addEventListener('DOMContentLoaded', () => {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true
    });

    // Initialize animations
    initAnimations();

    // Initialize form handlers
    initFormHandlers();

    // Initialize calculator
    initCalculator();

    // Initialize chat widget
    initChatWidget();
});

// Initialize animations
function initAnimations() {
    // Scroll animations
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                if (entry.target.classList.contains('count')) {
                    animateNumbers();
                }
            }
        });
    });

    // Observe all elements with animate-fade-in class
    document.querySelectorAll('.animate-fade-in').forEach(element => {
        scrollObserver.observe(element);
    });

    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
}

// Initialize form handlers
function initFormHandlers() {
    const contactForm = document.getElementById('contactForm');
    const insuranceForm = document.getElementById('insuranceForm');

    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (validateForm(contactForm)) {
                // Submit form
                console.log('Form submitted successfully');
                // Add loading state
                const submitButton = contactForm.querySelector('button[type="submit"]');
                submitButton.disabled = true;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>جاري الإرسال...';

                // Simulate form submission
                setTimeout(() => {
                    alert('تم إرسال الاستفسار بنجاح!');
                    submitButton.disabled = false;
                    submitButton.innerHTML = 'إرسال';
                    contactForm.reset();
                }, 2000);
            }
        });
    }

    if (insuranceForm) {
        insuranceForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (validateForm(insuranceForm)) {
                calculatePremium();
            }
        });

        // Add event listeners for calculator options
        const calculatorInputs = document.querySelectorAll('#insuranceForm input, #insuranceForm select');
        calculatorInputs.forEach(input => {
            input.addEventListener('change', calculatePremium);
        });
    }
}

// Initialize calculator
function initCalculator() {
    // Add event listeners for calculator options
    const calculatorInputs = document.querySelectorAll('#insuranceForm input, #insuranceForm select');
    calculatorInputs.forEach(input => {
        input.addEventListener('change', calculatePremium);
    });
}

// Initialize chat widget
function initChatWidget() {
    const chatButton = document.getElementById('chatButton');
    const chatModal = document.getElementById('chatModal');
    const userMessage = document.getElementById('userMessage');
    const chatMessages = document.getElementById('chatMessages');

    if (chatButton && chatModal && userMessage && chatMessages) {
        chatButton.onclick = () => {
            chatModal.style.display = 'block';
        }

        function closeChat() {
            chatModal.style.display = 'none';
        }

        function sendMessage() {
            const message = userMessage.value.trim();
            if (message) {
                // Add user message
                const userMsg = `
                    <div class="chat-message user">
                        <div class="message-content">
                            <p>${message}</p>
                        </div>
                    </div>
                `;
                chatMessages.innerHTML += userMsg;
                userMessage.value = '';

                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;

                // Simulate bot response
                setTimeout(() => {
                    const botMsg = `
                        <div class="chat-message bot">
                            <div class="message-content">
                                <p>شكراً لرسالتك! سنقوم بالرد عليك في أقرب وقت.</p>
                            </div>
                        </div>
                    `;
                    chatMessages.innerHTML += botMsg;
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 1000);
            }
        }

        // Auto scroll to bottom when new messages arrive
        chatMessages.addEventListener('DOMNodeInserted', () => {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });

        // Handle close button
        const closeBtn = chatModal.querySelector('.close');
        if (closeBtn) {
            closeBtn.onclick = closeChat;
        }

        // Handle form submission
        const sendButton = document.getElementById('sendButton');
        if (sendButton) {
            sendButton.onclick = sendMessage;
        }

        // Handle enter key
        userMessage.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
}

// Form validation
function validateForm(form) {
    const inputs = form.querySelectorAll('input, select');
    let isValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }

        // Add custom validation for specific fields
        if (input.type === 'email') {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                input.classList.add('is-invalid');
                isValid = false;
            }
        }
    });

    return isValid;
}

// Insurance calculator
function calculatePremium() {
    const carType = document.getElementById('carType')?.value;
    const carYear = document.getElementById('carYear')?.value;
    const carValue = parseFloat(document.getElementById('carValue')?.value) || 0;
    const coverage = document.getElementById('coverage')?.value;
    const glassCover = document.getElementById('glassCover')?.checked;
    const theftCover = document.getElementById('theftCover')?.checked;
    const medicalCover = document.getElementById('medicalCover')?.checked;
    const roadAssistance = document.getElementById('roadAssistance')?.checked;

    let basePremium = 0;
    let additionalPremium = 0;

    // Base premium calculation
    if (carType) {
        switch (carType) {
            case 'sedan':
                basePremium = carValue * 0.02;
                break;
            case 'suv':
                basePremium = carValue * 0.03;
                break;
            case 'sports':
                basePremium = carValue * 0.04;
                break;
        }
    }

    // Additional coverages
    if (glassCover) additionalPremium += carValue * 0.005;
    if (theftCover) additionalPremium += carValue * 0.01;
    if (medicalCover) additionalPremium += carValue * 0.008;
    if (roadAssistance) additionalPremium += carValue * 0.003;

    // Adjust premium based on car year
    const yearFactor = carYear ? 1 - ((2024 - parseInt(carYear)) * 0.02) : 1;
    basePremium *= yearFactor;
    additionalPremium *= yearFactor;

    // Total premium
    const totalPremium = basePremium + additionalPremium;

    // Show results in modal
    const modal = new bootstrap.Modal(document.getElementById('resultModal'));
    const modalBody = document.querySelector('.modal-body');
    if (modalBody) {
        modalBody.innerHTML = `
            <div class="text-center">
                <h3>نتيجة الحساب</h3>
                <div class="premium-result">
                    <div class="result-item">
                        <h4>القسط الشهري</h4>
                        <p class="premium-amount">${totalPremium.toFixed(2)} ريال</p>
                    </div>
                    <div class="result-item">
                        <h4>القسط السنوي</h4>
                        <p class="premium-amount">${(totalPremium * 12).toFixed(2)} ريال</p>
                    </div>
                    <div class="result-item">
                        <h4>الخصومات</h4>
                        <p class="premium-amount">${((1 - yearFactor) * (basePremium + additionalPremium)).toFixed(2)} ريال</p>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary" onclick="modal.hide()">
                        احجز استشارة مجانية
                    </button>
                </div>
            </div>
        `;
        modal.show();
    }
}

// Number animation
function animateNumbers() {
    const counters = document.querySelectorAll('.count');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        let count = 0;
        const increment = target / 200;
        
        if (count < target) {
            counter.textContent = Math.ceil(count + increment);
            setTimeout(() => animateNumbers(), 1);
        } else {
            counter.textContent = target;
        }
    });
}