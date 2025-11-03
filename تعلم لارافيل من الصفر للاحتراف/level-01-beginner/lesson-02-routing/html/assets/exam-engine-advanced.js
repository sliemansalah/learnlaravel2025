/**
 * Advanced Exam Engine with Smart Auto-Grading
 * Supports: MCQ, True/False, Essay, Code, Commands, Fill-in-blanks
 */

// State
let userAnswers = {};
let examSubmitted = false;
let startTime = Date.now();
let timerInterval;
let timeRemaining = 120 * 60; // 120 minutes

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    initializeExam();
    startTimer();
    setupEventListeners();
});

// Initialize exam
function initializeExam() {
    const container = document.getElementById('questionsContainer');

    // Count total items (including sub-questions)
    let totalItems = 0;
    advancedExamQuestions.forEach(q => {
        if (q.type === 'project') {
            totalItems += q.subQuestions.length;
        } else {
            totalItems += 1;
        }
    });

    document.getElementById('totalQuestions').textContent = totalItems;

    advancedExamQuestions.forEach((question, index) => {
        const card = createQuestionCard(question, index);
        container.appendChild(card);
    });

    updateProgress();
}

// Create question card based on type
function createQuestionCard(question, index) {
    const card = document.createElement('div');
    card.className = 'question-card';
    card.id = `question-${question.id}`;

    const questionNumber = document.createElement('span');
    questionNumber.className = 'question-number';
    questionNumber.textContent = `السؤال ${index + 1}`;

    // Add type badge
    const typeBadge = document.createElement('span');
    typeBadge.className = 'type-badge';
    typeBadge.textContent = getTypeBadgeText(question.type);
    typeBadge.style.cssText = 'margin-right: 10px; padding: 5px 12px; background: #4299e1; color: white; border-radius: 15px; font-size: 0.8rem;';

    const questionText = document.createElement('div');
    questionText.className = 'question-text';
    questionText.textContent = question.question;

    const answerArea = createAnswerArea(question);

    const explanation = document.createElement('div');
    explanation.className = 'explanation';
    explanation.id = `explanation-${question.id}`;
    explanation.innerHTML = `
        <div class="explanation-title">💡 الشرح:</div>
        <div class="explanation-text">${question.explanation}</div>
    `;

    card.appendChild(questionNumber);
    card.appendChild(typeBadge);
    card.appendChild(questionText);
    card.appendChild(answerArea);
    card.appendChild(explanation);

    return card;
}

// Get type badge text
function getTypeBadgeText(type) {
    const badges = {
        'multiple-choice': 'اختيار من متعدد',
        'true-false': 'صح/خطأ',
        'essay': 'مقالي',
        'code': 'كتابة كود',
        'command': 'أمر',
        'fill-blank': 'ملء فراغ',
        'code-reading': 'قراءة كود',
        'project': 'مشروع تطبيقي'
    };
    return badges[type] || type;
}

// Create answer area based on question type
function createAnswerArea(question) {
    const area = document.createElement('div');
    area.className = 'answer-area';

    switch(question.type) {
        case 'multiple-choice':
        case 'true-false':
        case 'code-reading':
            area.appendChild(createOptionsArea(question));
            break;
        case 'essay':
            area.appendChild(createEssayArea(question));
            break;
        case 'code':
            area.appendChild(createCodeArea(question));
            break;
        case 'command':
            area.appendChild(createCommandArea(question));
            break;
        case 'fill-blank':
            area.appendChild(createFillBlankArea(question));
            break;
        case 'project':
            area.appendChild(createProjectArea(question));
            break;
    }

    return area;
}

