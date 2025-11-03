/**
 * Laravel Learning - Interactive Exam Engine
 * Handles quiz functionality, grading, and results
 */

// State Management
let userAnswers = {};
let examSubmitted = false;
let startTime = Date.now();
let timerInterval;
let timeRemaining = 90 * 60; // 90 minutes in seconds

// Initialize Exam
document.addEventListener('DOMContentLoaded', function() {
    initializeExam();
    startTimer();
    setupEventListeners();
});

// Initialize the exam
function initializeExam() {
    const container = document.getElementById('questionsContainer');
    document.getElementById('totalQuestions').textContent = examQuestions.length;

    examQuestions.forEach((question, index) => {
        const card = createQuestionCard(question, index);
        container.appendChild(card);
    });

    updateProgress();
}

// Create question card HTML
function createQuestionCard(question, index) {
    const card = document.createElement('div');
    card.className = 'question-card';
    card.id = `question-${question.id}`;

    const questionNumber = document.createElement('span');
    questionNumber.className = 'question-number';
    questionNumber.textContent = `السؤال ${index + 1}`;

    const questionText = document.createElement('div');
    questionText.className = 'question-text';
    questionText.textContent = question.question;

    const options = document.createElement('div');
    options.className = 'options';

    question.options.forEach((option, optIndex) => {
        const optionDiv = createOptionElement(question, option, optIndex);
        options.appendChild(optionDiv);
    });

    const explanation = document.createElement('div');
    explanation.className = 'explanation';
    explanation.id = `explanation-${question.id}`;
    explanation.innerHTML = `
        <div class="explanation-title">💡 الشرح:</div>
        <div class="explanation-text">${question.explanation}</div>
    `;

    card.appendChild(questionNumber);
    card.appendChild(questionText);
    card.appendChild(options);
    card.appendChild(explanation);

    return card;
}

// Create option element
function createOptionElement(question, option, optIndex) {
    const optionDiv = document.createElement('div');
    optionDiv.className = 'option';

    const radio = document.createElement('input');
    radio.type = 'radio';
    radio.name = `question-${question.id}`;
    radio.value = optIndex;
    radio.id = `q${question.id}-opt${optIndex}`;

    const label = document.createElement('label');
    label.className = 'option-label';
    label.htmlFor = radio.id;
    label.textContent = option;

    const correctIcon = document.createElement('span');
    correctIcon.className = 'option-icon correct';
    correctIcon.textContent = '✅';

    const incorrectIcon = document.createElement('span');
    incorrectIcon.className = 'option-icon incorrect';
    incorrectIcon.textContent = '❌';

    // Event listener
    radio.addEventListener('change', function() {
        handleAnswerChange(question.id, optIndex);
    });

    optionDiv.appendChild(radio);
    optionDiv.appendChild(label);
    optionDiv.appendChild(correctIcon);
    optionDiv.appendChild(incorrectIcon);

    return optionDiv;
}

// Handle answer change
function handleAnswerChange(questionId, answerIndex) {
    userAnswers[questionId] = answerIndex;

    // Update selected styling
    const options = document.querySelectorAll(`input[name="question-${questionId}"]`);
    options.forEach(option => {
        const parent = option.parentElement;
        if (option.checked) {
            parent.classList.add('selected');
        } else {
            parent.classList.remove('selected');
        }
    });

    // Mark as answered
    const card = document.getElementById(`question-${questionId}`);
    card.classList.add('answered');

    updateProgress();
    checkSubmitEnabled();
}

// Update progress bar
function updateProgress() {
    const answeredCount = Object.keys(userAnswers).length;
    const totalCount = examQuestions.length;
    const percentage = Math.round((answeredCount / totalCount) * 100);

    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');

    progressBar.style.width = percentage + '%';
    progressBar.textContent = percentage + '%';
    progressText.textContent = `تم الإجابة على ${answeredCount} من ${totalCount} سؤال`;
}

// Check if submit button should be enabled
function checkSubmitEnabled() {
    const submitBtn = document.getElementById('submitBtn');
    const answeredCount = Object.keys(userAnswers).length;

    if (answeredCount === examQuestions.length) {
        submitBtn.disabled = false;
    } else {
        submitBtn.disabled = true;
    }
}

// Setup event listeners
function setupEventListeners() {
    document.getElementById('submitBtn').addEventListener('click', submitExam);
    document.getElementById('resetBtn').addEventListener('click', resetExam);
}

// Submit and grade exam
function submitExam() {
    if (examSubmitted) return;

    examSubmitted = true;
    stopTimer();

    let correctCount = 0;
    let totalPoints = 0;
    let earnedPoints = 0;

    examQuestions.forEach(question => {
        totalPoints += question.points;
        const userAnswer = userAnswers[question.id];
        const isCorrect = userAnswer === question.correctAnswer;

        if (isCorrect) {
            correctCount++;
            earnedPoints += question.points;
        }

        // Show results for each question
        showQuestionResult(question, userAnswer, isCorrect);
    });

    // Calculate percentage
    const percentage = Math.round((earnedPoints / totalPoints) * 100);

    // Show results modal
    showResults(percentage, correctCount, examQuestions.length - correctCount);

    // Disable all inputs
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.disabled = true;
    });

    // Disable submit button
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('submitBtn').textContent = '✅ تم التصحيح';
}

