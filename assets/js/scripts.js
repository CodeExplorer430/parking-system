// Initialize Lucide icons
lucide.createIcons();

// Modal functions
function showModal(type) {
    document.getElementById(type + 'Modal').style.display = 'block';
}

function hideModal(type) {
    document.getElementById(type + 'Modal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}