// Create options (MCQ/TF)
function createOptionsArea(question) {
    const options = document.createElement('div');
    options.className = 'options';

    question.options.forEach((option, index) => {
        const optionDiv = document.createElement('div');
        optionDiv.className = 'option';

        const radio = document.createElement('input');
        radio.type = 'radio';
        radio.name = `question-${question.id}`;
        radio.value = index;
        radio.id = `q${question.id}-opt${index}`;

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

        radio.addEventListener('change', function() {
            handleAnswerChange(question.id, index, 'option');
        });

        optionDiv.appendChild(radio);
        optionDiv.appendChild(label);
        optionDiv.appendChild(correctIcon);
        optionDiv.appendChild(incorrectIcon);
        options.appendChild(optionDiv);
    });

    return options;
}

// Create essay area
function createEssayArea(question) {
    const container = document.createElement('div');
    container.className = 'essay-container';

    const textarea = document.createElement('textarea');
    textarea.id = `answer-${question.id}`;
    textarea.className = 'essay-textarea';
    textarea.placeholder = 'اكتب إجابتك هنا... (حد أدنى ' + question.minWords + ' كلمة)';
    textarea.rows = 6;
    textarea.style.cssText = 'width: 100%; padding: 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; font-family: inherit; resize: vertical;';

    const wordCount = document.createElement('div');
    wordCount.id = `wordcount-${question.id}`;
    wordCount.className = 'word-count';
    wordCount.textContent = '0 كلمة';
    wordCount.style.cssText = 'margin-top: 8px; font-size: 0.9rem; color: #718096;';

    textarea.addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/).filter(w => w.length > 0).length;
        wordCount.textContent = words + ' كلمة';

        if (words >= question.minWords) {
            wordCount.style.color = '#48bb78';
        } else {
            wordCount.style.color = '#718096';
        }

        handleAnswerChange(question.id, this.value, 'essay');
    });

    container.appendChild(textarea);
    container.appendChild(wordCount);
    return container;
}

// Create code area
function createCodeArea(question) {
    const container = document.createElement('div');
    container.className = 'code-container';

    const textarea = document.createElement('textarea');
    textarea.id = `answer-${question.id}`;
    textarea.className = 'code-textarea';
    textarea.placeholder = question.placeholder || 'اكتب الكود هنا...';
    textarea.rows = 10;
    textarea.style.cssText = 'width: 100%; padding: 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 0.95rem; font-family: "Courier New", monospace; resize: vertical; direction: ltr; text-align: left; background: #2d3748; color: #e2e8f0;';

    textarea.addEventListener('input', function() {
        handleAnswerChange(question.id, this.value, 'code');
    });

    container.appendChild(textarea);
    return container;
}

// Create command area
function createCommandArea(question) {
    const container = document.createElement('div');
    container.className = 'command-container';

    const input = document.createElement('input');
    input.type = 'text';
    input.id = `answer-${question.id}`;
    input.className = 'command-input';
    input.placeholder = question.placeholder || 'اكتب الأمر هنا...';
    input.style.cssText = 'width: 100%; padding: 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1rem; font-family: "Courier New", monospace; direction: ltr; text-align: left; background: #1a202c; color: #48bb78;';

    input.addEventListener('input', function() {
        handleAnswerChange(question.id, this.value, 'command');
    });

    container.appendChild(input);
    return container;
}

// Create fill-blank area
function createFillBlankArea(question) {
    const container = document.createElement('div');
    container.className = 'fill-blank-container';

    const input = document.createElement('input');
    input.type = 'text';
    input.id = `answer-${question.id}`;
    input.className = 'fill-blank-input';
    input.placeholder = question.placeholder || 'اكتب الإجابة...';
    input.style.cssText = 'width: 100%; padding: 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 1.1rem;';

    input.addEventListener('input', function() {
        handleAnswerChange(question.id, this.value, 'fill-blank');
    });

    container.appendChild(input);
    return container;
}

