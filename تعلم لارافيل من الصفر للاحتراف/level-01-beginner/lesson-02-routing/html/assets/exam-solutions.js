/**
 * Exam Solutions Display Script
 * Displays all questions with their correct answers
 */

// State
let currentFilter = 'all';
let searchQuery = '';

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    displaySolutions();
    setupFilters();
    setupSearch();
    updateStatistics();
});

// Display all solutions
function displaySolutions() {
    const container = document.getElementById('solutionsContainer');
    container.innerHTML = '';

    // Group questions by section
    const mcqQuestions = advancedExamQuestions.filter(q => q.type === 'multiple-choice');
    const tfQuestions = advancedExamQuestions.filter(q => q.type === 'true-false');
    const fillBlankQuestions = advancedExamQuestions.filter(q => q.type === 'fill-blank');
    const commandQuestions = advancedExamQuestions.filter(q => q.type === 'command');

    // Display MCQ Section
    if (shouldShowSection('multiple-choice', mcqQuestions)) {
        const mcqSection = createSectionHeader('القسم الأول: اختيار من متعدد', `${mcqQuestions.length} سؤال - 40 نقطة`);
        container.appendChild(mcqSection);
        mcqQuestions.forEach(q => {
            if (shouldShowQuestion(q)) {
                container.appendChild(createSolutionCard(q));
            }
        });
    }

    // Display T/F Section
    if (shouldShowSection('true-false', tfQuestions)) {
        const tfSection = createSectionHeader('القسم الثاني: صح أو خطأ', `${tfQuestions.length} سؤال - 40 نقطة`);
        container.appendChild(tfSection);
        tfQuestions.forEach(q => {
            if (shouldShowQuestion(q)) {
                container.appendChild(createSolutionCard(q));
            }
        });
    }

    // Display Fill-blank Section
    if (shouldShowSection('fill-blank', fillBlankQuestions)) {
        const fillSection = createSectionHeader('القسم الثالث: ملء الفراغات', `${fillBlankQuestions.length} سؤال - ${fillBlankQuestions.length} نقطة`);
        container.appendChild(fillSection);
        fillBlankQuestions.forEach(q => {
            if (shouldShowQuestion(q)) {
                container.appendChild(createSolutionCard(q));
            }
        });
    }

    // Display Command Section
    if (shouldShowSection('command', commandQuestions)) {
        const cmdSection = createSectionHeader('القسم الرابع: أوامر Terminal', `${commandQuestions.length} أسئلة - ${commandQuestions.length} نقاط`);
        container.appendChild(cmdSection);
        commandQuestions.forEach(q => {
            if (shouldShowQuestion(q)) {
                container.appendChild(createSolutionCard(q));
            }
        });
    }

    // Show message if no results
    if (container.children.length === 0) {
        container.innerHTML = '<div style="text-align: center; padding: 50px; color: #718096; font-size: 1.2rem;">لا توجد نتائج مطابقة للبحث 🔍</div>';
    }
}

// Check if section should be shown
function shouldShowSection(type, questions) {
    if (currentFilter !== 'all' && currentFilter !== type) return false;
    if (searchQuery === '') return true;
    return questions.some(q => shouldShowQuestion(q));
}

// Check if question should be shown
function shouldShowQuestion(question) {
    // Filter by type
    if (currentFilter !== 'all' && question.type !== currentFilter) return false;

    // Filter by search
    if (searchQuery !== '') {
        const searchLower = searchQuery.toLowerCase();
        const questionText = question.question.toLowerCase();
        const explanation = question.explanation ? question.explanation.toLowerCase() : '';

        if (!questionText.includes(searchLower) && !explanation.includes(searchLower)) {
            return false;
        }
    }

    return true;
}

// Create section header
function createSectionHeader(title, info) {
    const section = document.createElement('div');
    section.className = 'section-header';
    section.innerHTML = `
        <h2>${title}</h2>
        <div class="section-info">${info}</div>
    `;
    return section;
}

// Create solution card
function createSolutionCard(question) {
    const card = document.createElement('div');
    card.className = 'solution-card';
    card.setAttribute('data-type', question.type);

    const typeText = getTypeText(question.type);

    card.innerHTML = `
        <div class="solution-header">
            <span class="question-number">السؤال ${question.id}</span>
            <span class="question-type">${typeText}</span>
            <span class="question-points">${question.points} نقطة</span>
        </div>

        <div class="question-text">${question.question}</div>

        ${createAnswerDisplay(question)}

        <div class="explanation">
            <div class="explanation-title">💡 الشرح:</div>
            <div class="explanation-text">${question.explanation}</div>
        </div>
    `;

    return card;
}

