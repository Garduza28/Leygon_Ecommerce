function App() {
    this.track = document.getElementById('track');
    this.slickList = this.track.parentNode;
    this.slick = this.track.querySelectorAll('.slick');
    this.slickWidth = this.slick[0].offsetWidth;
    this.trackWidth = this.track.offsetWidth;
    this.listWidth = this.slickList.offsetWidth;
    this.leftPosition = 0;

    this.autoScrollInterval = null; // Variable para almacenar el intervalo del desplazamiento automático
    this.autoScrollSpeed = 3000; // Velocidad de desplazamiento automático en milisegundos

    this.init();
}

App.prototype.init = function() {
    this.attachButtonListeners();
    this.startAutoScroll();
};

App.prototype.attachButtonListeners = function() {
    const prevButton = document.querySelector('[data-button="button-prev"]');
    const nextButton = document.querySelector('[data-button="button-next"]');
    prevButton.addEventListener('click', this.prevAction.bind(this));
    nextButton.addEventListener('click', this.nextAction.bind(this));
};

App.prototype.prevAction = function() {
    if (this.leftPosition > 0) {
        this.leftPosition -= this.slickWidth;
        this.updateTrackPosition();
    }
};

App.prototype.nextAction = function() {
    if (this.leftPosition < (this.trackWidth - this.listWidth)) {
        this.leftPosition += this.slickWidth;
        this.updateTrackPosition();
    } else {
        // Si llegamos al final, volvemos al principio
        this.leftPosition = 0;
        this.updateTrackPosition();
    }
};

App.prototype.updateTrackPosition = function() {
    this.track.style.left = `${-1 * this.leftPosition}px`;
};

App.prototype.startAutoScroll = function() {
    this.autoScrollInterval = setInterval(() => {
        if (this.leftPosition < (this.trackWidth - this.listWidth)) {
            this.leftPosition += this.slickWidth;
            this.updateTrackPosition();
        } else {
            // Si llegamos al final, volvemos al principio
            this.leftPosition = 0;
            this.updateTrackPosition();
        }
    }, this.autoScrollSpeed);
};

window.onload = function(event) {
    var app = new App();
    window.app = app;
};
