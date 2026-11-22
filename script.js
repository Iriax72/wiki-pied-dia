// Références DOM
const settings_btn = document.querySelector('#settings-btn');
const settings_div = document.querySelector('#settings-div');

// EventListeners
settings_btn.addEventListener('click', () => {
    if (settings_div.classList.contains('hidden')) {
        settings_div.classList.remove('hidden');
    } else {
        settings_div.classList.add('hidden')
    }
});