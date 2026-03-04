// loader
window.addEventListener('load', () => {
    const loader = document.getElementById('loader');
    const content = document.getElementsByTagName('main');

    setTimeout(() => {
        loader.style.opacity = '0';
        loader.style.transition = 'opacity 0.5s ease';
        
        setTimeout(() => {
            loader.style.display = 'none';
            content.style.display = 'block';
        }, 500);
    }, 500); 
});