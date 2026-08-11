const quizData = [
{
question:"What does HTML stand for?",
answers:[
"Hyper Text Markup Language",
"High Text Machine Language",
"Hyper Transfer Markup Language",
"Home Tool Markup Language"
],
correct:"Hyper Text Markup Language"
},

{
question:"Which language is used for styling web pages?",
answers:[
"HTML",
"CSS",
"Python",
"Java"
],
correct:"CSS"
},

{
question:"Which language makes websites interactive?",
answers:[
"HTML",
"CSS",
"JavaScript",
"SQL"
],
correct:"JavaScript"
},

{
question:"Which tag is used to create a paragraph?",
answers:[
"<p>",
"<h1>",
"<div>",
"<img>"
],
correct:"<p>"
},

{
question:"Which symbol is used for JavaScript comments?",
answers:[
"//",
"##",
"<!-- -->",
"**"
],
correct:"//"
},

{
question:"Who developed JavaScript?",
answers:[
"Microsoft",
"Netscape",
"Google",
"Apple"
],
correct:"Netscape"
},

{
question:"Which HTML tag is used for images?",
answers:[
"<image>",
"<img>",
"<picture>",
"<src>"
],
correct:"<img>"
},

{
question:"Which keyword is used to declare a variable?",
answers:[
"let",
"int",
"define",
"variable"
],
correct:"let"
},

{
question:"Which is a JavaScript framework?",
answers:[
"React",
"HTML",
"CSS",
"MySQL"
],
correct:"React"
},

{
question:"Which database is popular for web applications?",
answers:[
"MySQL",
"Photoshop",
"Excel",
"PowerPoint"
],
correct:"MySQL"
},

{
question:"What is the capital of India?",
answers:[
"Mumbai",
"Delhi",
"Chennai",
"Kolkata"
],
correct:"Delhi"
},

{
question:"Which planet is called the Red Planet?",
answers:[
"Earth",
"Mars",
"Jupiter",
"Venus"
],
correct:"Mars"
},

{
question:"How many days are in a leap year?",
answers:[
"365",
"366",
"360",
"364"
],
correct:"366"
},

{
question:"Largest ocean in the world?",
answers:[
"Indian Ocean",
"Atlantic Ocean",
"Pacific Ocean",
"Arctic Ocean"
],
correct:"Pacific Ocean"
},

{
question:"What is 10 × 10?",
answers:[
"50",
"100",
"200",
"10"
],
correct:"100"
},

{
question:"King of the Jungle is?",
answers:[
"Tiger",
"Lion",
"Elephant",
"Bear"
],
correct:"Lion"
},

{
question:"Which device is used for typing?",
answers:[
"Monitor",
"Keyboard",
"Printer",
"Speaker"
],
correct:"Keyboard"
},

{
question:"Microsoft developed which operating system?",
answers:[
"Linux",
"Windows",
"Android",
"iOS"
],
correct:"Windows"
},

{
question:"Which HTML tag creates a hyperlink?",
answers:[
"<a>",
"<link>",
"<href>",
"<url>"
],
correct:"<a>"
},

{
question:"Which data type stores true/false?",
answers:[
"String",
"Boolean",
"Number",
"Array"
],
correct:"Boolean"
}
];

let currentQuestion = 0;
let score = 0;
let answered = false;

const questionElement = document.getElementById("question");
const answersElement = document.getElementById("answers");
const nextButton = document.getElementById("nextBtn");
const progressElement = document.getElementById("progress");

function loadQuestion() {

    answered = false;

    const current = quizData[currentQuestion];

    questionElement.textContent = current.question;

    progressElement.textContent =
        `Question ${currentQuestion + 1} of ${quizData.length}`;

    answersElement.innerHTML = "";

    current.answers.forEach(answer => {

        const button = document.createElement("button");

        // IMPORTANT: use textContent
        button.textContent = answer;

        button.classList.add("answer-btn");

        button.onclick = function () {

            if (answered) return;

            answered = true;

            const buttons = document.querySelectorAll(".answer-btn");

            buttons.forEach(btn => {

                btn.disabled = true;

                if (btn.textContent === current.correct) {
                    btn.classList.add("correct");
                }

                if (
                    btn.textContent === answer &&
                    answer !== current.correct
                ) {
                    btn.classList.add("wrong");
                }

            });

            if (answer === current.correct) {
                score++;
            }

        };

        answersElement.appendChild(button);

    });

}

nextButton.onclick = function () {

    if (!answered) {
        alert("Please select an answer first!");
        return;
    }

    currentQuestion++;

    if (currentQuestion < quizData.length) {
        loadQuestion();
    } else {
        showResult();
    }

};

function showResult() {

    document.querySelector(".quiz-box").classList.add("hide");

    document.getElementById("result").classList.remove("hide");

    document.getElementById("score").textContent =
        `Your Score: ${score} / ${quizData.length}`;

}

loadQuestion();