// Create project area (with sub-questions)
function createProjectArea(question) {
    const container = document.createElement('div');
    container.className = 'project-container';
    container.style.cssText = 'background: #f7fafc; padding: 20px; border-radius: 10px; margin-top: 15px;';

    const description = document.createElement('div');
    description.className = 'project-description';
    description.style.cssText = 'background: #fff5ee; padding: 15px; border-right: 4px solid #ff2d20; border-radius: 8px; margin-bottom: 20px; font-weight: 600;';
    description.innerHTML = `📋 المطلوب: ${question.question}<br><small style="color: #718096;">المجموع: ${question.points} نقطة</small>`;
    container.appendChild(description);

    question.subQuestions.forEach((subQ, index) => {
        const subContainer = document.createElement('div');
        subContainer.className = 'sub-question';
        subContainer.style.cssText = 'background: white; padding: 20px; border-radius: 8px; margin-bottom: 15px; border: 2px solid #e2e8f0;';

        const subTitle = document.createElement('div');
        subTitle.className = 'sub-question-title';
        subTitle.style.cssText = 'font-weight: 600; color: #2d3748; margin-bottom: 15px; font-size: 1.05rem;';
        subTitle.innerHTML = `<span style="background: #ed8936; color: white; padding: 4px 10px; border-radius: 12px; margin-left: 8px; font-size: 0.85rem;">${subQ.points} نقاط</span> ${subQ.question}`;
        subContainer.appendChild(subTitle);

        // Create appropriate input based on sub-question type
        let inputElement;
        if (subQ.type === 'code') {
            inputElement = document.createElement('textarea');
            inputElement.rows = 8;
            inputElement.placeholder = subQ.placeholder || 'اكتب الكود هنا...';
            inputElement.style.cssText = 'width: 100%; padding: 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-family: "Courier New", monospace; font-size: 0.95rem; resize: vertical; direction: ltr; text-align: left; background: #2d3748; color: #e2e8f0;';
        } else if (subQ.type === 'command') {
            inputElement = document.createElement('input');
            inputElement.type = 'text';
            inputElement.placeholder = subQ.placeholder || 'اكتب الأمر...';
            inputElement.style.cssText = 'width: 100%; padding: 15px; border: 2px solid #e2e8f0; border-radius: 8px; font-family: "Courier New", monospace; direction: ltr; text-align: left; background: #1a202c; color: #48bb78; font-size: 1rem;';
        }

        inputElement.id = `answer-${subQ.id}`;
        inputElement.className = `${subQ.type}-input`;
        inputElement.addEventListener('input', function() {
            handleAnswerChange(subQ.id, this.value, subQ.type);
        });

        subContainer.appendChild(inputElement);
        container.appendChild(subContainer);
    });

    return container;
}

// Handle answer change
function handleAnswerChange(questionId, answer, type) {
    userAnswers[questionId] = { answer, type };

    if (type === 'option') {
        const options = document.querySelectorAll(`input[name="question-${questionId}"]`);
        options.forEach(option => {
            const parent = option.parentElement;
            if (option.checked) {
                parent.classList.add('selected');
            } else {
                parent.classList.remove('selected');
            }
        });
    }

    const card = document.getElementById(`question-${questionId}`);
    card.classList.add('answered');

    updateProgress();
    checkSubmitEnabled();
}

// Update progress
function updateProgress() {
    // Count total items (including sub-questions)
    let totalCount = 0;
    advancedExamQuestions.forEach(q => {
        if (q.type === 'project') {
            totalCount += q.subQuestions.length;
        } else {
            totalCount += 1;
        }
    });

    const answeredCount = Object.keys(userAnswers).length;
    const percentage = Math.round((answeredCount / totalCount) * 100);

    document.getElementById('progressBar').style.width = percentage + '%';
    document.getElementById('progressBar').textContent = percentage + '%';
    document.getElementById('progressText').textContent = `تم الإجابة على ${answeredCount} من ${totalCount} سؤال`;
}

