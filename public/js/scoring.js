// co
function calculateTotalScore() {
    let totalScore = 0;
    const form = document.getElementById('evaluationForm');
    const selects = form.getElementsByTagName('select');
    
    for (let i = 0; i < selects.length; i++) {
        totalScore += parseInt(selects[i].value);
    }

    document.getElementById('totalScore').value = totalScore;
}