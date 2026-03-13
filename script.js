// QUESTIONS
const quizData = [
    {
        question: "Which branch of mathematics deals with shapes and space?",
        answers: ["Algebra", "Geometry", "Statistics", "Calculus"],
        correct: 1
    },
    {
        question: "Which mathematical term describes a number that cannot be written as a fraction?",
        answers: ["Rational number", "Whole number", "Irrational number", "Natural number"],
        correct: 2
    },
    {
        question: "What do we call a statement that is always true in mathematics?",
        answers: ["Formula", "Theorem", "Estimate", "Example"],
        correct: 1
    },
    {
        question: "Which symbol is commonly used to represent an unknown value?",
        answers: ["Constant", "Variable", "Fraction", "Ratio"],
        correct: 1
    },
    {
        question: "Which branch of mathematics focuses on collecting and analyzing data?",
        answers: ["Geometry", "Algebra", "Statistics", "Trigonometry"],
        correct: 2
    },
    {
        question: "What do we call the answer to a division problem?",
        answers: ["Product", "Sum", "Difference", "Quotient"],
        correct: 3
    },
    {
        question: "Which term refers to the distance around a shape?",
        answers: ["Area", "Volume", "Perimeter", "Angle"],
        correct: 2
    },
    {
        question: "What type of graph is commonly used to show changes over time?",
        answers: ["Bar graph", "Line graph", "Pie chart", "Scatter plot"],
        correct: 1
    },
    {
        question: "Which term describes a mathematical sentence with an equals sign?",
        answers: ["Expression", "Equation", "Inequality", "Ratio"],
        correct: 1
    },
    {
        question: "What branch of mathematics studies patterns and relationships?",
        answers: ["Geometry", "Algebra", "Statistics", "Calculus"],
        correct: 1
    }
];

// VARIABLES
let currentQuestion = 0;
let score = 0;
let correctCount = 0;
let wrongCount = 0;
let timeLeft = 15;
let timer;
let userAnswers = [];

// ELEMENTS
const scoreEl = document.querySelector(".score");
const timerEl = document.querySelector(".timer");
const progressEl = document.querySelector(".progress");
const questionEl = document.querySelector(".question");
const answersEl = document.querySelector(".answers");
const feedbackEl = document.querySelector(".feedback");
const statsEl = document.querySelector(".stats");
const restartBtn = document.querySelector(".restart-btn");
const restartContainer = document.querySelector(".restart-container");

// LOAD QUESTION
function loadQuestion() {
    clearInterval(timer);
    timeLeft = 15;

    const q = quizData[currentQuestion];

    questionEl.textContent = q.question;
    progressEl.textContent = `Question ${currentQuestion + 1} of ${quizData.length}`;
    feedbackEl.textContent = "Select an answer";
    answersEl.innerHTML = "";

    q.answers.forEach((answer, index) => {
        const btn = document.createElement("button");
        btn.textContent = `${String.fromCharCode(65 + index)}. ${answer}`;
        btn.onclick = () => checkAnswer(index);
        answersEl.appendChild(btn);
    });

    startTimer();
}

// CHECK ANSWER
function checkAnswer(selected) {
    clearInterval(timer);

    const correct = quizData[currentQuestion].correct;
    userAnswers.push(selected);

    const buttons = answersEl.querySelectorAll("button");
    buttons.forEach((btn, idx) => {
        if (idx === correct) btn.style.backgroundColor = "green";
        if (idx === selected && selected !== correct) btn.style.backgroundColor = "red";
        btn.disabled = true;
        btn.style.color = "white";
    });

    if (selected === correct) {
        feedbackEl.textContent = "✅ Correct!";
        score += 10;
        correctCount++;
    } else {
        feedbackEl.textContent = "❌ Wrong!";
        wrongCount++;
    }

    updateStats();
    setTimeout(nextQuestion, 1500);
}

// TIMER
function startTimer() {
    timerEl.textContent = `Time: ${timeLeft}s`;

    timer = setInterval(() => {
        timeLeft--;
        timerEl.textContent = `Time: ${timeLeft}s`;

        if (timeLeft === 0) {
            clearInterval(timer);
            feedbackEl.textContent = "⏰ Time's up!";
            userAnswers.push(null);
            wrongCount++;
            updateStats();
            setTimeout(nextQuestion, 1500);
        }
    }, 1000);
}

// NEXT QUESTION
function nextQuestion() {
    currentQuestion++;
    if (currentQuestion < quizData.length) {
        loadQuestion();
    } else {
        endQuiz();
    }
}

// UPDATE STATS
function updateStats() {
    scoreEl.textContent = `Score: ${score}`;
    statsEl.innerHTML = `
        <div>Correct: ${correctCount}</div>
        <div>Wrong: ${wrongCount}</div>
    `;
}

// END QUIZ
function endQuiz() {
    clearInterval(timer);

    questionEl.textContent = "🎉 Quiz Finished!";
    answersEl.innerHTML = "";
    progressEl.textContent = "Done!";

    let percentage = ((correctCount / quizData.length) * 100).toFixed(1);

    let reviewHTML = `<h3>Final Score: ${score} (${percentage}%)</h3><br>`;

    quizData.forEach((q, index) => {
        const correctAnswer = q.correct;
        const userAnswer = userAnswers[index];

        reviewHTML += `
<div class="review-card">
    <strong>Question ${index + 1}</strong>
    <p>${q.question}</p>

    <p class="${userAnswer === correctAnswer ? 'correct-answer' : 'wrong-answer'}">
        Your Answer: ${userAnswer !== null && userAnswer !== undefined ? q.answers[userAnswer] : "No Answer"}
    </p>

    <p class="correct-answer">
        Correct Answer: ${q.answers[correctAnswer]}
    </p>
</div>
`;

fetch("save_score.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `score=${score}&correct=${correctCount}&wrong=${wrongCount}&percentage=${percentage}`
});
    });

    feedbackEl.innerHTML = reviewHTML;

    restartContainer.style.display = "block";
}

// RESTART QUIZ
restartBtn.onclick = () => {
    currentQuestion = 0;
    score = 0;
    correctCount = 0;
    wrongCount = 0;
    userAnswers = [];
    restartContainer.style.display = "none";
    loadQuestion();
};

// START QUIZ
loadQuestion();