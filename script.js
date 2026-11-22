// Références DOM
const settings_btn = document.querySelector('#settings-btn');
const settings_div = document.querySelector('#settings-div');
const research_btn = document.querySelector('#research-btn');
const research_input = document.querySelector('#research-input');

// EventListeners
settings_btn.addEventListener('click', () => {
    if (settings_div.classList.contains('hidden')) {
        settings_div.classList.remove('hidden');
    } else {
        settings_div.classList.add('hidden')
    }
});

research_btn.addEventListener('click', (event) => {
    if (research_input.value === '') {
        event.preventDefault();
        alert('Heuuu, tape une requête avant de faire ta recherche quand même...');
    }
});