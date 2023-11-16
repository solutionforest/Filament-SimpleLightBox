window.SimpleImageLightBox = {
    open(e) {
        e.preventDefault();
        let src = e.target.src;
        let lightboxDiv = document.createElement('div');
        lightboxDiv.innerHTML = `<div id="SimpleImageLightBox"
                    @keydown.escape.window="document.querySelector('#SimpleImageLightBox').remove()"
                    class="fixed inset-0 flex items-center justify-center p-4 bg-black/50 bg-opacity-75"
                    style="z-index: 10000;"
                    >
                    <div class="relative bg-white max-h-full max-w-2xl p-6 mx-auto rounded shadow" onclick="event.stopPropagation()">
                        <img src="${src}" alt="Lightbox image" class="object-cover w-full h-full rounded" />
                        <button class="absolute p-2 m-2 text-white rounded-full focus:outline-none" style="top:0; right:0" >
                        ✖️
                        </button>
                    </div>
                    </div>
                `;
        lightboxDiv.addEventListener('click', () => this.close());
        lightboxDiv.querySelector('button').addEventListener('click', (e) => {
            e.stopPropagation();
            this.close();
        });
        lightboxDiv.querySelector('div').addEventListener('keydown', e => {
            if (e.key === 'Escape') this.close();
        });
        this.lightboxDiv = lightboxDiv;
        document.body.appendChild(lightboxDiv);
    },
    close() {
        this.lightboxDiv.remove();
    }
}
