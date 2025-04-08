function textareaAutoHeight() {
    const textarea = document.querySelector('.cf7-shortcode textarea');
    if (!textarea) return;

    const setHeight = () => {
        textarea.style.height = 'auto'; // reset height
        textarea.style.height = `${textarea.scrollHeight}px`; // set to scrollHeight
    };

    textarea.addEventListener('input', setHeight);
    setHeight(); // initialize on load
}

textareaAutoHeight();
