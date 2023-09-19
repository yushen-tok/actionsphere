"use strict";
const triviaData = [
  { question: "1. Which film won the Academy Award for Best Picture in 2021?",
    answers: ["Nomadland", "The Trial of the Chicago 7", "Minari", "Promising Young Woman"],
    correctAnswer: "Nomadland"
  },
  { question: "2. Who won the Academy Award for Best Actor in 2020 for his role in 'Joker'?",
    answers: ["Joaquin Phoenix", "Leonardo DiCaprio", "Adam Driver", "Brad Pitt"],
    correctAnswer: "Joaquin Phoenix"
  },
  { question: "3. Which film won the Palme d'Or at the Cannes Film Festival in 2019?",
    answers: ["Parasite", "Once Upon a Time in Hollywood", "Pain and Glory", "The Lighthouse"],
    correctAnswer: "Parasite"
  },
  { question: "4. Who won the Academy Award for Best Actress in 2018 for her role in 'Three Billboards Outside Ebbing, Missouri'?",
    answers: ["Frances McDormand", "Saoirse Ronan", "Meryl Streep", "Emma Stone"],
    correctAnswer: "Frances McDormand"
  },
  { question: "5. Which film won the Golden Lion at the Venice Film Festival in 2017?",
    answers: ["The Shape of Water", "The Florida Project", "Call Me by Your Name", "Joker"],
    correctAnswer: "The Shape of Water"
  },
  { question: "6. Who won the Academy Award for Best Supporting Actor in 2016 for his role in 'Moonlight'?",
    answers: ["Mahershala Ali", "Jeff Bridges", "Dev Patel", "Michael Shannon"],
    correctAnswer: "Mahershala Ali"
  }
];

let currentQuestionIndex = 0;
const triviaSection = document.getElementById("trivia-section");
const questionElem = document.getElementById("question");
const answerButtonsContainer = document.getElementById("answer-buttons");
const nextBtn = document.getElementById("next-btn");
nextBtn.addEventListener("click", nextQuestion);
displayQuestion();

function displayQuestion() {
  const questionData = triviaData[currentQuestionIndex];
  questionElem.textContent = questionData.question;
  answerButtonsContainer.innerHTML = "";
  questionData.answers.forEach(answer => {
    const answerBtn = document.createElement("button");
    answerBtn.textContent = answer;
    answerBtn.addEventListener("click", function() {
      checkAnswer(answer, questionData.correctAnswer, answerBtn);
    });
    answerButtonsContainer.appendChild(answerBtn);
  });
  nextBtn.disabled = true;
}

function checkAnswer(selectedAnswer, correctAnswer, selectedButton) {
  const answerButtons = answerButtonsContainer.getElementsByTagName("button");
  Array.from(answerButtons).forEach(answerBtn => {
    answerBtn.disabled = true;
    if (answerBtn.textContent === correctAnswer) {
      answerBtn.style.backgroundColor = "green";
    } else if (answerBtn.textContent === selectedAnswer) {
      selectedButton.style.backgroundColor = "red";
    }
  });
  nextBtn.disabled = false;
}

function nextQuestion() {
  currentQuestionIndex++;

  if (currentQuestionIndex < triviaData.length) {
    displayQuestion();
  } else {
    triviaSection.innerHTML = "<h3>Trivia completed!</h3>";
  }
}