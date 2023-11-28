document.addEventListener("DOMContentLoaded", function () {
    // Obtiene los datos de la almacenamiento local
    const resultDataJSON = localStorage.getItem('resultData');

    if (resultDataJSON) {
        // Decodifica los datos JSON
        const resultData = JSON.parse(resultDataJSON);

        console.log("correctAnswers:", resultData.correctAnswers);
        console.log("questions:", resultData.questions);

        // Muestra el puntaje
        const scoreElement = document.getElementById('score');
        scoreElement.textContent = `Puntaje: ${resultData.score}`;

        // Muestra las preguntas, respuestas del usuario y si son correctas o incorrectas
        const comparisonElement = document.getElementById('comparison');
        resultData.userResponses.forEach((userResponse, index) => {
            const question = resultData.questions[index];
            const userAnswer = question.options[userResponse];
            const correctAnswer = question.options[resultData.correctAnswers[`question${index + 1}`]];

            
            const questionResult = document.createElement('div');
            questionResult.innerHTML = `
                <p><strong>Pregunta:</strong> ${question.question}</p>
                <p><strong>Tu respuesta:</strong> ${userAnswer}</p>
                <p><strong>Respuesta correcta:</strong> ${correctAnswer}</p>
                <p><strong>Resultado:</strong> ${parseInt(userResponse) === parseInt(resultData.correctAnswers[`question${index + 1}`]) ? 'Correcta' : 'Incorrecta'}</p>
                ____________________________________
            `;

            comparisonElement.appendChild(questionResult);
        });
    }
});