// Check if submit enabled
function checkSubmitEnabled() {
    // Count total required answers (including sub-questions)
    let totalRequired = 0;
    advancedExamQuestions.forEach(q => {
        if (q.type === 'project') {
            totalRequired += q.subQuestions.length;
        } else {
            totalRequired += 1;
        }
    });

    const answeredCount = Object.keys(userAnswers).length;
    document.getElementById('submitBtn').disabled = answeredCount < totalRequired;
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

    let totalScore = 0;
    let earnedScore = 0;
    let results = [];

    advancedExamQuestions.forEach(question => {
        // Calculate total score properly (handle project sub-questions)
        if (question.type === 'project') {
            totalScore += question.subQuestions.reduce((sum, sq) => sum + sq.points, 0);
        } else {
            totalScore += question.points;
        }

        const userAnswer = userAnswers[question.id];
        const result = gradeQuestion(question, userAnswer);

        earnedScore += result.score;
        results.push(result);

        showQuestionResult(question, result);
    });

    const percentage = Math.round((earnedScore / totalScore) * 100);
    showResults(percentage, results, earnedScore, totalScore);

    disableAllInputs();
}

// Smart grading system
function gradeQuestion(question, userAnswer) {
    if (!userAnswer && question.type !== 'project') {
        return { score: 0, feedback: 'لم يتم الإجابة', isCorrect: false };
    }

    switch(question.type) {
        case 'multiple-choice':
        case 'true-false':
        case 'code-reading':
            return gradeMCQ(question, userAnswer);
        case 'essay':
            return gradeEssay(question, userAnswer);
        case 'code':
            return gradeCode(question, userAnswer);
        case 'command':
            return gradeCommand(question, userAnswer);
        case 'fill-blank':
            return gradeFillBlank(question, userAnswer);
        case 'project':
            return gradeProject(question);
        default:
            return { score: 0, feedback: 'نوع سؤال غير مدعوم', isCorrect: false };
    }
}

// Grade MCQ
function gradeMCQ(question, userAnswer) {
    const isCorrect = userAnswer.answer === question.correctAnswer;
    return {
        score: isCorrect ? question.points : 0,
        feedback: isCorrect ? 'إجابة صحيحة!' : 'إجابة خاطئة',
        isCorrect
    };
}

// Grade Essay (keyword-based)
function gradeEssay(question, userAnswer) {
    const answer = userAnswer.answer.toLowerCase();
    const words = answer.trim().split(/\s+/).filter(w => w.length > 0);

    // Check word count
    if (words.length < question.minWords) {
        return {
            score: 0,
            feedback: `الإجابة قصيرة جداً (${words.length} كلمة، الحد الأدنى ${question.minWords})`,
            isCorrect: false
        };
    }

    // Keyword matching
    let keywordMatches = 0;
    question.keywords.forEach(keyword => {
        if (answer.includes(keyword.toLowerCase())) {
            keywordMatches++;
        }
    });

    // Calculate score based on keyword coverage
    const keywordPercentage = (keywordMatches / question.keywords.length) * 100;
    let score = 0;
    let feedback = '';

    if (keywordPercentage >= 70) {
        score = question.points;
        feedback = `ممتاز! غطيت ${keywordMatches} من ${question.keywords.length} نقاط رئيسية`;
    } else if (keywordPercentage >= 50) {
        score = Math.round(question.points * 0.75);
        feedback = `جيد! غطيت ${keywordMatches} من ${question.keywords.length} نقاط، لكن ينقصك بعض التفاصيل`;
    } else if (keywordPercentage >= 30) {
        score = Math.round(question.points * 0.5);
        feedback = `مقبول! غطيت ${keywordMatches} من ${question.keywords.length} نقاط، راجع الإجابة النموذجية`;
    } else {
        score = Math.round(question.points * 0.25);
        feedback = `ضعيف! غطيت ${keywordMatches} من ${question.keywords.length} نقاط فقط`;
    }

    return {
        score,
        feedback,
        isCorrect: score >= question.points * 0.7
    };
}

