const params = new URLSearchParams(location.search);
const concepts = ['paper', 'terminal', 'calendar'];
const concept = params.get('concept');
const story = params.get('format') === 'story';
const width = story ? 1080 : 1600;
const height = story ? 1920 : 900;
const poster = document.querySelector('.poster');
const [day, month, year] = window.posterEvent.date.trim().split(/\s+/);
const event = { ...window.posterEvent, day, month, year };

poster.classList.add(concepts.includes(concept) ? concept : 'paper');
poster.classList.toggle('story', story);

for (const field of document.querySelectorAll('[data-event]')) {
    const value = event[field.dataset.event] ?? '';
    if (field.dataset.event === 'time') field.hidden = !value;
    if (!field.hasAttribute('data-bidi')) {
        field.textContent = value;
        continue;
    }

    // Isolate Latin labels and acronyms from their surrounding Persian text.
    for (const part of value.split(/([A-Za-z][A-Za-z0-9-]*)/)) {
        if (/^[A-Za-z]/.test(part)) {
            const word = document.createElement('bdi');
            word.lang = 'en';
            word.textContent = part;
            field.append(word);
        } else {
            field.append(part);
        }
    }
}

const portrait = document.querySelector('[data-portrait]');
portrait.src = event.portrait;
portrait.alt = event.speaker;

function fitPoster() {
    const scale = Math.min(innerWidth / width, innerHeight / height);
    poster.style.scale = scale;
    poster.style.left = `${(innerWidth - width * scale) / 2}px`;
    poster.style.top = `${(innerHeight - height * scale) / 2}px`;
}

fitPoster();
addEventListener('resize', fitPoster);