// Show result for each question
function showQuestionResult(question, userAnswer, isCorrect) {
    const card = document.getElementById(`question-${question.id}`);
    const explanation = document.getElementById(`explanation-${question.id}`);

    // Mark card
    if (isCorrect) {
        card.classList.add('correct');
    } else {
        card.classList.add('incorrect');
    }

    // Mark options
    const options = document.querySelectorAll(`input[name="question-${question.id}"]`);
    options.forEach((option, index) => {
        const parent = option.parentElement;

        if (index === question.correctAnswer) {
            parent.classList.add('correct-answer');
        }

        if (index === userAnswer && !isCorrect) {
            parent.classList.add('wrong-answer');
        }
    });

    // Show explanation
    explanation.classList.add('show');
}

// Show results modal
function showResults(percentage, correct, incorrect) {
    const modal = document.getElementById('resultsModal');
    const icon = document.getElementById('resultsIcon');
    const title = document.getElementById('resultsTitle');
    const score = document.getElementById('resultsScore');
    const message = document.getElementById('resultsMessage');

    score.textContent = percentage + '%';
    document.getElementById('correctCount').textContent = correct;
    document.getElementById('incorrectCount').textContent = incorrect;
    document.getElementById('timeSpent').textContent = getElapsedTime();

    // Determine grade and message
    if (percentage >= 90) {
        icon.textContent = '🎉';
        title.textContent = 'ممتاز! Excellent!';
        score.className = 'results-score excellent';
        message.textContent = 'أداء رائع! أنت متقن للمادة تماماً وجاهز للانتقال إلى الدرس التالي. واصل التميز! 🌟';
    } else if (percentage >= 80) {
        icon.textContent = '😊';
        title.textContent = 'جيد جداً! Very Good!';
        score.className = 'results-score good';
        message.textContent = 'أداء جيد جداً! راجع الأسئلة التي أخطأت فيها لتحسين فهمك، ثم انتقل للدرس التالي. 👍';
    } else if (percentage >= 70) {
        icon.textContent = '🙂';
        title.textContent = 'جيد - Good';
        score.className = 'results-score pass';
        message.textContent = 'أداء مقبول. يُنصح بمراجعة الدرس مرة أخرى والتركيز على النقاط التي لم تجب عليها بشكل صحيح. ⚠️';
    } else {
        icon.textContent = '😔';
        title.textContent = 'يحتاج تحسين - Needs Improvement';
        score.className = 'results-score fail';
        message.textContent = 'يبدو أنك بحاجة لمراجعة الدرس بشكل أعمق. خذ وقتك في الدراسة وحاول مرة أخرى. لا تستسلم! 💪';
    }

    modal.classList.add('show');
}

// Close results modal
function closeResults() {
    document.getElementById('resultsModal').classList.remove('show');

    // Scroll to first incorrect answer
    const firstIncorrect = document.querySelector('.question-card.incorrect');
    if (firstIncorrect) {
        firstIncorrect.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

// Reset exam
function resetExam() {
    if (!confirm('هل أنت متأكد من إعادة المحاولة؟ سيتم حذف جميع إجاباتك.')) {
        return;
    }

    // Reset state
    userAnswers = {};
    examSubmitted = false;
    startTime = Date.now();
    timeRemaining = 90 * 60;

    // Reset UI
    document.querySelectorAll('.question-card').forEach(card => {
        card.classList.remove('answered', 'correct', 'incorrect');
    });

    document.querySelectorAll('.option').forEach(option => {
        option.classList.remove('selected', 'correct-answer', 'wrong-answer');
    });

    document.querySelectorAll('.explanation').forEach(exp => {
        exp.classList.remove('show');
    });

    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.checked = false;
        input.disabled = false;
    });

    // Reset buttons
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('submitBtn').innerHTML = '<span>✅</span><span>تصحيح الاختبار</span>';

    // Close modal
    document.getElementById('resultsModal').classList.remove('show');

    // Reset progress
    updateProgress();

    // Restart timer
    startTimer();

    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Timer functions
function startTimer() {
    clearInterval(timerInterval);

    timerInterval = setInterval(function() {
        timeRemaining--;
        updateTimerDisplay();

        if (timeRemaining <= 0) {
            stopTimer();
            alert('⏰ انتهى الوقت! سيتم تصحيح الاختبار الآن.');
            submitExam();
        }
    }, 1000);
}

function stopTimer() {
    clearInterval(timerInterval);
}

function updateTimerDisplay() {
    const minutes = Math.floor(timeRemaining / 60);
    const seconds = timeRemaining % 60;
    const display = `${minutes}:${seconds.toString().padStart(2, '0')}`;

    document.getElementById('timerValue').textContent = display;

    const timer = document.getElementById('timer');
    if (timeRemaining <= 300) { // 5 minutes warning
        timer.classList.add('warning');
    } else {
        timer.classList.remove('warning');
    }
}

function getElapsedTime() {
    const totalSeconds = Math.floor((Date.now() - startTime) / 1000);
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    return `${minutes}:${seconds.toString().padStart(2, '0')}`;
}

// Prevent page refresh during exam
window.addEventListener('beforeunload', function(e) {
    if (!examSubmitted && Object.keys(userAnswers).length > 0) {
        e.preventDefault();
        e.returnValue = '';
        return 'لديك إجابات غير محفوظة. هل أنت متأكد من المغادرة؟';
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + Enter to submit
    if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
        const submitBtn = document.getElementById('submitBtn');
        if (!submitBtn.disabled) {
            submitExam();
        }
    }

    // Escape to close results
    if (e.key === 'Escape') {
        closeResults();
    }
});

// Console welcome
console.log('%c🎯 Interactive Exam System', 'font-size: 20px; color: #ff2d20; font-weight: bold;');
console.log('%cGood luck with your exam! 📚', 'font-size: 14px; color: #2d3748;');
console.log(`%cTotal Questions: ${examQuestions.length}`, 'color: #4a5568;');
console.log(`%cTime Limit: 90 minutes`, 'color: #4a5568;');
