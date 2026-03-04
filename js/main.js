// loader
window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    const content = document.querySelector('main');

    const indexCards = document.querySelectorAll('.index-card');

    setTimeout(() => {
        loader.style.opacity = '0';
        loader.style.transition = 'opacity 0.5s ease';
        
        setTimeout(() => {
            loader.style.display = 'none';
            content.style.display = 'block';

            indexCards.forEach((card, index) => {
                card.style.setProperty('--order', index);
                card.classList.add('slide');
            });

        }, 500);
    }, 500); 
});

// index
function indexFlip(card) {
    if (!card.classList.contains('flipped')) {
        card.classList.add('flipped');
        allFlipped();
    }
}

function allFlipped() {
    const allCards = document.querySelectorAll('.index-card');
    const flippedCards = document.querySelectorAll('.index-card.flipped');
    
    if (flippedCards.length === allCards.length) {
        const section = document.getElementById('index-gacha');
        const prompt = document.getElementById('index-register');
        
        section.classList.add('index-shift');
        prompt.classList.remove('d-none');
        setTimeout(() => {
            prompt.classList.add('index-show');
        }, 50);
    }
}
