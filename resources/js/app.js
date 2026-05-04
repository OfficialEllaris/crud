import { createIcons, icons } from 'lucide';

const feedback = document.getElementById('feedback');

if (feedback) {
    setTimeout(() => {
        feedback.style.display = 'none';
    }, 3000);
}

// Caution, this will import all the icons and bundle them.
createIcons({ icons });