// Create answer display based on question type
function createAnswerDisplay(question) {
    switch(question.type) {
        case 'multiple-choice':
        case 'true-false':
            return createOptionsDisplay(question);
        case 'fill-blank':
            return createFillBlankDisplay(question);
        case 'command':
            return createCommandDisplay(question);
        default:
            return '';
    }
}

// Create options display (MCQ/TF)
function createOptionsDisplay(question) {
    let html = '<div class="options-list">';

    question.options.forEach((option, index) => {
        const isCorrect = index === question.correctAnswer;
        const className = isCorrect ? 'option-item correct' : 'option-item';
        const letter = String.fromCharCode(97 + index); // a, b, c, d

        html += `
            <div class="${className}">
                <span class="option-label">${letter}) ${option}</span>
            </div>
        `;
    });

    html += '</div>';
    return html;
}

// Create fill-blank display
function createFillBlankDisplay(question) {
    let html = '<div class="correct-answer">';
    html += '<div class="correct-answer-label">✅ الإجابة الصحيحة:</div>';

    if (question.correctAnswers && question.correctAnswers.length > 0) {
        html += '<div class="correct-answer-text">' + question.correctAnswers[0] + '</div>';

        if (question.correctAnswers.length > 1) {
            html += '<div class="accepted-answers">';
            html += '<div class="accepted-answers-label">إجابات مقبولة أخرى:</div>';
            question.correctAnswers.slice(1).forEach(answer => {
                html += `<span class="accepted-answer-item">${answer}</span>`;
            });
            html += '</div>';
        }
    }

    html += '</div>';
    return html;
}

// Create command display
function createCommandDisplay(question) {
    let html = '<div class="correct-answer">';
    html += '<div class="correct-answer-label">✅ الأمر الصحيح:</div>';

    if (question.acceptedAnswers && question.acceptedAnswers.length > 0) {
        html += '<div class="correct-answer-text" style="font-family: \'Courier New\', monospace; direction: ltr; text-align: left;">'
                + question.acceptedAnswers[0] + '</div>';

        if (question.acceptedAnswers.length > 1) {
            html += '<div class="accepted-answers">';
            html += '<div class="accepted-answers-label">أوامر بديلة مقبولة:</div>';
            question.acceptedAnswers.slice(1).forEach(answer => {
                html += `<span class="accepted-answer-item">${answer}</span>`;
            });
            html += '</div>';
        }
    }

    html += '</div>';
    return html;
}

// Get type text in Arabic
function getTypeText(type) {
    const types = {
        'multiple-choice': 'اختيار من متعدد',
        'true-false': 'صح/خطأ',
        'fill-blank': 'ملء فراغ',
        'command': 'أمر Terminal'
    };
    return types[type] || type;
}

// Setup filter buttons
function setupFilters() {
    const filterButtons = document.querySelectorAll('.filter-btn');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active state
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Update filter
            currentFilter = this.getAttribute('data-type');

            // Redisplay solutions
            displaySolutions();
        });
    });
}

// Setup search
function setupSearch() {
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('input', function() {
        searchQuery = this.value.trim();
        displaySolutions();
    });
}

// Update statistics
function updateStatistics() {
    const mcqCount = advancedExamQuestions.filter(q => q.type === 'multiple-choice').length;
    const tfCount = advancedExamQuestions.filter(q => q.type === 'true-false').length;
    const fillCount = advancedExamQuestions.filter(q => q.type === 'fill-blank').length;
    const cmdCount = advancedExamQuestions.filter(q => q.type === 'command').length;
    const practicalCount = fillCount + cmdCount;

    document.getElementById('totalQuestions').textContent = advancedExamQuestions.length;
    document.getElementById('mcqCount').textContent = mcqCount;
    document.getElementById('tfCount').textContent = tfCount;
    document.getElementById('practicalCount').textContent = practicalCount;
}

// Scroll to top button
window.addEventListener('scroll', function() {
    const scrollBtn = document.getElementById('scrollTopBtn');
    if (scrollBtn) {
        if (window.pageYOffset > 300) {
            scrollBtn.style.display = 'block';
        } else {
            scrollBtn.style.display = 'none';
        }
    }
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

console.log('%c📚 Exam Solutions Loaded', 'font-size: 20px; color: #667eea; font-weight: bold;');
console.log(`%cTotal Questions: ${advancedExamQuestions.length}`, 'color: #4a5568;');
