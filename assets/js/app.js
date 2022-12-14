import "../styles/style.css";

const formAddLinks = document.getElementById('formAddLink');
const addLinkLogo = document.getElementById('add');
const titleLocation = document.getElementById('title');

formAddLinks.style.display = 'none';

addLinkLogo.addEventListener('click', () => {
    formAddLinks.style.display = 'initial';
    addLinkLogo.style.display = 'none';
})

titleLocation.addEventListener('click', () => {
    window.location = '/index.php?c=home'
})