// Grade Code (pattern matching)
function gradeCode(question, userAnswer) {
    const code = userAnswer.answer.trim();

    if (code.length === 0) {
        return { score: 0, feedback: 'لم يتم كتابة أي كود', isCorrect: false };
    }

    // Check against patterns
    let matches = 0;
    question.correctPatterns.forEach(pattern => {
        if (pattern.test(code)) {
            matches++;
        }
    });

    const score = matches > 0 ? question.points : 0;
    const feedback = matches > 0
        ? 'الكود صحيح! ✓'
        : 'الكود غير مطابق للنموذج المطلوب، راجع الحل النموذجي';

    return {
        score,
        feedback,
        isCorrect: matches > 0
    };
}

// Grade Command
function gradeCommand(question, userAnswer) {
    const command = userAnswer.answer.trim();
    const normalizedCommand = question.caseSensitive ? command : command.toLowerCase();

    let isCorrect = false;
    question.acceptedAnswers.forEach(accepted => {
        const normalizedAccepted = question.caseSensitive ? accepted : accepted.toLowerCase();
        if (normalizedCommand === normalizedAccepted) {
            isCorrect = true;
        }
    });

    return {
        score: isCorrect ? question.points : 0,
        feedback: isCorrect ? 'الأمر صحيح! ✓' : 'الأمر غير صحيح، راجع الصيغة الصحيحة',
        isCorrect
    };
}

// Grade Fill Blank
function gradeFillBlank(question, userAnswer) {
    const answer = userAnswer.answer.trim();
    const normalizedAnswer = question.caseSensitive ? answer : answer.toLowerCase();

    let isCorrect = false;
    question.correctAnswers.forEach(correct => {
        const normalizedCorrect = question.caseSensitive ? correct : correct.toLowerCase();
        if (normalizedAnswer === normalizedCorrect) {
            isCorrect = true;
        }
    });

    return {
        score: isCorrect ? question.points : 0,
        feedback: isCorrect ? 'إجابة صحيحة! ✓' : 'إجابة خاطئة',
        isCorrect
    };
}

// Grade Project (grades all sub-questions)
function gradeProject(question) {
    let totalScore = 0;
    let maxScore = 0;
    let subResults = [];

    question.subQuestions.forEach(subQ => {
        maxScore += subQ.points;
        const userAnswer = userAnswers[subQ.id];

        let result;
        if (!userAnswer) {
            result = { score: 0, feedback: 'لم يتم الإجابة', isCorrect: false };
        } else {
            // Grade based on sub-question type
            if (subQ.type === 'code') {
                result = gradeCode(subQ, userAnswer);
            } else if (subQ.type === 'command') {
                result = gradeCommand(subQ, userAnswer);
            } else {
                result = { score: 0, feedback: 'نوع غير مدعوم', isCorrect: false };
            }
        }

        totalScore += result.score;
        subResults.push(result);
    });

    const percentage = (totalScore / maxScore) * 100;
    const isCorrect = percentage >= 70;

    return {
        score: totalScore,
        feedback: `حصلت على ${totalScore} من ${maxScore} نقطة (${Math.round(percentage)}%)`,
        isCorrect,
        subResults
    };
}

