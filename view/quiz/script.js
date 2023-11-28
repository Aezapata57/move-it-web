let questions = [];
let correctAnswers = {};
let answers = [];
let currentQuestionIndex = 0;
let userResponses = new Array(questions.length).fill(null);
let startTime = null;

const submitButton = document.getElementById('submit-button');

function initializeQuiz(questionsData) {
    shuffleArray(questionsData);
    questions = questionsData;
    displayQuestion(currentQuestionIndex);
    updateTimer(document.getElementById('timer'));
    setInterval(() => {
        updateTimer(document.getElementById('timer'));
    }, 1000);
}

function startQuiz(correctAnswersData) {
    correctAnswers = correctAnswersData;
    setupNextButton();
    setupPrevButton();
    setupSubmitButton();
    disableNextButton(false);
    disablePrevButton(false);
    disableSubmitButton(false);
    startTime = new Date();
}

function setupSubmitButton() {
    const submitButton = document.getElementById('submit-button');
    submitButton.addEventListener('click', () => {
        if (hasTimeExpired()) {
            alert("¡El tiempo ha expirado!");
            return;
        }

        const score = calculateScore();
        showResults(score);
    });
}
function updateTimer(timerElement) {
    if (hasTimeExpired()) {
        timerElement.textContent = "Tiempo restante: 0:00";
        submitButton.disabled = true;
        return;
    }

    const currentTime = new Date();
    const timeDifference = (currentTime - startTime) / 1000;
    const timeLimit = 1 * 60;
    const timeRemaining = Math.max(0, timeLimit - timeDifference);

    const minutes = Math.floor(timeRemaining / 60);
    const seconds = Math.floor(timeRemaining % 60);

    const formattedTime = `${minutes}:${seconds.toString().padStart(2, '0')}`;
    timerElement.textContent = `Tiempo restante: ${formattedTime}`;
}

function displayQuestion(index) {
    const questionsDiv = document.getElementById('questions');
    questionsDiv.innerHTML = '';

    const question = questions[index];
    const questionElement = document.createElement('div');
    questionElement.className = 'question';
    questionElement.innerHTML = `
        <h2>${question.question}</h2>
        <p>${question.info}</p>
        <div class="options">
        ${question.options.map((option, optionIndex) => `
            <button 
            class="option-button"
            onclick="selectOption(${index}, ${optionIndex})"
            >
            ${option}
            </button>
        `).join('')}
        </div>
    `;

    questionsDiv.appendChild(questionElement);
}

function hasTimeExpired() {
    const currentTime = new Date();
    const timeDifference = (currentTime - startTime) / 1000;
    const timeLimit = 1 * 60;

    return timeDifference >= timeLimit;
}

function setupNextButton() {
    const nextButton = document.getElementById('next-button');
    nextButton.addEventListener('click', () => {
        if (hasTimeExpired()) {
            alert("¡El tiempo ha expirado!");
            return;
        }
        if (currentQuestionIndex < questions.length - 1) {
            const selectedOptionIndex = getSelectedOptionIndex();
            userResponses[currentQuestionIndex] = selectedOptionIndex;

            currentQuestionIndex++;
            displayQuestion(currentQuestionIndex);
            disablePrevButton(false);

            const restoredOptionIndex = userResponses[currentQuestionIndex];
            if (restoredOptionIndex !== null) {
                restoreSelectedOption(restoredOptionIndex);
            }

            if (currentQuestionIndex === questions.length - 1) {
                disableNextButton(true);
            }
        }
    });
}

function setupPrevButton() {
    const prevButton = document.getElementById('prev-button');
    prevButton.addEventListener('click', () => {
        if (currentQuestionIndex > 0) {
            const selectedOptionIndex = getSelectedOptionIndex();
            userResponses[currentQuestionIndex] = selectedOptionIndex;

            currentQuestionIndex--;
            displayQuestion(currentQuestionIndex);
            disableNextButton(false);

            const restoredOptionIndex = userResponses[currentQuestionIndex];
            if (restoredOptionIndex !== null) {
                restoreSelectedOption(restoredOptionIndex);
            }

            if (currentQuestionIndex === 0) {
                disablePrevButton(true);
            }
        }
    });
}

function getSelectedOptionIndex() {
    const optionButtons = document.querySelectorAll('.question .options .option-button');
    for (let i = 0; i < optionButtons.length; i++) {
        if (optionButtons[i].classList.contains('selected')) {
            return i;
        }
    }
    return null;
}

function restoreSelectedOption(optionIndex) {
    const optionButtons = document.querySelectorAll('.question .options .option-button');
    
    if (optionIndex >= 0 && optionIndex < optionButtons.length) {
        optionButtons[optionIndex].classList.add('selected');
    }
}

function selectOption(questionIndex, optionIndex) {
    const optionButtons = document.querySelectorAll('.question .options .option-button');
    optionButtons.forEach(button => button.classList.remove('selected'));

    const selectedButton = optionButtons[optionIndex];
    selectedButton.classList.add('selected');

    userResponses[questionIndex] = optionIndex;
}

function calculateScore() {
    let score = 0;
    for (let i = 0; i < questions.length; i++) {
        const userResponse = userResponses[i];
        const correctAnswer = parseInt(correctAnswers[`question${i + 1}`]);

        if (userResponse === correctAnswer) {
            score++;
        }
    }
    return score;
}

function showResults(score) {
    const resultData = {
        score: score,
        userResponses: userResponses,
        correctAnswers: correctAnswers,
        questions: questions // Agrega las preguntas a los datos
    };

    // Almacena los datos en el almacenamiento local
    localStorage.setItem('resultData', JSON.stringify(resultData));

    // Redirige a la página de resultados
    window.location.href = 'result.php';
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function disableNextButton(disabled) {
    const nextButton = document.getElementById('next-button');
    nextButton.disabled = disabled;
}

function disablePrevButton(disabled) {
    const prevButton = document.getElementById('prev-button');
    prevButton.disabled = disabled;
}

function disableSubmitButton(disabled) {
    const prevButton = document.getElementById('submit-button');
    prevButton.disabled = disabled;
}


fetch('data.json')
    .then(response => response.json())
    .then(data => {
        const questionsData = data[0].questions;
        initializeQuiz(questionsData);
    })
    .catch(error => {
        console.error('Error al cargar data.json', error);
    });

fetch('answers.json')
    .then(response => response.json())
    .then(data => {
        const correctAnswersData = data[0].answersKey;
        startQuiz(correctAnswersData);
    })
    .catch(error => {
        console.error('Error al cargar answer.json', error);
    });
