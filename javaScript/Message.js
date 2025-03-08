const message = document.querySelector('.message');
const input = document.querySelector('.input');
const button = document.querySelector('.button');

button.addEventListener('click', () => {
    message.textContent = input.value;
    input.value = '';
});