// Show question result
function showQuestionResult(question, result) {
    const card = document.getElementById(`question-${question.id}`);
    const explanation = document.getElementById(`explanation-${question.id}`);

    // Special handling for project questions
    if (question.type === 'project' && result.subResults) {
        // Show detailed feedback for each sub-question
        const projectContainer = card.querySelector('.project-container');
        const subQuestionDivs = projectContainer.querySelectorAll('.sub-question');

        question.subQuestions.forEach((subQ, index) => {
            const subResult = result.subResults[index];
            const subDiv = subQuestionDivs[index];

            const subFeedback = document.createElement('div');
            subFeedback.className = 'sub-result-feedback';
            subFeedback.style.cssText = `
                margin-top: 10px;
                padding: 12px;
                border-radius: 6px;
                font-size: 0.95rem;
                ${subResult.isCorrect ? 'background: #f0fff4; border: 2px solid #48bb78; color: #22543d;' : 'background: #fff5f5; border: 2px solid #f56565; color: #742a2a;'}
            `;
            subFeedback.innerHTML = `
                ${subResult.isCorrect ? '✅' : '❌'} ${subResult.feedback}
                <br><small>النقاط: ${subResult.score} من ${subQ.points}</small>
            `;

            // Show sample answer if available
            if (subQ.sampleAnswer) {
                const sampleDiv = document.createElement('div');
                sampleDiv.style.cssText = 'margin-top: 8px; padding: 10px; background: #edf2f7; border-radius: 4px; font-size: 0.9rem;';
                sampleDiv.innerHTML = `
                    <strong>إجابة نموذجية:</strong>
                    <pre style="margin-top: 5px; background: white; padding: 8px; border-radius: 4px; white-space: pre-wrap; font-size: 0.85rem;">${subQ.sampleAnswer}</pre>
                `;
                subFeedback.appendChild(sampleDiv);
            }

            subDiv.appendChild(subFeedback);
        });

        // Overall project feedback
        const feedbackDiv = document.createElement('div');
        feedbackDiv.className = 'result-feedback';
        feedbackDiv.style.cssText = `
            margin-top: 15px;
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            ${result.isCorrect ? 'background: #f0fff4; border: 2px solid #48bb78; color: #22543d;' : 'background: #fff5f5; border: 2px solid #f56565; color: #742a2a;'}
        `;
        feedbackDiv.innerHTML = `
            <span style="font-size: 1.2rem; margin-left: 8px;">${result.isCorrect ? '✅' : '❌'}</span>
            ${result.feedback}
        `;

        card.classList.add(result.isCorrect ? 'correct' : 'incorrect');
        card.appendChild(feedbackDiv);
        explanation.classList.add('show');
    } else {
        // Normal question handling
        const feedbackDiv = document.createElement('div');
        feedbackDiv.className = 'result-feedback';
        feedbackDiv.style.cssText = `
            margin-top: 15px;
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            ${result.isCorrect ? 'background: #f0fff4; border: 2px solid #48bb78; color: #22543d;' : 'background: #fff5f5; border: 2px solid #f56565; color: #742a2a;'}
        `;
        feedbackDiv.innerHTML = `
            <span style="font-size: 1.2rem; margin-left: 8px;">${result.isCorrect ? '✅' : '❌'}</span>
            ${result.feedback}
            <br>
            <small>النقاط: ${result.score} من ${question.points}</small>
        `;

        card.classList.add(result.isCorrect ? 'correct' : 'incorrect');
        card.appendChild(feedbackDiv);
        explanation.classList.add('show');

        // Show sample answer for essay/code
        if ((question.type === 'essay' || question.type === 'code') && question.sampleAnswer) {
            const sampleDiv = document.createElement('div');
            sampleDiv.className = 'sample-answer';
            sampleDiv.style.cssText = 'margin-top: 10px; padding: 15px; background: #edf2f7; border-radius: 8px;';
            sampleDiv.innerHTML = `
                <strong>إجابة نموذجية:</strong>
                <pre style="margin-top: 10px; background: white; padding: 10px; border-radius: 4px; white-space: pre-wrap;">${question.sampleAnswer}</pre>
            `;
            explanation.appendChild(sampleDiv);
        }
    }
}

