const dateEl = document.getElementById('currentDate');
const welcomeEl = document.getElementById('welcomeMessage');
const headerTitle = document.querySelector('#header h2');
const studentName = prompt('Please enter your name:', 'Student');

if (studentName && studentName.trim() !== '') {
    welcomeEl.textContent = `Welcome, ${studentName}!`;
}

else {
    welcomeEl.textContent = 'Welcome, Student!';
}

const now = new Date();
dateEl.textContent = `Today: ${now.toDateString()}`;