// Show results modal
function showResults(percentage, results, earnedScore, totalScore) {
    const modal = document.getElementById('resultsModal');
    const icon = document.getElementById('resultsIcon');
    const title = document.getElementById('resultsTitle');
    const score = document.getElementById('resultsScore');
    const message = document.getElementById('resultsMessage');

    score.textContent = percentage + '%';

    const correctCount = results.filter(r => r.isCorrect).length;
    const incorrectCount = results.length - correctCount;

    document.getElementById('correctCount').textContent = correctCount;
    document.getElementById('incorrectCount').textContent = incorrectCount;
    document.getElementById('timeSpent').textContent = getElapsedTime();

    // Custom message with score details
    const scoreDetails = `حصلت على ${earnedScore} من ${totalScore} نقطة`;

    if (percentage >= 90) {
        icon.textContent = '🎉';
        title.textContent = 'ممتاز! Excellent!';
        score.className = 'results-score excellent';
        message.textContent = `${scoreDetails}\nأداء رائع! أنت متقن للمادة تماماً وجاهز للانتقال إلى الدرس التالي 🌟`;
    } else if (percentage >= 80) {
        icon.textContent = '😊';
        title.textContent = 'جيد جداً! Very Good!';
        score.className = 'results-score good';
        message.textContent = `${scoreDetails}\nأداء جيد جداً! راجع الأسئلة التي أخطأت فيها 👍`;
    } else if (percentage >= 70) {
        icon.textContent = '🙂';
        title.textContent = 'جيد - Good';
        score.className = 'results-score pass';
        message.textContent = `${scoreDetails}\nأداء مقبول. راجع الدرس مرة أخرى ⚠️`;
    } else {
        icon.textContent = '😔';
        title.textContent = 'يحتاج تحسين';
        score.className = 'results-score fail';
        message.textContent = `${scoreDetails}\nراجع الدرس بشكل أعمق وحاول مرة أخرى 💪`;
    }

    modal.classList.add('show');
}

// Close results
function closeResults() {
    document.getElementById('resultsModal').classList.remove('show');
}

// Reset exam
function resetExam() {
    if (!confirm('هل أنت متأكد من إعادة المحاولة؟')) return;

    userAnswers = {};
    examSubmitted = false;
    startTime = Date.now();
    timeRemaining = 120 * 60; // 120 minutes

    document.querySelectorAll('.question-card').forEach(card => {
        card.classList.remove('answered', 'correct', 'incorrect');
        const feedback = card.querySelector('.result-feedback');
        if (feedback) feedback.remove();
        const sample = card.querySelector('.sample-answer');
        if (sample) sample.remove();
    });

    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.checked = false;
        input.disabled = false;
    });

    document.querySelectorAll('textarea, input[type="text"]').forEach(input => {
        input.value = '';
        input.disabled = false;
    });

    document.querySelectorAll('.explanation').forEach(exp => {
        exp.classList.remove('show');
    });

    document.getElementById('submitBtn').disabled = true;
    document.getElementById('resultsModal').classList.remove('show');

    updateProgress();
    startTimer();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Disable all inputs
function disableAllInputs() {
    document.querySelectorAll('input, textarea').forEach(input => {
        input.disabled = true;
    });
    document.getElementById('submitBtn').disabled = true;
}

// Timer functions
function startTimer() {
    clearInterval(timerInterval);
    timerInterval = setInterval(function() {
        timeRemaining--;
        updateTimerDisplay();
        if (timeRemaining <= 0) {
            stopTimer();
            alert('⏰ انتهى الوقت!');
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
    document.getElementById('timerValue').textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

    const timer = document.getElementById('timer');
    if (timeRemaining <= 300) {
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

// Prevent accidental close
window.addEventListener('beforeunload', function(e) {
    if (!examSubmitted && Object.keys(userAnswers).length > 0) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
        const submitBtn = document.getElementById('submitBtn');
        if (!submitBtn.disabled) submitExam();
    }
    if (e.key === 'Escape') closeResults();
});

console.log('%c🎯 Advanced Interactive Exam System', 'font-size: 20px; color: #ff2d20; font-weight: bold;');
console.log(`%cQuestions: ${advancedExamQuestions.length}`, 'color: #4a5568;');
console.log(`%cSupports: MCQ, Essay, Code, Commands, Fill-blanks`, 'color: #4a5568;');
